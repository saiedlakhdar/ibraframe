<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/25/2020
 * Time:        8:12 AM
 * Filename :   ValidTrait.php
 */

namespace App\traits;


use App\library\Messenger;

trait ValidTrait
{

    private $_patterns = [
        'num'          => '/^[0-9]+(?:\.[0-9]+)?$/',
        'int'          => '/^[0-9]+$/',
        'float'        => '/^[0-9]+\.[0-9]+$/',
        'alpha'        => '/^[a-zA-Z\p{Arabic}]+$/u',
        'vstring'      => '/^[a-zA-Z\p{Arabic}0-9_]+$/u',
        'email'        => '/^[a-zA-Z0-9._]+@[a-zA-Z0-9.]+\.[a-zA-Z]{2,}$/',
        'url'          => '/^(?:(?:http)(?:s)?:\/\/)?(?:ww[w23]\.)?(?:[a-zA-Z0-9_.-]+)(?:[a-zA-Z]{2,})(?:\/[\S]+)?$/',
        'phone'        => '/^(?:[+]|[00])?[0-9]{6,15}$/',
        'ipv4'         => '/^(?:(?:[0-1][0-9][0-9]|[2][0-5][0-5]|[0-9][0-9]|[0-9])(?:\.))+(?:[0-1][0-9][0-9]|[2][0-5][0-5]|[0-9][0-9]|[0-9])$/',
        'ddate'        => '/^([1-9][0-9][0-9][0-9])-((:?[0][1-9]|[1-9])|[1][02])-((:?[0][1-9])|[12][0-9]|[1-9]|[3][0-2])$/'
    ] ;

    private $_methodparams = [
        'onep'          =>  ['req','num','int','float','ddate','alpha','vstring','email','url','phone'] ,
        'twop'          =>  ['lt','gt','min','max','eq','eqf'] ,
        'threep'        =>  ['between','lendecimal'] ,

    ];


    /**---------------------------------------------------
     *     ONE PARAMATER METHODS
    ---------------------------------------------------*/

    /**
     * @param $value
     * @return bool
     * ====> required field
     */
    public function req($value)
    {
        return '' != $value || !empty($value);
    }

    /**
     * @param $value
     * @return bool
     * ====>  matchs numbers with comma
     */
    public function num($value)
    {
        return (bool) preg_match($this->_patterns['num'],$value) ;
    }

    /**
     * @param $value
     * @return bool
     * ====>  matchs numbers only
     */
    public function int($value)
    {
        return (bool) preg_match($this->_patterns['int'],$value) ;
    }

    /**
     * @param $value
     * @return bool
     * ====>  matchs Floats
     */
    public function float($value)
    {
        return (bool) preg_match($this->_patterns['float'],$value) ;
    }

    /**
     * @param $value
     * @return bool
     * ====>  matchs date
     */
    public function ddate($value)
    {
        return (bool) preg_match($this->_patterns['ddate'],$value) ;
    }

    /**
     * @param $value
     * @return bool
     * ====>  matchs string without numbers & symbols
     */
    public function alpha($value)
    {
        return (bool) preg_match($this->_patterns['alpha'],$value) ;
    }

    /**
     * @param $value
     * @return bool
     * ====>  matchs string without symbols except underscore _
     */
    public function vstring($value)
    {
        return (bool) preg_match($this->_patterns['vstring'],$value) ;
    }
    /**
     * @param $value
     * @return bool
     * ====>  matchs email only http or https (ftp ,ftps, sftp, smtp are not allowed )
     */
    public function email($value)
    {
        return (bool) preg_match($this->_patterns['email'],$value) ;
    }

    /**
     * @param $value
     * @return bool
     * ====>  matchs url
     */
    public function url($value)
    {
        return (bool) preg_match($this->_patterns['url'],trim($value, '/')) ;
    }

    /**
     * @param $value
     * @return bool
     * ====>  matchs international phone number maximoum length 15 digit
     */
    public function phone($value)
    {
        return (bool) preg_match($this->_patterns['phone'],$value) ;
    }


    /**---------------------------------------------------
     *     TOW PARAMATER METHODS
    ---------------------------------------------------*/
    /**
     * @param $value
     * @param $equal
     * @return bool
     * ====> equality two values
     */
    public function eq($value , $equal)
    {

            return $value == $equal ;

    }

    /**
     * @param $value
     * @param $equalfield
     * @return bool
     * ====> equality tow fields
     */
    public function eqf($value , $equalfield)
    {

        return $value == $equalfield ;

    }
    /**
     * @param $value
     * @param int $against
     * @return bool
     * ====>  match value (LessThen)< against
     */
    public function lt($value ,int $against)
    {
        if (is_string($value)){
            return mb_strlen($value) < $against ;

        }elseif(is_numeric($value)){
            return $value < $against ;
        }
        return false ;
    }

