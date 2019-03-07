<?php

class Autoload {
    public $dir;
    public $subxt;
    public $class;
    function load(){
        $dir    = ( ($this->dir)    ? $this->dir        :'' );
        $class  = ( ($this->class)  ? $this->class      :false );
        $subxt  = ( ($this->subxt)  ? $this->subxt      :false );
        if($this->class){
            return  $dir . $class .$ext ;
        }else{
            $dh = new DirectoryIterator($dir);
            foreach ($dh as $item) {
                if(!$item->isDot() && !$item->isDir()){
                    $ext = explode(".",$item->getFilename());
                    $file   = $item->getFilename();
                    //autoload.php
                    if(count($ext) < 3 && !$subxt){
                        $ext    = $ext[count($ext)-1];
                        $this->require($file);
                    }elseif(count($ext) > 2 && !$subxt){
                        $ext    = $ext[count($ext)-1];
                        $this->require($file);
                    }elseif($subxt && count($ext) > 2){ //autoload.class.php -- if subxt exist
                        $sub = $ext[count($ext)-2];
                        $ext = $ext[count($ext)-1];
                        if($subxt==$sub){
                            $this->require($file);
                        }
                    }
                }
            }
        }
    }
    function require($file){
        if($file != basename(__FILE__)){
            echo '<!-- load:: '.$file." -->\n";
            require_once $this->dir.$file;
        }
    }
    function allFiles($dir){
        $this->dir = $dir."/";
        $this->load();
    }
    function modules(){
        $dir            = dirname(__DIR__).'/Modules/';
        $dh             = new DirectoryIterator($dir);
        foreach ($dh as $item) {
            $file = $item->getFilename();
            if(!$item->isDot() && $item->isDir()){
                $this->dir = $dir.$file."/";
                $ext    = ".class.php";
                $ff     = $this->dir.$file.$ext;
                if(is_file($ff)) $this->require($file.$ext);
            }
        }
        foreach ($dh as $item) {
            $file = $item->getFilename();
            if(!$item->isDot() && $item->isDir()){
                $this->dir = $dir.$file."/";
                // Important order !!!
                $files = [
                    'init',
                    'routes'
                ];
                foreach($files as $f){
                    $ext    = ".".$f.".php";
                    $ff     = $this->dir.$file.$ext;
                    if(is_file($ff)) $this->require($file.$ext);
                }
                #$this->allFiles($dir.$file);
            }
        }
    }
}

$load = new Autoload();
// $load->subxt = 'load';
$load->allFiles(__DIR__);
$load->allFiles(__DIR__.'/../Libs');
$load->modules();