<?php

class Dashboard{
    public static $Template;
    public static $menu;
    public static $routes;
    public function root(){
        $vault = Vault::open("admin");
        if(!$vault) Router::redirect("admin/login");
        self::$Template->render(["home"=>["teste"=>'hi']]);
    }
    public function login(){
        $vault = Vault::open("admin");
        if($vault) Router::redirect("admin");
        self::$Template->render(["login"=>["r"=>$vault]]);
    }
    public function module($module){
        $config = $module;
        if($config){
            self::$Template->render(["module"=>["f"=>$config]]);
        }else{
            return true;
        }
    }
    public function dologin(){
        echo json_encode(Vault::auth((object)[
            'id'=>1,
            'role'=>'admin'
        ]));
        $vault = Vault::open("admin");
        if($vault) Router::redirect("admin");
        else Router::redirect("admin/login");
    }
    public function logout(){
        Router::redirect("admin/login");
        return Vault::close();
    }
}