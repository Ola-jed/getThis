<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
    public function build()
    {
        return $this->from('getthis020@gmail.com')
            ->subject($this->subject)
            ->replyTo($this->user->email)
            ->view('emails.contact');
    }
}
