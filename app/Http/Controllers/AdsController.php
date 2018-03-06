<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ads;
use App\Language;
use App\Http\Classes\Youtube;

use Auth;
use Session;
use Redirect;
use Validator;
use DB;
use App;

class AdsController extends Controller
{

    public function index()
    {     
       $advertisement = Ads::all();         
       return view("admin.ads.index",compact('advertisement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = Ads::max('order');           
        return view('admin.ads.add',compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    public function store(Request $request)
    {

       /* $val =  Validator::make($request->all(),[
            'video_id' => 'required|min:3|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'image' =>  'required',
            ]);
         
            $err = array();
            foreach ($val->errors()->getMessages() as $key => $value) {
              $err[] = array($key => $value[0]);
            }
       
        return json_encode($err);*/

        $youtube = new Youtube();       

        $ads = new Ads($request->all());
        $ads->video_id = $youtube->getYouTubeVideoId($request->video_id);
      if($ads->save()){
        Session::flash('save','Save is Successfully!');
        }else{
        Session::flash('save','Save is faild!');   
        }
      
      return Redirect::back();
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
        $advertisement = Ads::findOrFail($id);         
        return view('admin.ads.edit',compact('advertisement'));
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

        $youtube = new Youtube();  

        $ads = Ads::findOrFail($id);

        $ads->title = $request->title;
        $ads->description = $request->description;
        $ads->ads_type = $request->ads_type;
        $ads->location = $request->location;
        $ads->image = $request->image;
        $ads->video_id = $youtube->getYouTubeVideoId($request->video_id);
        $ads->order = $request->order;
        $ads->status = $request->status;

      if($ads->save()){
        Session::flash('save','Save is Successfully!');
        }else{
        Session::flash('save','Save is faild!');   
        }

     return redirect('admin/advertisement');
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
