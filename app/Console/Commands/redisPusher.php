<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use React\EventLoop\Loop;
use React\EventLoop\Factory;


class redisPusher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:demon';

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
        $loop = Factory::create();
        $factory = new \Clue\React\Redis\Factory($loop);
        $client = $factory->createLazyClient('redis://localhost:6379');
//        $client->set('greeting',"hello");
//        $client->append('greeting','!');
//
//        $client->get('greeting')->then(function($greeting){
//           \Log::error($greeting);
//        });

        $client->publish('greeting', 'msg');

//        $client->end();
        $loop->run();
    }
}
