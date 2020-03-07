<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/24/2020
 * Time:        2:55 AM
 * Filename :   auth.php
 */

namespace App\controllers\common;


use App\library\Sessiongrip;

class AuthsController
{

    private static $_instance   ;
    /**
     * @var Sessiongrip
     */
    private $_session           ;

    private $_defaultAllowed    = [
        '/auth/default',
        '/auth/login',
        '/auth/register',
        '/auth/logout',
        '/auth/accessdenied',
        '/language/ar',
        '/language/en',
        '/myprofile/default',
        '/settings/default',
        '/index/default',
        '/index/notfound',
        '/index/test',
        '/noufound/default',
    ] ;

    private function __construct(Sessiongrip $sessions)
    {
        $this->_session = $sessions ;
    }

    private function __clone()
    {
    }

    public static function getInstance(Sessiongrip $sessions)
    {
        if (self::$_instance === null){
            self::$_instance = new self($sessions) ;
        }
        return self::$_instance ;
    }


    public function loginSysAuthorized()
    {
        return isset($this->_session->uid) ;
    }

    public function isAccess($controller, $action)
    {
        $route = '/'. $controller .'/'.$action ;
       if (in_array($route,$this->_defaultAllowed) || in_array($route,$this->_session->uid->privileges)) {
           return true ;
       }
       return false ;
    }


}