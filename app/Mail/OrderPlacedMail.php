<?php

namespace App\Mail;

use App\Models\Trip\TripOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tripOrder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TripOrder $tripOrder)
    {
        $this->tripOrder = $tripOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.orders.orderPlaced');
    }
}
