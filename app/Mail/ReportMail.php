<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ReportMail
 * Sent to the admin when someone reports a user
 * @package App\Mail
 */
class ReportMail extends Mailable
{
    use Queueable, SerializesModels;
    public User $user;
    public string $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Report')
            ->replyTo($this->user->email)
            ->markdown('emails.report');
    }
}
