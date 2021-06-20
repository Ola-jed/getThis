<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Mail\ReportMail;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;

/**
 * Class AccountController
 * Controller for public view of an account and report management
 * @package App\Http\Controllers
 */
class AccountController extends Controller
{
    /**
     * Show the profile of the asked user
     * If user not found, 404
     * @param int $userId
     * @return Application|Factory|View|Redirector|RedirectResponse
     */
    public function show(int $userId): View|Factory|Redirector|RedirectResponse|Application
    {
        if(!session()->has('user')) return redirect('/');
        try
        {
            $requestedUser = User::findOrFail($userId);
            $articlesWritten = $requestedUser
                ->articles()
                ->limit(10)
                ->get();
            $discussionsCreated = $requestedUser->discussions()
                ->withCount('messages')
                ->orderByDesc('messages_count')
                ->limit(10)
                ->get();
            return \view('account.account')->with([
                'user' => $requestedUser,
                'articles' => $articlesWritten,
                'discussions' => $discussionsCreated
            ]);
        }
        catch (Exception)
        {
            abort(404);
        }
    }

    /**
     * When a user is reported
     * @param int $userId
     * @param ReportRequest $reportRequest
     * @return View|Factory|Application|RedirectResponse
     */
    public function report(int $userId, ReportRequest $reportRequest): View|Factory|Application|RedirectResponse
    {
        try
        {
            $userReported = User::findOrFail($userId);
            Mail::to(env('ADMIN_EMAIL'))
                ->send(new ReportMail($userReported,$reportRequest->input('cause')));
            return view('account.accountreported');
        }
        catch (Exception)
        {
            return back();
        }
    }
}
