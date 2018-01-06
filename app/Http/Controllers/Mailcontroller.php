<?php

namespace App\Http\Controllers;

use Input;
use Mail;
use Session;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;

class Mailcontroller extends Controller
{

	public function index()
    {    	
        	return view('admin.mail.index');
    }

    public function send(request $request)
    {    	
                $validator=Validator::make($request->all(),[

             'receiveby' => 'required|email',
             'subject' => 'required',
             'message' => 'required',
             'attachment' => 'max:10240|mimes:jpeg,bmp,png,gif,zip,rar,pdf,psd,ai,cdr,rtf,doc,docx,xls,xlsx,ppt',  
    // max file size 10240 kb = 10 Mb
                    
            ]);
        if ($validator->fails()) {
            return redirect('mail')
            ->withInput()
            ->withErrors($validator);
        }

         $receiveby = $request->receiveby;
        $subject = $request->subject;
        $messages = $request->message;
        $input = Input::all();
    //  return var_dump($input['attachment']->getRealPath());

        
    

    	Mail::send('admin.mail.sendmail',compact('messages'), function ($message) use ($receiveby,$subject,$input) {     
        $message->from('makejonh4@gmail.com', 'Bunthoeun Laravel');        
        $message->to($receiveby)->subject($subject);

        if(isset($input['attachment'])){
        $message->attach($input['attachment']->getRealPath(), array(
                            'as'    => $input['attachment']->getClientOriginalName(), 
                            'mime'  => $input['attachment']->getMimeType()));
   }

    });

    	Session::flash('send_success','Mail Send is Successfully!');
    	return view('admin.mail.index');

    }
}
