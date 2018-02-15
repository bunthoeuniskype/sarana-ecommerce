<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Delatbabel\Elocrypt\Elocrypt;
use DB;
use Image;
class Customer extends Model
{
	
	use Elocrypt;

	protected $table='customer';
    protected $fillable = [ 'firstname', 'lastname', 'email', 'phone', 'gender', 'address', 'description', 'image', 'created_at', 'updated_at', 'status', 'verify', 'dob', 'account_number' ];

    protected $encrypts = [];

public function sale(){
	return $this->hasMany("App\Sale","customer_id");
}

public function get_column()
{
   return array(
        array('data'=>'First Name', 'align' => 'left'), 
        array('data'=>'Last Name', 'align' => 'left'),
        array('data'=>'Gender', 'align' => 'left'),
        array('data'=>'Date of Birth', 'align' => 'left'),
        array('data'=>'Email', 'align' => 'left'),
        array('data'=>'Phone', 'align' => 'left'),        
        array('data'=>'Address', 'align' => 'left'),        
    
       );
}

public function get_summary()
{
   return DB::table($this->table)->select(DB::raw('COUNT(*) as total'))->where('status',1)->first();
}

 static function uploadImageProfile($file){

    $directory =  'public/storage/users';
    $directoryOrigin =  'public/storage/original/users';    
    makeDirectory('users');    

    if($file){
       $destinationPath = base_path().'/'.$directory;
       $destinationPathOrigin = base_path().'/'.$directoryOrigin;
       $name = time().'-'.$file->getClientOriginalName();

      $img = Image::make($file->getRealPath());
      $img->fit(200)->save($destinationPath.'/'.$name);
      $file->move($destinationPathOrigin,  $name);
    }   
    $pathName = $directory.'/'.$name;
    return $pathName; 
    }

}
