<?php

class Logger{
    public static $level;
    function e($str){
        $lvl = self::$level;
        switch($lvl){
            case 'html.comment':
                echo '<!-- '.$str.' -->';
                break;
            case 'script':
                echo '<script>console.log("'.$str.'")</script>';
                break;
            case 'script.alert':
                echo '<script>alert("'.$str.'")</script>';
                break;
            default:
                echo '<br>'.$str.'<br>';
        }
    }
}