    /**
     * @param $value
     * @param int $against
     * @return bool
     * ====>  match value (GreaterThen)> against
     */
    public function gt($value ,int $against)
    {
        if (is_string($value)){
            return mb_strlen($value) > $against ;

        }elseif(is_numeric($value)){
            return $value > $against ;
        }
        return false ;
    }

    /**
     * @param $value
     * @param int $min
     * @return bool
     * ====>  match value minimum length <= min
     */
    public function min($value ,int $min)
    {
        if (is_string($value)){
            return mb_strlen($value) >= $min ;

        }elseif(is_numeric($value)){
            return $value >= $min ;
        }
        return false ;
    }

    /**
     * @param $value
     * @param int $max
     * @return bool
     * ====>  match value maximum length  >= max
     */
    public function max($value ,int $max)
    {
        if (is_string($value)){
            return mb_strlen($value) <= $max ;

        }elseif(is_numeric($value)){
            return $value <= $max ;
        }
        return false ;
    }


    /**---------------------------------------------------
     *     TREE PARAMATER METHODS
    ---------------------------------------------------*/

    /**
     * @param $value
     * @param int $min
     * @param int $max
     * @return bool
     * ====>  match value length between min, max
     */
    public function between($value ,int $min , int $max)
    {
        if (is_string($value)){
            return (mb_strlen($value) >= $min) && (mb_strlen($value) <= $max) ;

        }elseif(is_numeric($value)){
            return $value >= $min && $value <= $max ;
        }
        return false ;
    }

    /**
     * @param $value
     * @param $after
     * @param $before
     * @return bool
     * ====>  check if value is float then match numbers length before , after comma
     * !!!!! Notice : last 0 in the value isn't counted Ex : 11.20 <- means 11.2 output (value =11.20 , after=2, before =1 ) last 0 not catched
     */
    public function lendecimal($value, $after, $before)
    {
        if ($this->float($value)){
            $match = '/^[0-9]{'.$after.'}\.[0-9]{'.$before.'}$/';
            var_dump($match);
            var_dump(preg_match($match, $value));
            return (bool) preg_match($match, $value) ;
        }
        return false ;
    }


    /**---------------------------------------------------
     *     MATCHING METHOD
    ---------------------------------------------------*/


    public function is_valid($rules , $method = [])
    {
        $errors = [] ;
        if (empty($method)){
            $method = $_POST ;
        }
        if (!empty($rules)) {
            foreach ($rules as $field => $rule) {
                $validrules = explode('|', $rule) ;
                foreach ($validrules as $validrule) {
                    if (array_key_exists($field, $errors))
                        continue ;
                    if (preg_match_all('/^([a-z0-9]+)(?:\((\S+)\))?/' ,$validrule, $m)){
                        if (in_array($m[1][0] , $this->_methodparams['onep'] ) ){
                            // check if in array onep
                            if($this->{$m[1][0]}($method[$field]) === false ){
                                $this->Messanger->send($this->templatelang->fill('error_text_'. $m[1][0] , [$this->templatelang->get('users_text_'.$field)] ),Messenger::ERROR_MGS) ;
                                $errors[$field] = true ;
                            }
                        }elseif (in_array($m[1][0] , $this->_methodparams['twop'] ) ){
                            // check if eqf cqlled
                            if ($m[1][0] == 'eqf'){
                                if($this->{$m[1][0]}($method[$field],$method[$m[2][0]]) === false ){
                                    $this->Messanger->send($this->templatelang->fill('error_text_'. $m[1][0] , [$this->templatelang->get('users_text_'.$field) , $this->templatelang->get('users_text_'.$m[2][0])  ] ),Messenger::ERROR_MGS) ;
                                    $errors[$field] = true ;
                                    continue ;
                                }
                            }elseif($this->{$m[1][0]}($method[$field],$m[2][0]) === false ){
                                // check if in array twop
                                $this->Messanger->send($this->templatelang->fill('error_text_'. $m[1][0] , [$this->templatelang->get('users_text_'.$field) , $m[2][0]] ),Messenger::ERROR_MGS) ;
                                $errors[$field] = true ;
                            }
                        }elseif (in_array($m[1][0] , $this->_methodparams['threep'] ) ){
                            // check if in array onep
                            $mm = explode(',', $m[2][0]) ;
                            if($this->{$m[1][0]}($method[$field],$mm[0],$mm[1]) === false ){
                                $this->Messanger->send($this->templatelang->fill('error_text_'. $m[1][0] , [$this->templatelang->get('users_text_'.$field) , $mm[0],$mm[1] ] ),Messenger::ERROR_MGS) ;
                                $errors[$field] = true ;
                            }
                        }
                    }
                }
            }
        }
        return empty($errors) ? true : false ;
    }

}