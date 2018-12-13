<?php
/**
 * Created by PhpStorm.
 * User: DityaRa
 * Date: 13/12/2018
 * Time: 13:24
 */

namespace App\Http\Controllers;


use App\Model\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function getPosts(){
        return Post::orderBy('id','desc')->get();
    }

    public function getPost($id){
        return Post::findOrFail($id);
    }

    public function store(Request $request){
        $post = new Post();
        $post->category_id = $request->category;
        $post->name = $request->name;
        //image insert
        if (!empty($request->image)){
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fullName = $image->getClientOriginalName();
                $n = explode('.',$fullName)[0];
                $name = $n."-".time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/images/');
                $image->move($destinationPath, $name);
                $post->image = $name;
            }
        }
        $post->desc = $request->description;
        $post->author = $request->author;
        $post->save();
        return response()->json([
           'success' => true
        ]);
    }

    public function update(Request $request,$id){
        $post = Post::findOrFail($id);
        $post->category_id = $request->category;
        $post->name = $request->name;
        //image insert
        if (!empty($request->image)){
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fullName = $image->getClientOriginalName();
                $n = explode('.',$fullName)[0];
                $name = $n."-".time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/images/');
                $image->move($destinationPath, $name);
                $post->image = $name;
            }
        }
        $post->desc = $request->description;
        $post->author = $request->author;
        $post->update();
        return response()->json([
            'success' => true
        ]);
    }

    public function destoryPosts($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json([
            'success' => true
        ]);
    }

}