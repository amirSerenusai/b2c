<?php
return [

    'driver' => env('MAIL_DRIVER', 'smtp'),

    'host' => 'smtp.gmail.com',// env('MAIL_HOST', 'smtp.mailgun.org'),

    'port' => 587,//env('MAIL_PORT', 587),

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'amir1004@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    'stream' => [
        'ssl' => [
            'allow_self_signed' => true,
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ],
    'encryption' => 'tls',//env('MAIL_ENCRYPTION', 'tls'),


    'username' => 'office@serenusai.com',//'office@medecide.net',// env('MAIL_USERNAME'),

    'password' => 'serenus111',// 'medecide111',// env('MAIL_PASSWORD'),

    'sendmail' => '/usr/sbin/sendmail -bs',

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

    'log_channel' => env('MAIL_LOG_CHANNEL'),

];
