<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/25/2020
 * Time:        7:11 AM
 * Filename :   Chef.php
 */

namespace App\library;


class Chef
{

    private static $_instance ;

    private function __construct(){ }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if (self::$_instance == null){
            self::$_instance = new self() ;
        }
        return self::$_instance ;
    }

    public function __get($key)
    {
        return $this->$key ;
    }

    public function __set($key , $value )
    {
        $this->$key = $value ;
    }


}