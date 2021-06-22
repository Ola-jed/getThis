<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Class ContactController
 * Controller for the contact form
 * @package App\Http\Controllers
 */
class ContactController extends Controller
{
    /**
     * Show the contact form
     * @return Factory|\Illuminate\Contracts\View\View|Application
     */
    public function index(): Factory|\Illuminate\Contracts\View\View|Application
    {
        return view('others.contactform');
    }

    /**
     * Send the contact form to the admin
     * @param ContactRequest $request
     * @return Redirector|Application|RedirectResponse|View
     */
    public function sendContactForm(ContactRequest $request): Redirector|Application|RedirectResponse|View
    {
        Mail::to(env('ADMIN_EMAIL'))
            ->send(new ContactMail(
                $request->input('subject'),
                $request->input('content'),
                session()->get('user')
            ));
        return view('others.contactsent');
    }
}