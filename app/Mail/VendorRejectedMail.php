<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendorRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public String $shopName;
    public String $remarks;

    /**
     * Create a new message instance.
     */
    public function __construct(String $shopName, String $remarks)
    {
        $this->shopName = $shopName;
        $this->remarks = $remarks;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this
            ->subject('Your Vendor Application Status')
            ->view(
                'emails.rejected'
            );
    }
}
