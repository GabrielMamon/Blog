<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function postComment(Request $request){
        if($request->isMethod('post')){
            $id = Auth::id();

            DB::table('comment')
            ->insert(
                ['post_id'=>$request->input('InputPostID'),
                'user_id'=>$id,
                'comment'=>$request->input('InputCommentText')]
            );
            return redirect('/post/'.$request->input('InputPostID'));

        }else{
            redirect('/');
        }
    }
}
