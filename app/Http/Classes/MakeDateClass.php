<?php
 
namespace App\Http\Classes;
 
class MakeDateClass {

 public function makeDateFrom($d)
    {
     $date = new \DateTime($d);
    $date->add(new \DateInterval('PT00H00S'));
     return $date->format('Y-m-d H:i:s');
    }

    public function makeDateEnd($d)
    {
     $date = new \DateTime($d);
    $date->add(new \DateInterval('PT24H00S'));
    return $date->format('Y-m-d H:i:s');
    }

}
