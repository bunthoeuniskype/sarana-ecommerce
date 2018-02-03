<?php

return array(
'driver' => 'smtp',
'host' => 'smtp.gmail.com',
'port' => 587,
'from' => ['address' => 'reply@admin.com', 'name' => 'MIS TEAM'],
'encryption' => 'tls',
'username' => 'makejonh4@gmail.com',
'password' => '*******',
'sendmail' => '/usr/sbin/sendmail -bs',
'pretend' => false,

    'stream' => [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
    ],
]

);