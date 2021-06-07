<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class RegistrationMail
 * Mail sent to a new user
 * @package App\Mail
 */
class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;
    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $userCreated)
    {
        $this->user = $userCreated;
    }

    /**
     * Build the message.
     * We're going to use the signup view
     * @return $this
     */
    public function build(): RegistrationMail
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('GetThis : Registration')
            ->view('emails.signupmail');
    }
}
