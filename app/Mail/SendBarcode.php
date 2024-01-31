<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBarcode extends Mailable
{
    use Queueable, SerializesModels;

    public $barcode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.send-barcode')
            ->subject('Event Barcode')
            ->with(['content' => 'Find the attached barcode to use during admittance to the event.'])
            ->attachData($this->barcode, 'Barcode.pdf');
    }
}
