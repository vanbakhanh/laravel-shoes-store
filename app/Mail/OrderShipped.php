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
    public $orderDetail;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderProducts, $orderDetail, $user)
    {
        $this->orderProducts = $orderProducts;
        $this->orderDetail = $orderDetail;
        $this->user = $user;
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
