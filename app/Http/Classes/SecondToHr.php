<?php

class SecondToHr
{
	
	function __construct(argument)
	{
		# code...
	}
	function secToHR($seconds) {
	  $hours = floor($seconds / 3600);
	  $minutes = floor(($seconds / 60) % 60);
	  $seconds = $seconds % 60;
	  return "$hours:$minutes:$seconds";
	}

}

