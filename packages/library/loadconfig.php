<?php

namespace App\Library;


class Loadconfig
{

    /**
     * this array have all .env data which is database's info one of them
     * @var array
     */
    protected $_configdata = [] ;

    /**
     * @var string
     */
    protected $_configpath =  '.env'  ;

    /**
     *
     * @var string
     */
    protected $_pattern     = '/^([A-Z_]+)=(.*)$/' ;

    /**
     * @param $arg
     * @return mixed
     */
    public function __get($arg)
    {
        if (array_key_exists($arg ,$this->_configdata ))
        {
            return ($this->_configdata[$arg]);
//             false ;
        }
        return $this->{$arg}  ;
    }

    /**
     * Method for fetting .enc data into array
     */
    public function __construct($file = null )
    {
        if ($file == null ){
            $file =$this->_configpath ;
        }
        $file =  BDIR . $file ;
        if (file_exists($file)){
            $data = file_get_contents($file) ;
            $converted = explode("\n", $data) ;
            foreach ($converted as $converts){
                preg_match($this->_pattern, $converts, $result ) ;
                if (!empty($result)) {
                    $this->_configdata[strtolower($result[1])] = trim($result[2]," \r") ;
                }
            }
        }
    }


}