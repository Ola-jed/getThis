<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ContactController extends Controller
{
    private const ADMIN_EMAIL = 'olabijed@gmail.com';

    /**
     * Show the contact form
     * @return Redirector|Application|RedirectResponse|View
     */
    public function index(): Redirector|Application|RedirectResponse|View
    {
        if(!Session::has('user')) return redirect('/');
        return view('others.contactform');
    }

    /**
     * Send the contact form to the admin
     * @param ContactRequest $request
     * @return Redirector|Application|RedirectResponse|View
     */
    public function sendContactForm(ContactRequest $request): Redirector|Application|RedirectResponse|View
    {
        if(!Session::has('user')) return redirect('/');
        Mail::to(env('ADMIN_EMAIL'))
            ->send(new ContactMail(
                $request->input('subject'),
                $request->input('content'),
                Session::get('user')
            ));
        return view('others.contactsent');
    }
}
