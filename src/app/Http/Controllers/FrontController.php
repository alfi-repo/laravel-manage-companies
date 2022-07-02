<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'en');
        if (array_key_exists($lang, \Config::get('languages'))) {
            Session::put('locale', $lang);
            \App::setLocale($lang);
        }
        return view('front');
    }
}
