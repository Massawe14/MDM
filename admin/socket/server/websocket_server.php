<?php

    use Ratchet\Server\IoServer;
    use Ratchet\Http\HttpServer;
    use Ratchet\WebSocket\WsServer;
    use Massawe\Command\Shutdown;

    require '../vendor/autoload.php';

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Shutdown()
                )
            ),
            8080
        );

        $server->run();
?>        