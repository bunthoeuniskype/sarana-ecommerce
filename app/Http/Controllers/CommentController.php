<?php

namespace App\Modules\Site\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Site\Models\Comment;

use Auth;
use Session;
use Redirect;
use Validator;
use DB;
use App;
use Carbon\Carbon;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     
    }

  
    public function postComment(Request $request)
    {
          $validator=Validator::make($request->all(),[
         'description' => 'required', 
            ]);

        if ($validator->fails()) {
           return 'Comment is Field!';          
        }

       $comment = new Comment();
       $comment->description = $request->description;
       $comment->post_group_id = $request->post_group_id;       
       $comment->customer_id = Session::get('customer')->id;
       $comment->created_at = Carbon::now("Asia/Bangkok");
      
       if($comment->save()){
        return 'Comment is Successfully';
       }else{        
         return 'Comment is Failed';
       }

    }

     public function getComment(Request $request)
    {      
       $comment = Comment::where(['status'=>1,'post_group_id'=>$request->post_group_id])->orderBy('id','DESC')->limit(5)->get(); 
       $post_group_id =  $request->post_group_id;     
       return view('Site::comment', compact('comment','post_group_id'));

    }

    public function getCommentAll(Request $request)
    {      
       $comment = Comment::where(['status'=>1,'post_group_id'=>$request->post_group_id])->orderBy('id','DESC')->get(); 
       $post_group_id =  $request->post_group_id;     
       return view('Site::comment', compact('comment','post_group_id'));

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
