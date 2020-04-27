<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyFollowers extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Nueva canción';

    public $artista;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($artista)
    {
        $this->artista = $artista;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notify-followers');
    }
}
