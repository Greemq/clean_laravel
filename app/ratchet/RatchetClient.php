<?php

namespace App\ratchet;

use Illuminate\Support\Facades\Log;

class RatchetClient implements \Ratchet\MessageComponentInterface
{

    protected $clients;

    public function __construct(){
        $this->clients=new \SplObjectStorage();
    }
    public function setPusher($pusher)
    {
        $this->pusher = $pusher;
    }


    function onOpen(\Ratchet\ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        Log::error('opened '.$conn->resourceId);

    }

    function onClose(\Ratchet\ConnectionInterface $conn)
    {
//        $this->closeConnection($conn);
        $this->clients->detach($conn);

    }

    function onError(\Ratchet\ConnectionInterface $conn, \Exception $e)
    {
//        $this->closeConnection($conn);
        $conn->close();
    }

    function onMessage(\Ratchet\ConnectionInterface $from, $msg)
    {
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
                Log::channel($msg);

            }
        }
//        $this->pusher->publish($msg);
    }
}