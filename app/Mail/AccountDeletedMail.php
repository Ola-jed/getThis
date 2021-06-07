<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class AccountDeletedMail
 * Mail sent when account is deleted
 * @package App\Mail
 */
class AccountDeletedMail extends Mailable
{
    use Queueable, SerializesModels;
    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $userDeleted)
    {
        $this->user = $userDeleted;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('GetThis : User deleted')
            ->view('emails.accountdeleted');
    }
}
