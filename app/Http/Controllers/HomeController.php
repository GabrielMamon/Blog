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
        $postdata = $this->getPost();
        $recentdata = $this->getRecent();

        return view('home')->with('posts',$postdata)
                        ->with('recent',$recentdata)
                        ->with('title','Home');
    }

    public function blogPost($postID){
        //get content
        $postcontent = $this->showPost($postID);

        return view('blogpost')->with('post',$postcontent)
                               ->with('title',$postcontent[0]->title)
                               ->with('title_slug',$postcontent[0]->title_slugged);
    }

    public function postAuthor($authorName){

        $postdata = $this->getAuthor($authorName);
        $recentdata = $this->getRecent();

        return view('home')->with('posts',$postdata)
                        ->with('recent',$recentdata)
                        ->with('title',$authorName);
    }

    public function postCategory($categoryName){

        $postdata = $this->getCategory($categoryName);
        $recentdata = $this->getRecent();

        return view('home')->with('posts',$postdata)
                        ->with('recent',$recentdata)
                        ->with('title',$categoryName);
    }

    private function getPost(){

        $posts = DB::table('post AS p')
            ->join('users AS u','u.id','=','p.author')
            ->join('comments AS c','c.post_id','=','p.title_slugged','left outer')
            ->selectRaw('u.name ,p.id,p.title,p.title_slugged, p.imagepath,p.content,p.category,COUNT(c.comment) AS comment,DATE_FORMAT(DATE(p.created_at),\'%b %e %Y\') AS created')
            ->groupBy('p.id')
            ->paginate(3);

        $posts = $this->shortenText($posts);

        return $posts;
    }

    private function showPost($postID){
        //DB::enableQueryLog();
        $posts = DB::table('post')
            ->join('users','users.id','=','post.author')
            ->selectRaw('users.name ,post.id,post.title,post.title_slugged, post.imagepath,post.content,post.category,DATE_FORMAT(DATE(post.created_at),\'%b %e %Y\') AS created')
            ->where('post.title_slugged','=',$postID)
            ->get();
            //dd(DB::getQueryLog());
        return $posts;
    }

    private function getRecent(){

        $posts = DB::table('post')
            ->join('users','users.id','=','post.author')
            ->selectRaw('users.name ,post.id,post.title,post.title_slugged, post.imagepath,post.content,post.category,DATE_FORMAT(DATE(post.created_at),\'%b %e %Y\') AS created')
            ->orderBy('post.created_at','desc')
            ->limit(10)
            ->get();

        return $posts;
    }

    private function getAuthor($authorName){
        //DB::enableQueryLog();
        $posts = DB::table('post')
            ->join('users','users.id','=','post.author')
            ->selectRaw('users.name,post.id,post.title,post.title_slugged, post.imagepath,post.content,post.category,DATE_FORMAT(DATE(post.created_at),\'%b %e %Y\') AS created')
            ->where('users.name','=',$authorName)
            ->paginate(3);
        //dd(DB::getQueryLog());

        return $this->shortenText($posts);

    }

    private function getCategory($categoryName){
        //DB::enableQueryLog();
        $posts = DB::table('post')
            ->join('users','users.id','=','post.author')
            ->selectRaw('users.name,post.id,post.title,post.title_slugged, post.imagepath,post.content,post.category,DATE_FORMAT(DATE(post.created_at),\'%b %e %Y\') AS created')
            ->where('post.category','=',$categoryName)
            ->paginate(3);
        //dd(DB::getQueryLog());

        return $this->shortenText($posts);
    }

    private function getSearch($searchItem){

    }

    private function shortenText($datas){

        foreach ($datas as $data) {
            if(strlen($data->content)>200){
               $data->content = substr(strip_tags($data->content),0,200)."[...]";
            }
        }
        return $datas;
    }

    public function getComments($postID){
        //DB::enableQueryLog();
        $comment = DB::table('comments')
        ->join('users','users.id','=','comments.user_id')
        ->join('post','post.title_slugged','=','comments.post_id')
        ->selectRaw('users.name ,comments.comment, DATE_FORMAT(DATE(comments.created_at),\'%b %e %Y\') AS created,comments.updated_at')
        ->where('post.title_slugged','=',$postID)
        ->get();
        //dd(DB::getQueryLog());

        return $comment;
    }



}

