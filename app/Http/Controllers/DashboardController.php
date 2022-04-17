<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
     public function __construct()
         {
                 $this->middleware('auth');

         }
     public function dashboard () {

    $user_id = Auth::id();
    $user = User::find($user_id);
    return view('dashboard')->with('posts', $user->posts);
     }
}
