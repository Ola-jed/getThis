<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ContactMail
 * Mail sent to the admin when someone contact us
 * @package App\Mail
 */
class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public string $content;
    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $subject,string $content,User $user)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject($this->subject)
            ->replyTo($this->user->email)
            ->markdown('emails.contact');
    }
}
