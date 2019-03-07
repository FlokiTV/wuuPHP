<?php
Router::$class  = basename(__DIR__);
Router::$path   = 'admin';
Router::routes([
    ['/', 'root'],
    ['/login', 'login'],
    ['/logout', 'logout'],
    ['/@module', 'module']
]);
Router::routes([
    ['/login', 'dologin']
],"POST");