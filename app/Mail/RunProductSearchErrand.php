<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RunProductSearchErrand extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $quote;

    public function __construct($productQuote)
    {
        $this->quote = $productQuote;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('general.errands_custom_email_subject'))
            ->markdown('emails.general.product_search_errand')
            ->with('quote', $this->quote);
    }
}
