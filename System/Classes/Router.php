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
                $this->controller = $url[0];
                unset($url[0]);
            }else{
                echo "<div style=margin:0;padding:10px;background-color:silver>$url[0].php Not Found</div>";
            }

            //Include Controller
            require_once "../Application/Controller/" . $this->controller . ".php";

            //instantiate controller
            $this->controller = new $this->controller;
            
            if(isset($url[1])){
                if(method_exists($this->controller, $url[1])){
                    $this->method = $url[1];
                    unset($url[1]);
                }else{
                    echo "<div style=margin:0;padding:10px;background-color:silver>$url[1] method Not Found</div>";
                    // die('Method '.$url[1].' not found in '. $this->controller.'.php');  
                }
            }
        }
        if(isset($url)){
            $this->params = $url;
        }else{
            $this->params = [];
        }

        call_user_func_array([$this->controller , $this->method] , $this->params);
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