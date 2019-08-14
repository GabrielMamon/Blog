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
        //get content
        $postcontent = $this->showPost($postID);

        return view('blogpost')->with('post',$postcontent)
                               ->with('title',$postcontent[0]->title)
                               ->with('title_slug',$postcontent[0]->title_slugged);
    }

    public function getpost(){

        $posts = DB::table('post')
            ->join('users','users.id','=','post.author')
            ->selectRaw('users.name ,post.id,post.title,post.title_slugged, post.imagepath,post.content,post.category,DATE_FORMAT(DATE(post.created_at),\'%b %e %Y\') AS created')
            ->paginate(3);

        foreach ($posts as $post) {
            if(strlen($post->content)>250){
               $post->content = substr(strip_tags($post->content),0,250)."[...]";
            }
        }
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

        public function getcomments($postID){
        //DB::enableQueryLog();
        $comment = DB::table('comment')
        ->join('users','users.id','=','comment.user_id')
        ->join('post','post.title_slugged','=','comment.post_id')
        ->selectRaw('users.name ,comment.comment, DATE_FORMAT(DATE(comment.created_at),\'%b %e %Y\') AS created,comment.updated_at')
        ->where('post.title_slugged','=',$postID)
        ->get();
        //dd(DB::getQueryLog());

        return $comment;
    }



}
