<?php
Dashboard::$Template = new Template();
Dashboard::$Template->view(__DIR__.'/views/');
$config = json_decode(file_get_contents(__DIR__.'/config.json'));
Dashboard::$Template->info         = (array)$config->template->info;
Dashboard::$Template->meta["icon"] = "popcorn.png";
Dashboard::$Template->info['url']  = 'http://localhost/wuu/admin/';
Dashboard::$Template->scripts      = [
    "FontAwesome"   => "https://use.fontawesome.com/releases/v5.3.1/js/all.js",
    "SimpleBar"     => "https://unpkg.com/simplebar@latest/dist/simplebar.js",
    "jQuery"        => "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js",
    "App"           => "../Wuu/Modules/Dashboard/src/js/script.js" // <- DANGER - expose module dir
];
Dashboard::$Template->styles       = [
    "Bulma"     => "https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css",
    "Theme"     => "https://jenil.github.io/bulmaswatch/superhero/bulmaswatch.min.css",
    "SimpleBar" => "https://unpkg.com/simplebar@latest/dist/simplebar.css",
    "App"       => "../Wuu/Modules/Dashboard/src/css/style.css"
];
Dashboard::$menu["Administration"] = [ "Logout"=>"logout"];