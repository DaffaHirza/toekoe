<?php

namespace App\Mail;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewThankYou extends Mailable
{
    use Queueable, SerializesModels;

    public $review;
    public $product;

    /**
     * Create a new message instance.
     */
    public function __construct(Review $review, $product = null)
    {
        $this->review = $review;
        $this->product = $product;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Terima kasih atas review Anda')
            ->view('emails.review-thank-you');
    }
}
