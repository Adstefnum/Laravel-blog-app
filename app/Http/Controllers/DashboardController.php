<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
     public function __construct()
         {
                 $this->middleware('auth');

         }
     public function dashboard () {

    $user_id = Auth::id();
    $user = User::find($user_id);
    return view('pages.dashboard')->with('posts', $user->posts);
     }
}
