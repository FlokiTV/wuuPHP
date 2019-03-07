<?php

class Template{
    public $info    = [];      //Guarda informações do site -> $header['info'];
    public $header  = [];      //Variáveis do header
    public $scripts = [];      //array de  scripts
    public $styles  = [];      //array de  styles
    public $globals = [];      //array de  arr globais
    public $gAnalytics;        //GoogleAnalytics ID
    public $meta;              //Meta Content
    public $vars;
    public $path;
    function set($key, $value)              { $this->vars[$key] = $value; }
    function get($key)                      { return (isset($this->vars[$key])? $this->vars[$key] : false); }
    function view($dir)                     { $this->path = $dir;}
    // 
    // Render (<array>['template'=>array()])
    // 
    function render($render)                {
                                                $this->header();
                                                foreach($render as $view => $arr) $this->renderFile($view, $arr);
                                                $this->renderFile('footer');
                                            }
    // !! NEED REWORK !!
    function renderGlobal($name,$file) { 
                                                $this->globals[$name] = file_get_contents($this->path.$file.".php");
                                            }
    function renderFile($file,$vars=[])     { 
                                                if($vars) extract($vars);
                                                include $this->path.$file.".php"; 
                                            }
    function header()                       { 
                                                $this->header['info'] = $this->info;
                                                $this->renderFile('header', $this->header); 
                                            }
    function scripts()                      { foreach($this->scripts as $name=>$src)  echo "<script id='script-".strtolower($name)."' src='{$src}'></script>\n"; }
    function styles()                       { foreach($this->styles as $name=>$src)   echo "<link id='style-".strtolower($name)."' rel='stylesheet' href='{$src}'></link>\n"; }
    function gAnalytics()                   { $id = $this->gAnalytics; echo "<script async src='https://www.googletagmanager.com/gtag/js?id={$id}'></script>\n <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', '{$id}');</script>"; }
    function meta(){
        $meta = $this->meta;
        $info = $this->info;
        $charset    = (isset($meta["charset"])) ?   $meta["charset"]        : "utf-8";
        $icon       = (isset($meta["icon"]))    ?   $meta["icon"]           : "favicon.png";
        $viewport   = (isset($meta["viewport"]))?   $meta["viewport"]       : 'width=device-width, initial-scale=1';
        $title      = (isset($meta["title"]))   ?   $meta["title"]          : $info["title"];
        $desc       = (isset($meta["description"])) ? $meta["description"]  : $info['desc'];
        $keywords   = (isset($meta["keywords"])     ? $meta["keywords"]     : self::meta_keywords( $title . " " . $desc ));
        $robots     = (isset($meta["robots"]))      ? $meta["robots"]       : 'index, follow';
        $url        = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<meta charset="<?=$charset?>">
    <link rel="icon" type="image/png" href="<?=$icon?>" />
    <meta name="viewport" content="<?=$viewport?>">
    <title><?=$title?></title>
    <meta name="description" content="<?=$desc?>">
    <meta name="keywords" content="<?=$keywords?>">
    <meta name="robots" content="<?=$robots?>">
    <meta property="og:title" content="<?=$title?>" />
    <meta property="og:url" content="<?=$url?>" />
<?php
    if(isset($meta["og"])) foreach( $meta["og"] as $type => $value) echo "<meta property='og:{$type}'  content='{$value}'/>\n";
    }#meta()
    function meta_keywords($string){
        $string = str_replace(",","",strtolower($string));
        $string = array_filter(explode(" ",$string));
        $string = array_unique($string);
        return implode(",",$string);
    }
}