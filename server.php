<?php

namespace {

    use App\Http\Controller\NotFoundController;
    use App\Http\Controller\HomeController;
    use Peak\Backpack\AppBuilder;
    use Peak\Bedrock\Http\Application;
    use Psr\Http\Message\ServerRequestInterface as Request;

    require 'vendor/autoload.php';

    try {
        /** @var Application $app */
        $app = (new AppBuilder())
            ->setEnv('dev')
            ->setProps([])
            ->addToContainerAfterBuild()
            ->build();

        $app->get('/', new HomeController())
            ->stack(new NotFoundController());

    } catch (Exception $e) {
        echo $e->getMessage();
        die('Failed to start server');
    }

    $server = new React\Http\Server(function (Request $request) use ($app) {
        return $app->handle($request);
    });

    $loop = React\EventLoop\Factory::create();
    $socket = new React\Socket\Server(8080, $loop);
    $server->listen($socket);

    echo "Server running at http://127.0.0.1:8080\n";

    $loop->run();
}