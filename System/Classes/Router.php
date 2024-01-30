<?php

class Router{
    //default controller , method and params

    public $controller = "Welcome";
    public  $method     = "index";
    public $params = [];

    public function __construct(){
        $url = $this->url();
        if(!empty($url)){
            if(file_exists("../Application/Controller/". $url[0] .".php")){
                echo "Controller Found";
            }else{
                echo "Controller Not Found";
            }
        }
    }

    public function url(){
        if(isset($_GET['url'])){
            $url = $_GET['url'];
            $url = rtrim($url);
            $url = filter_var($url , FILTER_SANITIZE_URL);
            $url = explode("/" , $url);
            return $url;
        }
    }
}