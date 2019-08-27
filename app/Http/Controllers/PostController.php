<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Auth;
use DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('dashboard')->with('title','Dashboard');
    }

    public function createPost(){
        if(Auth::id()==1){ //Only id = 1 can post
            return view('create')->with('title','Create');
        }else{
            return redirect('/');
        }

    }

    public function deletePost($slug){
        if(Auth::id()==1){
            $path = DB::table('post')->select('imagepath')->where('title_slugged','=',$slug)->get();
            $imgpath = 'images/'.$path[0]->imagepath;

            DB::table('post')->where('title_slugged', '=', $slug)->delete();
            unlink($imgpath);
            return redirect('/');
        }else{

        }
    }

    public function editPost($slug){
        if(Auth::id()==1){ //Only id = 1 can post
            $postdata = $this->showPost($slug);
            return view('edit')->with('title','Edit')->with('postdata',$postdata);
        }else{
            return redirect('/');
        }
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

    public function Create(Request $request){
        $id = Auth::id();

        $checktitle = DB::table('post')
                    ->select('*')
                    ->where('title', '=', $request->input('InputPostTitle'))
                    ->get();

        if(count($checktitle)){
            $slugged_title = str_slug($request->input('InputPostTitle')).'-'.count($checktitle);
        }else{
            $slugged_title = str_slug($request->input('InputPostTitle'));
        }
            if($request->isMethod('post')){
                $image = $request->file('InputPostImage');
                $name = str_slug($request->input('InputPostTitle')).'_'.time();
                $folderpath = 'uploaded/cover/';
                $filepath=$folderpath.$name.'.'.$image->getClientOriginalExtension();

                $this->uploadOne($image,$folderpath,'public_folder',$name);

                DB::table('post')->insert(
                    [
                    'author'=>$id,
                    'title'=>$request->input('InputPostTitle'),
                    'title_slugged'=>$slugged_title,
                    'category'=>$request->input('InputPostCategory'),
                    'content'=>$request->input('InputPostContent'),
                    'imagepath'=>$filepath
                    ]
                );
                return redirect('/') ->with('msgtype', 'alert-success')
                                                ->with('msgtitle', 'Post Created!')
                                                ->with('msgcontent','A new post has been created.');
            }else{
                redirect('/create');
            }

    }

    public function Edit(Request $request){
        if($request->isMethod('post')){

            DB::table('post')
            ->where('title_slugged','=',$request->input('InputPostSlug'))
            ->update(
                ['category'=>$request->input('InputPostCategory')],
                ['content'=>$request->input('InputPostContent')]
            );
            return redirect('/') ->with('msgtype', 'alert-success')
                                            ->with('msgtitle', 'Post Updated!')
                                            ->with('msgcontent','The post has been updated.');
        }else{
            redirect('/');
        }
    }

    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public_folder', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }
}
