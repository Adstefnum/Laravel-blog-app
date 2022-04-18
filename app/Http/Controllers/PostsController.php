<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function __construct()
    {
               $this->middleware('auth', ['except' => ['show']]);

    }

    public function show(){
               return view();
        }

    public function create(){
              return view('posts.create');


        }

        public function store(Request $request){
            $this->validate($request,[
                'title' => 'required',
                'body' => 'required',
                'cover_image' => 'image|nullable|max:1999'
            ]);

            //if there is a file in the submission
            if($request->hasFile('cover_image')){
                //get the name with extension of the file
                $filenamewithext = $request->file('cover_image')->getClientOriginalName();

                //get filename alone
                $filename = pathinfo($filenamewithext,PATHINFO_FILENAME);

                //get extension alone
                $ext = $request->file('cover_image')->getClientOriginalExtension();

                //create a unique filename
                $stored_file = $filename.'_'.time().'_.'.$ext;

                //storage file
                $path = $request->file('cover_image')->storeAs('public/cover_images',$stored_file);

                 // make thumbnails
                $thumbStore = 'thumb_'.$stored_file;
                $thumb = Image::make($request->file('cover_image')->getRealPath());
                $thumb->resize(80, 80);
                $thumb->save('storage/cover_images/'.$thumbStore);
            }


            else{
                $stored_file = 'no_image.jpg';
            }

            // Create Post
                $post = new Post;
                $title = $request->input('title');
                $post->title = $title;
                $post->body = $request->input('body');
                $post->slug = preg_replace('/\s+/', '-', $title);
                $post->user_id = Auth::id();
                $post->cover_image = $stored_file;
                $post->save();
                return redirect('/')->with('success', 'Post Created');
        }
        public function update(){
                return view();
        }
        public function destroy(){
                return view();
        }
}
