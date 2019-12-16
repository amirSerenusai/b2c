<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use function GuzzleHttp\Psr7\str;

class ProcedureLink extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $combinationID;

    /**
     * Create a new message instance.
     *
     * @param $combinationID
     */
    public function __construct($combinationID)

    {
//        $proc_id
        $this->combinationID = $combinationID;
//        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('mail.newProcedureLink');
    }
}
