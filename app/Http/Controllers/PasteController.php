<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasteRequest;
use App\Models\Paste;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Throwable;

/**
 * Class PasteController
 * Management of pastes
 * @package App\Http\Controllers
 */
class PasteController extends Controller
{
    /**
     * Show the form to create a new paste
     * @return View|Factory|Redirector|RedirectResponse|Application
     */
    public function index(): View|Factory|Redirector|RedirectResponse|Application
    {
        return view('paste.pasteform');
    }

    /**
     * Show the asked paste with the slug given
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        try
        {
            return view('paste.pasteview')->with([
                'paste' => Paste::getWithSlug($slug)
            ]);
        }
        catch (Exception)
        {
            abort(404);
        }
    }

    /**
     * Crates a new paste
     * @param PasteRequest $pasteRequest
     * @return Redirector|Application|RedirectResponse
     */
    public function store(PasteRequest $pasteRequest): Redirector|Application|RedirectResponse
    {
        try
        {
            $paste = Paste::createFromInfo($pasteRequest->all(),session()->get('user')->id);
            return redirect('paste/'.$paste->slug);
        }
        catch (Exception)
        {
            return back()
                ->withInput()
                ->withErrors([
                    'message' => 'Cannot create the paste'
                ]);
        }
    }

    /**
     * Show the form to update the paste
     * Can update only if he is the author
     * @param string $slug
     * @return Redirector|Application|RedirectResponse|View
     */
    public function edit(string $slug): Redirector|Application|RedirectResponse|View
    {
        $askedPaste = Paste::getWithSlug($slug);
        if(session()->get('user')->id === $askedPaste->user_id)
        {
            return view('paste.pasteupdateform')->with(['paste' => $askedPaste]);
        }
        return redirect('/paste/'.$slug);
    }

    /**
     * Update the specified paste
     * @param string $slug
     * @param PasteRequest $pasteRequest
     * @return Application|RedirectResponse|Redirector
     */
    public function update(string $slug, PasteRequest $pasteRequest): Redirector|RedirectResponse|Application
    {
        $pasteToUpdate = Paste::getWithSlug($slug);
        if($pasteToUpdate->user_id === session()->get('user')->id)
        {
            try
            {
                $pasteToUpdate->slug = Str::slug($pasteRequest->input('title'));
                $pasteToUpdate->content = $pasteRequest->input('content');
                $pasteToUpdate->deletion_date = Carbon::parse($pasteToUpdate->created_at)
                    ->addHours(intval($pasteRequest->input('lifetime')))
                    ->toDateTime();
                $pasteToUpdate->saveOrFail();
                return redirect('/paste/'.$pasteToUpdate->slug);
            }
            catch (Throwable)
            {
                return back()
                    ->withInput()
                    ->withErrors([
                        'message' => 'Cannot update the paste'
                    ]);
            }
        }
        return redirect('/paste/'.$slug);
    }

    /**
     * Destroy the given paste
     * @param string $slug
     * @return Redirector|Application|RedirectResponse
     */
    public function destroy(string $slug): Redirector|Application|RedirectResponse
    {
        $pasteToDelete = Paste::getWithSlug($slug);
        if($pasteToDelete->user_id === session()->get('user')->id)
        {
            $pasteToDelete->forceDelete();
            return redirect('/paste');
        }
        return redirect('/paste/'.$slug);
    }
}