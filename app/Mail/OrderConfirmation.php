<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $dataOrderConfirmation;
    public function __construct($dataOrderConfirmation)
    {
        $this->data = $dataOrderConfirmation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user.mail.Confirmation')
        ->subject('[SWEELEE.VN] Thư xác nhận đặt hàng thành công!')
        ->with($this->data);
    }
}
