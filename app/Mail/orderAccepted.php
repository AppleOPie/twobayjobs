<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Order;

class OrderAccepted extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user, $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('我們正在光速採購您的訂單！')->markdown('mail.orderAccepted');
    }
}
