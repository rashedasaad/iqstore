<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Refound extends Mailable
{
    use Queueable, SerializesModels;
    public $information = [];
    public function __construct($info)
    {
        $this->information = $info;

    }


    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from(env("MAIL_FROM_ADDRESS"),env("APP_NAME"))->subject($this->information["title"])->markdown("Refound")->with("info",$this->information);
    }
}
