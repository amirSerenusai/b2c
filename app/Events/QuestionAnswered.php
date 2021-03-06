<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QuestionAnswered implements  ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;



    public $data ;


    /**
     * Create a new event instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        // dd($data);
        $this->data = $data ;
//        $this->dontBroadcastToCurrentUser();

       $this->dontBroadcastToCurrentUser();

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
//        return new PrivateChannel('channel-name');

        return new Channel('adminserenus');
    }
}
