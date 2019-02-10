<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Subpost;
use App\Categorie;
use DB;
class PagesController extends Controller
{
    public function home()
    {
        $categories=Categorie::orderby('id','desc')->paginate(6);
        $posts=Post::orderby('id','desc')->paginate(9);
    	return view('all.home',compact('posts','categories'));
    }
    public function categorie_for_all($id)
    {
           $posts=Post::where('categorie_id',$id)->orderby('id','desc')->paginate(15);
           $categorie=Categorie::find($id);
           return view('all.categorie',compact('categorie','posts'));
    }
    public function post_for_all($id){
         $subposts=Subpost::where('post_id',$id)->orderby('id','asc')->paginate(30);
           $post=Post::find($id);
           return view('all.post',compact('post','subposts'));
    }

     public function categories_for_all()
    {
          $categories=Categorie::orderby('id','desc')->paginate(15);
           return view('all.all_categories',compact('categories'));
    }
    public function posts_for_all(){
          $posts=Post::orderby('id','desc')->paginate(15);
           return view('all.all_posts',compact('posts'));
    }
    /****** pages for super admin *****************************
    *******
    ***********************important ****************************
    *****************/
   
}
