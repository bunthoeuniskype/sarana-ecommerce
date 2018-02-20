<?php
  
  function settingHelper($key)
  {
   $data = \App\Setting::where('key',$key)->first();
   if($data) return $data->value;
   return '';
  }

  function makeDirectory($directory)
  {
     if(!file_exists(base_path().'/public/storage/original/'.$directory)) {
            mkdir(base_path().'/public/storage/original/'.$directory, 0777, true);
          } 

        if(!file_exists(base_path().'/public/storage/thumb/'.$directory)) {
            mkdir(base_path().'/public/storage/thumb/'.$directory, 0777, true);
          }

          if(!file_exists(base_path().'/public/storage/'.$directory)) {
            mkdir(base_path().'/public/storage/'.$directory, 0777, true);
        }
        return true;
  }

  function checkPermission($permissions){

    $userAccess = getMyPermission(auth()->user()->role);

    foreach ($permissions as $key => $value) {

      if($value == $userAccess){

        return true;

      }

    }

    return false;

  }


  function getMyPermission($name)

  {

    switch ($name) {

      case 'admin' :

        return 'admin';

        break;

      case 'sale' :

        return 'sale';

        break;

        case 'stock' :

        return 'stock';

        break;

        case 'account' :

        return 'account';

        break;

      default:

        return 'user';

        break;

    }

  }


?>