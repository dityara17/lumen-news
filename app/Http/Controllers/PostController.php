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
use Symfony\Component\Console\Helper\Helper;

class PostController extends Controller
{

    public function getPosts()
    {
        return Post::orderBy('id', 'description')->get();
    }

    public function getPost($id)
    {
        return Post::findOrFail($id);
    }

    public function getPostByAuthor($name){
        return Post::where('author', $name)->get();
    }


    public function store(Request $request)
    {
        $post = new Post();
        $post->category_id = $request->category;
        $post->name = $request->name;
        //image insert
        if (!empty($request->image)) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fullName = $image->getClientOriginalName();
                $n = explode('.', $fullName)[0];
                $name = $n . "-" . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/images/');
                $image->move($destinationPath, $name);
                $post->image = $name;
            }
        }
        $post->description = $request->description;
        $post->author = $request->author;
        $post->save();
        return response()->json([
            'success' => true,
            'name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'author' => $request->author
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (!empty($request->category)) {
            $post->category_id = $request->category;
        }
        if (!empty($request->name)) {
            $post->name = $request->name;
        }

        //image insert
        if (!empty($request->image)) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fullName = $image->getClientOriginalName();
                $n = explode('.', $fullName)[0];
                $name = $n . "-" . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/images/');
                $image->move($destinationPath, $name);
                $post->image = $name;
            }
        }
        if (!empty($request->description)) {
            $post->description = $request->description;
        }
        if (!empty($request->author)) {
            $post->author = $request->author;
        }
        $post->save();
        if (!empty($post)) {
            return response()->json([
                'success' => true,
                'name' => $post->name,
                'category_id' => $post->category_id,
                'description' => $post->description,
                'author' => $post->author
            ]);
        } else{
            return response()->json([
                'error' => 'Record does not found 400,400'
            ]);
        }
    }

    public function destoryPosts($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        if (!empty($post)) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'error' => 'Record does not found 400,400'
            ]);
        }
    }

}