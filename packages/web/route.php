<?php

namespace Web ;


class Route {
    public static $route = [] ; 

    // GET method 
    public static function get($pattern, $callback, $ajax = false )
    {
         self::map(['GET'], $pattern, $callback, $ajax ) ;
    }

    // POST method 
    public static function post($pattern, $callback, $ajax = false )
    {
         self::map(['POST'], $pattern, $callback, $ajax ) ;
    }

    // PUT method 
    public static function put($pattern, $callback, $ajax = false )
    {
         self::map(['PUT'], $pattern, $callback, $ajax ) ;
    }

    // DELETE method 
    public static function delete($pattern, $callback, $ajax = false )
    {
         self::map(['DELETE'], $pattern, $callback, $ajax ) ;
    }

    // PATCH method 
    public static function patch($pattern, $callback, $ajax = false )
    {
         self::map(['PATCH'], $pattern, $callback, $ajax ) ;
    }

    // OPTIONS method 
    public static function options($pattern, $callback, $ajax = false )
    {
         self::map(['OPTIONS'], $pattern, $callback, $ajax ) ;
    }

    // addRoute method 
    public static function addRoute($method, $pattern) 
    {
        switch ($method[0]) {
            case 'GET':
                return self::$route['GET'] = $pattern ; 
                break;
            case 'POST':
                return self::$route['POST'] = $pattern ; 
                break; 
            case 'PUT':
                return self::$route['PUT'] = $pattern ; 
                break;
            case 'DELETE':
                return self::$route['DELETE'] = $pattern ; 
                break; 
            case 'PATCH':
                return self::$route['PATCH'] = $pattern ; 
                break;
            case 'OPTIONS':
                return self::$route['OPTIONS'] = $pattern ; 
                break; 
            default:
                break;
        }
        self::$route = $method ;
    }

    // MAP method 
    private static function map($method, $pattern, $callback, $ajax = false ) 
    {
        // if the request method is not in not "REQUEST_METHOD"
        if(!in_array(strtoupper($_SERVER['REQUEST_METHOD'] ) , $method))
        {
            return ; 
        }

        // chech if "AJAX" valid 

        if (in_array('AJAX', $method) && (strtoupper($_SERVER['HTTP_X_REQUESTED_BY']) != 'XMLHTTPREQUEST') ) 
        {
            return ; 
        }

        $regex = preg_replace("/\{(.*)\}/", "{\?p<$0>[\w]+}", $pattern) ; 

        // send regex starting with #^ and ending by $#
        $regex  = "#^" . trim($_GET['route'], "/") . "$#"  ;

        // matches the pattrens and trim GET['route'] from "/"
        preg_match($regex, trim($_GET['route'] , "/"), $matches) ;

        // check if $callback is callable and called 
        if ($matches ) {
            if (is_callable($callback)) 
                {
                    call_user_func($callback) ;
                }  
                else 
                {
                    if (!preg_match("/^[\w+]*@[\w+]*$/", $callback)) {
                        echo "is not valid method and controller " ;
                    }
                    preg_match("/([\w+]*)@/" , $callback, $callbackMethod) ;
                    preg_match("/@([\w+]*)/" , $callback, $callbackController) ;
                    


                
                }
        }





    }
}