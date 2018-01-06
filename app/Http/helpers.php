<?php


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