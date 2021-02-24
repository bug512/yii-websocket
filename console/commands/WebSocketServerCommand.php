<?php

use Workerman\Worker;

/**
 * Class WebSocketServerCommand
 */
class WebSocketServerCommand extends CConsoleCommand
{
    const WORKER_KEY = 'connections';

    /**
     * Help information
     */
    public function actionIndex()
    {
        echo "Example start websocket: php console/yiic websocketserver start -d" . PHP_EOL;
        echo "Example stop websocket: php console/yiic websocketserver stop -d" . PHP_EOL;
    }

    /**
     * Stop websocket server
     */
    public function actionStart()
    {
        $this->worker();
    }

    /**
     * Stop websocket server
     */
    public function actionStop()
    {
        $this->worker();
    }

    /**
     * Status websocket server
     */
    public function actionStatus()
    {
        $this->worker();
    }

    /**
     * worker websocker server
     */
    private function worker()
    {
        // Create a Websocket server
        $websockerPort = \Yii::app()->params['websockerPort'] ?? 1234;

        $channelServerPort = \Yii::app()->params['channelServerPort'] ?? 2206;

        $websockerProtocol = \Yii::app()->params['websockerProtocol'] ?? 'websocket';

        $websockerCount = \Yii::app()->params['websockerCount'] ?? 4;

        // Channel Server.
        $channel_server = new Channel\Server('0.0.0.0', $channelServerPort);

        $ws_worker = new Worker($websockerProtocol . '://0.0.0.0:' . $websockerPort);

        // 4 processes
        $ws_worker->count = $websockerCount;

        $ws_worker->onWorkerStart = function ($worker) use ($channelServerPort){
            // Channel client connect to Channel Server.
            Channel\Client::connect('127.0.0.1', $channelServerPort);
            // Subscribe broadcast event .
            Channel\Client::on('broadcast', function ($data) use ($worker) {
                foreach ($worker->connections as $connection) {
                    $connection->send($data);
                }
            });
            /*// you can subscribe any events you want.
            Channel\Client::on('some other event like send group', function($data)use($worker){
                // Your send to group business.
            });*/
        };

        // Emitted when new connection come

        $ws_worker->onConnect = function ($connection) {
            echo 'New connection' . PHP_EOL;
            \Yii::log('New connection');
        };

        // Emitted when data received
        $ws_worker->onMessage = function ($connection, $data) {
            Channel\Client::publish('broadcast', $data);
            // Send hello $data
            echo $data . ' - it\s ok.';
        };

        // Emitted when connection closed
        $ws_worker->onClose = function ($connection) {
            echo 'Connection closed';
            \Yii::log('Connection closed');
        };

        // Run worker
        Worker::runAll();
    }
}