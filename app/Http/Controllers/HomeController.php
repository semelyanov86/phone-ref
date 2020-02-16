<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\TransactionShowResource;
use App\Operator;
use App\Services\TotalService;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $operators = Operator::all();
        return view('home', compact('operators'));
    }
    /**
     * Show the payment form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function payment($id)
    {
        $operator = Operator::whereId($id)->firstOrFail();
        $user = Auth::user();
        $serviceModel = new TotalService();
        $ins = $serviceModel->calcTotal($id, 'in', $user->id);
        $outs = $serviceModel->calcTotal($id, 'out', $user->id);
        $balance = $ins - $outs;
        return view('create', compact('operator', 'balance', 'user', 'ins', 'outs'));
    }
    /**
     * Method to make a payment
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function send(PaymentRequest $request)
    {
        $transaction = Transaction::create($request->all());
        return new TransactionShowResource($transaction);
    }
}
