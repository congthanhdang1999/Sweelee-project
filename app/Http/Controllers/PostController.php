<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryPost;
use App\Post;

use App\Traits\StorageImageTrait;
use Illuminate\Support\Str;
class PostController extends Controller
{
    use StorageImageTrait;
    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function show(){
        $posts = Post::paginate(8);
        //dd($posts);
        return view('admin.posts.list',compact('posts'));
    }
    public function add(){
        $cat_post = CategoryPost::all();
        return view('admin.posts.add',compact('cat_post'));
    }
    public function store(Request $request){
        //echo "ok";
        $dataPostCreate = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_post_id' => $request->category_post_id,
            'user_id' => Auth()->id(),
        ];
        $dataUploadFeatureImagePost = $this->storageTraitUpload($request,'feature_image','post');
        if(!empty($dataUploadFeatureImagePost)){
            $dataPostCreate['feature_image'] = $dataUploadFeatureImagePost['file_path'];
        }
        $this->post->create($dataPostCreate);
        //dd($dataSliderCreate);
        return redirect('admin/post/list')->with('status','Thêm bài viết thành công');
    }
    
}
