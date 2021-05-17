<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    /**
     * Method to check if index should appear
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return redirect(Session::has('user') ? '/' : 'login');
    }
}
