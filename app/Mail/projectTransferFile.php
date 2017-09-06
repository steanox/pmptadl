<?php

namespace Pmptadl\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class projectTransferFile extends Mailable
{
    use Queueable, SerializesModels;
    public $urlDownload;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($urlDownload)
    {
        $this->urlDownload = $urlDownload;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.project.projecttransferfile');
    }
}
