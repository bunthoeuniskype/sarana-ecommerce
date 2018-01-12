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

   static function time_elapsed_string($datetime, $full = false) {
    $now = new \DateTime;
    $ago = new \DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
         'y' => 'year',
         'm' => 'month',
         'w' => 'week',
         'd' => 'day',
         'h' => 'hour',
         'i' => 'minute',
         's' => 'second',
     );
     foreach ($string as $k => &$v) {
         if ($diff->$k) {
             $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
         } else {
             unset($string[$k]);
         }
     }

     if (!$full) $string = array_slice($string, 0, 1);
     return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
