<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function show(){
        $posts = $this->post->paginate(8);
        //dd($posts);
        return view('user.posts.post',compact('posts'));
    }
    public function detailPost($slug){
        $post = $this->post->where('slug',$slug)->first();
        //dd($post);
        return view('user.posts.detailPost',compact('post'));
    }
}
