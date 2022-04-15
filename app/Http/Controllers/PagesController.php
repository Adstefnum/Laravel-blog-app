<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PagesController extends Controller
{



        public function home(){
                
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('pages.home')->with('posts', $posts);
        
        }
        public function about(){

                return view('pages.about');
        }
        public function contact(){

                return view('pages.contact');
        }
}
?>
