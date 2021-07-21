<?php

namespace App\ratchet;

use Clue\React\Redis\Factory;

class LivePusher
{
    private $sender_redis = null;
    private $subscriber_redis = null;
    private $server = null;

    public function __construct($loop)
    {
        $factory = new Factory($loop);

        /*
            Note: cannot use the same Redis client for both subscribe and publish
        */
        $this->sender_redis = $factory->createLazyClient('redis://localhost:6379');
        $this->subscriber_redis = $factory->createLazyClient('redis://localhost:6379');
        $this->subscriber_redis->subscribe('live_signalling');
    }

    public function setServer($server)
    {
        $this->server = $server;

        $this->subscriber_redis->on('message', function ($channel, $payload) use ($server) {
            /*
                Deliver here the message to the proper $server->clients
            */
        });
    }

    public function publish($msg)
    {
        $this->sender_redis->publish('live_signalling', $msg);
    }
}