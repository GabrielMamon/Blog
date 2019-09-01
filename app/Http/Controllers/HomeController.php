<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

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
        $categories = $this->getCategoryList();
        $trenddata = $this->getTopPosts();
        $featureddata = $this->getCarousel();

        return view('home')->with('posts',$postdata)
                        ->with('recent',$recentdata)
                        ->with('categories',$categories)
                        ->with('title','Home')
                        ->with('items',$trenddata)
                        ->with('carousel',$featureddata);
    }

    public function blogPost($postID){
        //get content
        $postdata = $this->getPost();
        $postcontent = $this->showPost($postID);
        $pageslink = $this->getPrevNext($postID);

        $recentdata = $this->getRecent();
        $categories = $this->getCategoryList();

        if(count($pageslink) === 1){
            if($pageslink[0]->dummy == '0'){
                $arr = array('dummy' => '1','title' => 'You have reached the latest post','link' => ''); //pre
                $arr = (object) $arr;
                array_push($pageslink,$arr);
            }else{
                $arr = array('dummy' => '0','title' => 'You have reached the earliest post','link' => ''); //n

                $arr = (object) $arr;
                array_unshift($pageslink,$arr);
            }
        }
        //dd($pageslink);


        return view('blogpost')->with('post',$postcontent)
                               ->with('title',$postcontent[0]->title)
                               ->with('title_slug',$postcontent[0]->title_slugged)
                               ->with('pageslink',$pageslink)
                               ->with('posts',$postdata)
                               ->with('categories',$categories)
                               ->with('recent',$recentdata);


    }

    public function postAuthor($authorName){

        $postdata = $this->getAuthor($authorName);

        $recentdata = $this->getRecent();
        $categories = $this->getCategoryList();

        return view('search')->with('posts',$postdata)
                        ->with('title',$authorName)
                        ->with('categories',$categories)
                        ->with('recent',$recentdata);
    }

    public function postCategory($categoryName){

        $postdata = $this->getCategory($categoryName);

        $recentdata = $this->getRecent();
        $categories = $this->getCategoryList();

        return view('search')->with('posts',$postdata)
                        ->with('title',$categoryName)
                        ->with('categories',$categories)
                        ->with('recent',$recentdata);
    }

    public function prosSearch(Request $request){
        $searchItem = $request->input('InputSearch');
        return redirect('search/'.$searchItem);
    }

    public function postSearch($searchItem){
        $postdata = $this->getSearch($searchItem);

        $recentdata = $this->getRecent();
        $categories = $this->getCategoryList();

        return view('search')->with('posts',$postdata)
                        ->with('title',$searchItem)
                        ->with('categories',$categories)
                        ->with('recent',$recentdata)
                        ->with('searchval',$searchItem);
    }

    public function getComments($postID){
        //DB::enableQueryLog();
        $comment = DB::table('comments')
        ->join('users','users.id','=','comments.user_id')
        ->join('post','post.title_slugged','=','comments.post_id')
        ->selectRaw('users.name ,comments.comment, DATE_FORMAT(DATE(comments.created_at),\'%b %e %Y\') AS created,comments.updated_at')
        ->where('post.title_slugged','=',$postID)
        ->orderBy('comments.created_at','DESC')
        ->get();
        //dd(DB::getQueryLog());

        return $comment;
    }

    public function authorGetPost(){
        //DB::enableQueryLog();
        $posts = DB::table('post')
            ->selectRaw('id,title,title_slugged,imagepath,content,category,featured,created_at as dateposted')
            ->where('author','=',Auth::id())
            ->get();
            //dd(DB::getQueryLog());
        $posts = $this->shortenText($posts);
        return $posts;
    }

    private function getPost(){
        //DB::enableQueryLog();
        $posts = DB::table('post AS p')
            ->join('users AS u','u.id','=','p.author')
            ->join('comments AS c','c.post_id','=','p.title_slugged','left outer')
            ->selectRaw('u.name ,p.id,p.title,p.title_slugged, p.imagepath,p.content,p.category,COUNT(c.comment) AS comment,DATE_FORMAT(DATE(p.created_at),\'%b %e %Y\') AS created')
            ->groupBy('p.id')
            ->orderBy('p.created_at','DESC')
            ->paginate(3);
        //dd(DB::getQueryLog());
        $posts = $this->shortenText($posts);


        return $posts;
    }

    private function showPost($postID){
        //DB::enableQueryLog();
        $posts = DB::table('post as p')
            ->join('users as u','u.id','=','p.author')
            ->join('comments AS c','c.post_id','=','p.title_slugged','left outer')
            ->selectRaw('u.name ,p.id,p.title,p.title_slugged, p.imagepath,p.content,p.category,COUNT(c.comment) AS comment,DATE_FORMAT(DATE(p.created_at),\'%b %e %Y\') AS created')
            ->where('p.title_slugged','=',$postID)
            ->groupBy('p.id')
            ->get();
        //dd(DB::getQueryLog());
        return $posts;
    }

    private function getTopPosts(){
        $posts = DB::table('post AS p')
        ->join('users AS u','u.id','=','p.author')
        ->join('comments AS c','c.post_id','=','p.title_slugged','left outer')
            ->selectRaw('u.name,p.title,p.title_slugged,p.imagepath,COUNT(c.comment) AS comment,DATE_FORMAT(DATE(p.created_at),\'%b %e %Y\') AS created')
            ->groupBy('p.id')
            ->orderBy('comment','DESC')
            ->limit(2)
            ->get();

        return $posts;
    }

    private function getCarousel(){
        $posts = DB::table('post AS p')
            ->join('users AS u','u.id','=','p.author')
            ->selectRaw('u.name,p.title,p.title_slugged,p.imagepath,DATE_FORMAT(DATE(p.created_at),\'%b %e %Y\') AS created')
            ->where('featured','=','1')
            ->get();
        return $posts;
    }

    private function getPrevNext($slugged){
        //DB::enableQueryLog();

        $pages = DB::select('(select \'0\' as dummy,title,concat(\'href=\',`title_slugged`,\'\') as link from post where id < (SELECT id from post where `post`.`title_slugged` = "'.$slugged.'") order by id desc limit 1)UNION
        (select \'1\' as dummy,title,concat(\'href=\',`title_slugged`,\'\') as link from post where id > (SELECT id from post where `post`.`title_slugged` = "'.$slugged.'") order by id limit 1)')
        ;
        //dd(DB::getQueryLog());

        return $pages;
    }

    private function getCategoryList(){
        $categories = DB::table('post')
                    ->selectRaw('distinct category, count(category) as total')
                    ->groupBy('category')
                    ->orderBy('total','DESC')
                    ->orderBy('category','ASC')
                    ->get();

        return $categories;
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
        $posts = DB::table('post as p')
        ->join('users as u','u.id','=','p.author')
        ->join('comments AS c','c.post_id','=','p.title_slugged','left outer')
        ->selectRaw('u.name ,p.id,p.title,p.title_slugged, p.imagepath,p.content,p.category,COUNT(c.comment) AS comment,DATE_FORMAT(DATE(p.created_at),\'%b %e %Y\') AS created')
        ->where('u.name','=',$authorName)
        ->groupBy('p.id')
            ->orderBy('p.created_at','DESC')
            ->paginate(3);
        //dd(DB::getQueryLog());

        return $this->shortenText($posts);

    }

    private function getCategory($categoryName){
        //DB::enableQueryLog();
        $posts = DB::table('post as p')
        ->join('users as u','u.id','=','p.author')
        ->join('comments AS c','c.post_id','=','p.title_slugged','left outer')
        ->selectRaw('u.name ,p.id,p.title,p.title_slugged, p.imagepath,p.content,p.category,COUNT(c.comment) AS comment,DATE_FORMAT(DATE(p.created_at),\'%b %e %Y\') AS created')
        ->where('p.category','=',$categoryName)
        ->groupBy('p.id')
            ->orderBy('p.created_at','DESC')
            ->paginate(3);
        //dd(DB::getQueryLog());

        return $this->shortenText($posts);
    }

    private function getSearch($searchItem){

        //DB::enableQueryLog();
        $posts = DB::table('post as p')
        ->join('users as u','u.id','=','p.author')
        ->join('comments AS c','c.post_id','=','p.title_slugged','left outer')
        ->selectRaw('u.name ,p.id,p.title,p.title_slugged, p.imagepath,p.content,p.category,COUNT(c.comment) AS comment,DATE_FORMAT(DATE(p.created_at),\'%b %e %Y\') AS created')
        ->whereRaw('match (p.title, p.content) against (\''.$searchItem.'\' in natural language mode)')
            ->orwhere('u.name','=',$searchItem)
            ->orwhere('p.category','=',$searchItem)
            ->groupBy('p.id')
            ->orderByRaw('case when p.title then 1
                                when u.name then 2
                                when p.category then 3
                          end')
            ->paginate(3);
        //dd(DB::getQueryLog());

        return $this->shortenText($posts);
    }

    private function shortenText($datas){

        foreach ($datas as $data) {
            if(strlen($data->content)>150){
               $data->content = substr(strip_tags($data->content),0,150)."[...]";
            }
        }
        return $datas;
    }





}

