<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $postdata = $this->getpost();
        $recentdata = $this->getrecent();
        return view('home')->with('posts',$postdata)
                        ->with('recent',$recentdata)
                        ->with('title','Home');
    }

    public function blogpost($postID){
        $postcontent = $this->showPost($postID);

        //dd($postcontent);
        return view('blogpost')->with('post',$postcontent)->with('title',$postcontent[0]->title);
    }

    public function getpost(){

        $posts = DB::table('post')
            ->join('users','users.id','=','post.author')
            ->selectRaw('users.name ,post.id,post.title,post.title_slugged, post.imagepath,post.content,post.category,DATE_FORMAT(DATE(post.created_at),\'%b %e %Y\') AS created')
            ->get();

        return $posts;
    }

    public function getrecent(){

        $posts = DB::table('post')
            ->join('users','users.id','=','post.author')
            ->selectRaw('users.name ,post.id,post.title,post.title_slugged, post.imagepath,post.content,post.category,DATE_FORMAT(DATE(post.created_at),\'%b %e %Y\') AS created')
            ->orderBy('post.created_at','desc')
            ->limit(10)
            ->get();

        return $posts;
    }

    public function showPost($postID){
        //DB::enableQueryLog();
        $posts = DB::table('post')
            ->join('users','users.id','=','post.author')
            ->selectRaw('users.name ,post.id,post.title,post.title_slugged, post.imagepath,post.content,post.category,DATE_FORMAT(DATE(post.created_at),\'%b %e %Y\') AS created')
            ->where('post.title_slugged','=',$postID)
            ->get();
            //dd(DB::getQueryLog());
            return $posts;
    }


}
