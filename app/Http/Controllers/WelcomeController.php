<?php

namespace App\Http\Controllers;

use App\Operator;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $operators = Operator::all();
        return view('welcome', compact('operators'));
    }
}
