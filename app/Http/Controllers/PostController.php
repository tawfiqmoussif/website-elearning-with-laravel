<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Subpost;
use App\Categorie;
use App\Http\Requests\postRequest;
use Illuminate\Http\UploadedFile;
use Auth;
use DB;
use App\User;

class PostController extends Controller
{
     public function index(){
        if(Auth::user()->hasRole('super_admin')){
             $posts=Post::orderby('id','desc')->paginate(15);
        }
        else{
           $posts=Post::where('user_id',Auth::user()->id)->orderby('id','desc')->paginate(15);
       }
           return view('editor.post.index')->withPosts($posts);
    }
 
    public function store(postRequest $request){
    	
        $post=new Post();
        $post->nom=$request->input('nom');
        /** add photo ******/
        if($request->hasFile('photo')){ 
            $post->photo=$request->photo->store('upload/posts');
        }
        /*******/
        $post->small_description=$request->input('small_description');
        $post->full_description=$request->input('full_description');
        $post->user_id=Auth::user()->id;
        $post->categorie_id=$request->input('categorie_id');
        $post->save();
        session()->flash('success','la formation à été bien ajouté !! ');
        return redirect('posts');
    }

    public function create(){
        $categories=Categorie::all();
    	return view('editor.post.create',compact('categories'));
    }

    public function edit($id){
    	$post=Post::find($id);
        $this->authorize('update',$post);
        $categories=Categorie::all();
    	return view('editor.post.edit',compact('post','categories','subposts'));
    }

    public function update(postRequest $request,$id){
    	$post=Post::find($id);
    	$post->nom=$request->input('nom');
        $post->small_description=$request->input('small_description');
        $post->full_description=$request->input('full_description');
        if($request->hasFile('photo')){
            $post->photo=$request->photo->store('upload/posts');
        }
        $post->categorie_id=$request->input('categorie_id');
        $post->save();
        return redirect('posts');
    }

    public function destroy(Request $request,$id){
    	$post=Post::find($id);
        $this->authorize('delete',$post);
    	$post->delete();
    	return redirect('posts');
    }
}
