<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;

class TransactionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return $this->success("User transactions", TransactionResource::collection($transaction));
    }
}
