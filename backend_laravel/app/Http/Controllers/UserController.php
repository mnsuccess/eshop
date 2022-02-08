<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Listing of the resource
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->select(
            'id',
            'name',
            'email',
            'created_at'
        )->paginate(10);
        return view('admin.user.index', compact('users'));
    }
}
