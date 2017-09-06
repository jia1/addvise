<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FacebookWebhookNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $advice_request_id;
    public $fb_post_id;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($advice_request_id, $fb_post_id, $message)
    {
        $this->advice_request_id = $advice_request_id;
        $this->fb_post_id = $fb_post_id;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email');
    }
}
