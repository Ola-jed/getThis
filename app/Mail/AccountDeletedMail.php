<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
        return $this->from('getthis020@gmail.com')
            ->subject('GetThis : User deleted')
            ->view('emails.accountdeleted');
    }
}
