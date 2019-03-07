<?php
require_once 'flight/Flight.php';
// Flight::route('*', function(){ Auth::route(Flight::request()); });
class Router{
    public static $class;
    public static $path;
    function init(){
        Flight::start();
    }
    function get($path, $fn){
        Flight::route("GET {$path}", self::class($fn));
    }
    function post($path, $fn){
        Flight::route("POST {$path}", self::class($fn));
    }
    function routes($routes, $method = "GET"){
        foreach($routes as $route){
            $path   = (isset(self::$path) )  ? "{$method} /".self::$path.$route[0]    :$route[0];
            $fn     = self::class($route[1]);
            Flight::route($path,$fn);
        }  
    }
    function class($fn){
        return (isset(self::$class)) ? [self::$class, $fn] : $fn;
    }
    // return request method [ GET, POST, PUT, DELETE ]
    function method()   { return self::request()->method; }
    function request()  { return Flight::request(); }
    function isAjax()   { return (self::request()->ajax)? true:false;  }
    function isPOST()   { return (self::request()->method == "POST")? true:false; }
    function isGET()    { return (self::request()->method == "GET")? true:false; }
    // redirect with status code
    function redirect($path,$code="301"){ Flight::redirect($path,$code); }

}