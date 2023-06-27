<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClosingPotEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $pot;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('MoneyPot: Pot Deleted Successfuly')->view('emails.potClose');
    }
}
