<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $title = "MY BLOGS";
        
        //$posts = $this->getPosts();
        $posts = Post::all();
        
        return view('posts.index',compact('title','posts'));
    }

    // private function getPosts(){
    //     //to change to object
    //     return json_decode(json_encode([
    //         ['id'=> '1','title' => 'post 1','content' =>'Content of Post 1'],
    //         ['id'=> '2','title' => 'post 2','content' =>'Content of Post 2']
    //     ]));
    // }



    //using this before the slug created so using id

    // public function detail($id){
    //     //$posts = $this->getPosts();
    //     //$post = collect($posts)->firstWhere('id',$id);
    //     try {
    //         //code...
    //         $post= Post::findOrFail($id);
    //         return view('posts.detail',compact('post'));
    //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
    //         //throw $th;
    //         return response()->view('errors.404',[],404);
    //     }

    // }

    public function detail($slug){
        //$posts = $this->getPosts();
        //$post = collect($posts)->firstWhere('id',$id);
        try {
            //code...
            $post= Post::where('slug',$slug)->first();
            if(!$post){
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException;
            }
            return view('posts.detail',compact('post'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            //throw $th;
            return response()->view('errors.404',[],404);
        }

    }
}   