<?php

class www{
    public static $name;
    public function home(){
        echo "Welcome to ".self::$name;
    }
}