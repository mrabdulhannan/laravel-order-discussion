<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExampleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->details['senderEmail'], $this->details['senderName'])
                    ->subject($this->details['title'])
                    ->view('emails.example');
    }
    // public function build()
    // {
    //     return $this->subject('Test Email')
    //                 ->view('emails.example');

                    
    // }
}
