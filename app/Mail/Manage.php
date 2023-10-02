<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Manage extends Mailable
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
        return $this->from(env("MAIL_FROM_ADDRESS"),env("APP_NAME"))->subject($this->information["title"])->attach($this->information["path"], [
            'as' => $this->information["filename"].".".$this->information["extension"],
            'mime' => 'application/'.$this->information["extension"]])->markdown("manage")->with("info",$this->information);
    }
}
