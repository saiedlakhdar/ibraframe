<?php

namespace App\library;

use App\library\dencryptty ;
use \SessionHandler;

/**
 * Created by : SAIED.LAKHDAR.LOAI.
 * User: djelfanetwork
 * Date: 6/7/2018
 * Time: 4:20 AM
 * Filename : sessiongrip.php
 */

class Sessiongrip extends SessionHandler
{

    /**
     * @var
     */
    private $denecryptty ;
    /**
     * @var string
     */
    private $name ;

    /**
     * @var string
     */
    private $path  ;

    /**
     * @var int
     */
    private $lifetime ;

    /**
     * @var bool
     */
    private $ssl ;

    /**
     * @var string
     */
    private $domain ;

    /**
     * @var bool
     */
    private $HTTPonly ;

    /**
     * @var int
     */
    private $validuntil = 30 ; // one month

    /**
     * Sessiongrip constructor.
     * @param array $option
     * @throws \Exception
     */
    public function __construct(string $name = '' , int $lifetime = 28, string $path = '')
    {
        //array $option = ['name'=> '', 'path'=> '', 'lifetime'=>0])
        $this->setDenecryptty(new dencryptty()) ;

        $this->setup($name,$path,($lifetime*24*60*60)) ;

        $this->prepare() ;

    }

    /*******************************************
     *
     * Public Methods Section
     *
     ******************************************/

    public function __get($key)
    {
       return $_SESSION[$key] !== false ? $_SESSION[$key] : false ;
    }

    public function __set($key, $value)
    {
        return $_SESSION[$key] = $value ;
    }

    public function __isset($key)
    {
        return isset($_SESSION[$key]) ? true : false ;
    }

    public function __unset($key)
    {
        unset($_SESSION[$key]) ;
    }

    public function start()
    {
        if ($this->Isstart() === false){
            session_start() ;
        }
        return $this ;

    }

    /**
     * @param string $id
     * @return string
     */
    public function read($id)
    {
        if ($this->getDenecryptty()->den_decrypt(parent::read($id)) !== false) {
            return $this->getDenecryptty()->den_decrypt(parent::read($id)) ;
        }
        return parent::read($id) ;
    }

    /**
     * @param string $id
     * @param string $data
     * @return bool
     */
    public function write($id, $data)
    {
       return parent::write($id, $this->getDenecryptty()->den_ecrypt($data)) ;
    }

    public function test($data)
    {
        return $this->getDenecryptty()->den_ecrypt($data) ;
    }


    /*******************************************
     *
     * Private Methods Section
     *
     ******************************************/

    /**
     * @param string $name
     * @param string $path
     * @param int $lifetime
     */
    private function setup(string $name , string $path , int $lifetime )
    {
        if ($name == null){ $name = SESSNAME; }
        $this->setName($name) ;

        if ($path == ''){ $path = BDIR."sessions".DS ; }
        $this->setPath($path) ;

        $this->setSsl(isset($_SERVER['HTTPS']) ? true : false) ;

        $this->setHTTPonly(true) ;

        // iam not comfortable
        $this->setDomain(str_replace("www.", "", $_SERVER['SERVER_NAME'])) ;

        $this->setLifetime($lifetime) ;

    }

    private function prepare()
    {
        // php.ini file set parameters
        ini_set('session.use_cookies',1);
        ini_set('session.use_only_cookies',1);
        ini_set('session.use_trans_sid',0);
        ini_set('session.save_handler','files');
        ini_set('session.save_path',$this->getPath());

        //
        session_name($this->getName());
        session_save_path($this->getPath()) ;
        session_set_cookie_params(
            $this->getLifetime(),
            '/',
            $this->getDomain(),
            $this->isSsl(),
            $this->isHTTPonly()
        );

        session_set_save_handler($this, true) ;

    }

    private function Isstart()
    {
        if (session_id() === '')
        {
            return false ;
        }
        return true ;
    }
    public function kill($specify = null)
    {
        if ($specify !== null){
            unset($_SESSION[$specify]);
        }else{
            session_unset($_SESSION);
            session_destroy() ;
        }
    }

    /*******************************************
     *
     * Setter & getter Methods ses
     *
     ******************************************/


    /**
     * @return string
     */
    private function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Sessiongrip
     */
    private function setName(string $name) : Sessiongrip
    {
        $this->name = $name;
        return $this ;
    }

    /**
     * @return string
     */
    private function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Sessiongrip
     */
    private function setPath(string $path) : Sessiongrip
    {
        $this->path = $path;
        return $this ;
    }

    /**
     * @return int
     */
    private function getLifetime(): int
    {
        return $this->lifetime;
    }

    /**
     * @param int $lifetime
     * @return Sessiongrip
     */
    private function setLifetime(int $lifetime) : Sessiongrip
    {
        $this->lifetime = $lifetime;
        return $this ;
    }

    /**
     * @return bool
     */
    private function isSsl(): bool
    {
        return $this->ssl;
    }

    /**
     * @param bool $ssl
     * @return Sessiongrip
     */
    private function setSsl(bool $ssl) : Sessiongrip
    {
        $this->ssl = $ssl;
        return $this ;
    }

    /**
     * @return string
     */
    private function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return Sessiongrip
     */
    private function setDomain(string $domain) : Sessiongrip
    {
        $this->domain = $domain;
        return $this ;
    }

    /**
     * @return bool
     */
    private function isHTTPonly(): bool
    {
        return $this->HTTPonly;
    }

    /**
     * @param bool $HTTPonly
     * @return Sessiongrip
     */
    private function setHTTPonly(bool $HTTPonly) : Sessiongrip
    {
        $this->HTTPonly = $HTTPonly;
        return $this ;
    }

    /**
     * @return int
     */
    private function getValiduntil(): int
    {
        return $this->validuntil;
    }

    /**
     * @param int $validuntil
     * @return Sessiongrip
     */
    private function setValiduntil(int $validuntil) : Sessiongrip
    {
        $this->validuntil = $validuntil;
        return $this ;
    }

    /**
     * @return dencryptty
     */
    public function getDenecryptty(): dencryptty
    {
        return $this->denecryptty;
    }

    /**
     * @param dencryptty $denecryptty
     * @return Sessiongrip
     */
    public function setDenecryptty(dencryptty $denecryptty) : Sessiongrip
    {
        $this->denecryptty = $denecryptty;
        return $this ;
    }















}