<?php

namespace App\Console\Commands;

use App\ratchet\LivePusher;
use App\ratchet\RatchetClient;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory;
use React\Socket\Server;

class runServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

//        $loop=Factory::create();
//
//
//
//        $pusher=new LivePusher($loop);
//        $server=new \App\ratchet\RatchetClient();
//        $socket=new Server('0.0.0.0:9090',$loop);
//        $ioserver = new IoServer((new WsServer($server)),$socket,$loop);
//
//
//        $server->setPusher($pusher);
//        $pusher->publish('message');


//        $factory = new \Clue\React\Redis\Factory($loop);
//        $client=$factory->createLazyClient('redis://localhost:6379');
////        $client->set('greeting',"hello");
////        $client->append('greeting','!');
////
////        $client->get('greeting')->then(function($greeting){
////           \Log::error($greeting);
////        });
//
//        $client->publish('greeting','messsage');
//
//        $client->end();





//
//
//
//        $loop = \React\EventLoop\Factory::create();
////        $factory = new \Clue\React\Redis\Factory($loop);
////        $cl=$factory->createLazyClient('redis://localhost:6379');
//////        $cl->incr('asdasd');
////        $cl->publish('publish client');
//
////        $cl->end();
//
//        $client=new \App\ratchet\RatchetClient();
//        $socket=new Server('0.0.0.0:9090',$loop);
//        $ioserver = new IoServer(new HttpServer(new WsServer($client)),$socket,$loop);
//
//        $pusher= new LivePusher($loop);
//        $pusher->setServer($client);
//        $client->setPusher($pusher);





//
//        $factory=new \Clue\React\Redis\Factory($loop);
//        $client=$factory->createLazyClient('redis://localhost:6379');
//        $client->publish('channel','message'.rand(1,50))->then(function($received){
//            \Log::error('published '.$received);
//        },function(\Exception $e){
//            \Log::error($e->getMessage());
//            exit(1);
//        });
//        $client->end();



//        $loop->run();

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new RatchetClient()
                )
            ),
            1010
        );
        $server->run();
    }
}
