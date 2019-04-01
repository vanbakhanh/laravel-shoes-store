<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $orderProducts;
    public $order;
    public $user;
    public $profile;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderProducts, $order, $user, $profile)
    {
        $this->orderProducts = $orderProducts;
        $this->order = $order;
        $this->user = $user;
        $this->profile = $profile;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.invoice');
    }
}
