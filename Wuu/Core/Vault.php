<?php
@session_start();

class Vault{
    public function open($vault, $redirect=false){
        if(!self::isAuth($vault)){
            if($redirect) Router::redirect("admin/login");
            else return self::close();
        }else{
            return true;
        }
    }
    public function close(){
            unset($_SESSION['vault']);
            return (isset($_SESSION['vault']));
    }
    public function auth($arr){
        return $_SESSION['vault'] = $arr;
    }
    public function isAuth($role){
        return ( isset($_SESSION['vault']) && $_SESSION['vault']->role == $role )? $_SESSION['vault'] : false;
    }
}