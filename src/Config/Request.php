<?php

namespace System\Config;

class Request{


    static private function createRouteRequest(){
        $request_path = $_SERVER['REQUEST_URI'];
        $request_method = strtoupper($_SERVER['REQUEST_METHOD']);
        $request_get = $_GET;
        $request_post = $_POST;

        if(defined('ROUTER_EXCEPTION'))
            $request_path = str_replace(ROUTER_EXCEPTION, "", $request_path);

        if(substr($request_path, -1) != "/") $request_path .= "/";

        $request = (object) array(
            "path" => $request_path,
            "params" => array(),
            "method" => $request_method,
            "get" => $request_get,
            "post" => $request_post
        );

        return $request;
    }

    static private function isParam($text){ return (strpos($text, ":") !== false); }

    static function route($method, $routePath, $lambda, $dir = false, $file_position = 0){
        try {
            $req = Request::createRouteRequest();
            $res = "res";

            if(strtoupper($method) != $req->method) throw new \Error();

            if(defined('ROUTER_EXCEPTION'))
                $routePath = str_replace(ROUTER_EXCEPTION, "", $routePath);

            if(substr($routePath, -1) != "/") $routePath .= "/";

            $splitPath = explode("/", $req->path);
            $routePath = explode("/", $routePath);

            for($i = 1; $i < count($routePath); $i++) {
                if(Request::isParam($routePath[$i])){

                    if($splitPath[$i] == "") throw new \Error();

                    $req->params += [ str_replace(":", "", $routePath[$i]) => $splitPath[$i] ];

                } else if(strtoupper($routePath[$i]) != strtoupper($splitPath[$i])) throw new \Error();
            }

            $req->params = (object) $req->params;

            if($dir){
                $file_position++;

                if($file_position >= count($splitPath) - 1 || $file_position <= 0) $file_position = 1;

                if(substr($dir, -1) != "/") $dir .= "/";

                $dir = $dir . $splitPath[$file_position] . ".php";

                if (!file_exists($dir)) throw new \Error();
            }

            $dir?
                $lambda($req, $res, $dir)
                :
                $lambda($req, $res)
            ;
            die;
        } catch (\Error $e) { }
    }

    static function anyRoute($method, $lambda, $dir){
        try {
            $req = Request::createRouteRequest();

            if(strtoupper($method) != $req->method) throw new \Error();

            $splitPath = explode("/", $req->path);

            $file_position = 1;

            if(substr($dir, -1) != "/") $dir .= "/";

            $dir = $dir . $splitPath[$file_position] . ".php";

            if (!file_exists($dir)) throw new \Error();

            $lambda($req, $dir);
            die;
        } catch (\Error $e) { }
    }

}