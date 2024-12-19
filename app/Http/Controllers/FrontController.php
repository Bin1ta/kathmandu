<?php

namespace App\Http\Controllers;

use App\Traits\NepaliDateConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontController extends Controller
{

    public function index()
    {
        if(config('app.disable_main_page')){
            return redirect(route('newWard'));
        }
        return view('frontend.welcome');
    }

    public function wardIndex($ward)
    {
        return view('frontend.wardIndex', compact('ward'));
    }

    public function newward()
    {
        return view('frontend.ward');
    }
}
