<?php


return array(
/** set your paypal credential **/
'client_id' =>'Af3NAUTrvBKWLX3OzkTD_CqKb5RxfvSi9vevG9pCYkdlkXWroF2gg6gxIWH32KjLM5uLdgKNssxQbFEp',
'secret' => 'EG3LD4N_szWPAMm4HBzCZvJA-u10f6STV1DifABFptB3U-SZD1K-9EE5q6WT1U2tYTBvL0GAplU3aBaJ',
/**
* SDK configuration 
*/
'settings' => array(
    /**
    * Available option 'sandbox' or 'live'
    */
    'mode' => 'sandbox',
    /**
    * Specify the max request time in seconds
    */
    'http.ConnectionTimeOut' => 3000,
    /**
    * Whether want to log to a file
    */
    'log.LogEnabled' => true,
    /**
    * Specify the file that want to write on
    */
    'log.FileName' => storage_path() . '/logs/paypal.log',
    /**
    * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
    *
    * Logging is most verbose in the 'FINE' level and decreases as you
    * proceed towards ERROR
    */
    'log.LogLevel' => 'FINE'
    ),
);