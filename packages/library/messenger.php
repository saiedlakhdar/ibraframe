<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/25/2020
 * Time:        8:15 AM
 * Filename :   messenger.php
 */

namespace App\library;


class Messenger
{
    const SUCCESS_MGS   = 1 ;
    const WARNING_MGS   = 2 ;
    const ERROR_MGS     = 3 ;
    const INFO_MGS      = 4 ;
    const NOTICE_MGS    = 5 ;
    private static $_instance   ;
    private $_session           ;
    private $_messages      = []    ;

    public function __construct(Sessiongrip $session)
    {
        $this->_session = $session ;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance(Sessiongrip $session)
    {
        if (self::$_instance == null){
            self::$_instance = new self($session) ;
        }
        return self::$_instance ;
    }

    public function send($msg , $type = self::SUCCESS_MGS)
    {
            if (!$this->sessionexists()){
                $this->_session->messages = [] ;
            }
        $msgs = $this->_session->messages ;
        $msgs[] = [$msg, $type] ;
        $this->_session->messages = $msgs ;
    }

    public function sessionexists(){
        return isset($this->_session->messages) ;
    }

    public function getmessages()
    {
        if ($this->sessionexists()){
            $this->_messages = $this->_session->messages  ;
            unset($this->_session->messages) ;
            return $this->_messages ;
        }
        return [] ;
    }

}