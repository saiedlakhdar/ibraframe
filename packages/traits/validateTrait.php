<?php

namespace App\traits ;

/**
 * Created by : SAIED.LAKHDAR.LOAI.
 * User: djelfanetwork
 * Date: 5/2/2018
 * Time: 7:06 PM
 * Filename : validateTrait.php
 */

trait ValidateTrait
{
    // validate ini 
    /*
    min_range - specifies the minimum integer value
    max_range - specifies the maximum integer value
    FILTER_FLAG_ALLOW_OCTAL - allows octal number values
    FILTER_FLAG_ALLOW_HEX - allows hexadecimal number values
    */
    public function validInt($int , $option = [] , $flag = [] )
    {
        return filter_var($int ,FILTER_VALIDATE_INT , array('options'=> $option ,
        'flags'=>array($flag)));
    }

    // validate Float
    public function validFloat($float )
    {
        return filter_var($float ,FILTER_VALIDATE_FLOAT);
    }

    // validate Float
    // If FILTER_NULL_ON_FAILURE is set, FALSE is returned only for "0", "false", "off", "no", and "", and NULL is returned for all non-boolean values.
    public function validbool($bool ,$flag = [])
    {
        return filter_var($bool ,FILTER_VALIDATE_BOOLEAN ,array('flags'=>array($flag)) );
    }

    // validate Email
    // flags : FILTER_FLAG_EMAIL_UNICODE
    public function validEmail($email ,$flag = [])
    {
        return filter_var($email ,FILTER_VALIDATE_EMAIL ,array('flags'=>array($flag)) );
    }

    // validate Domain
    // flags : FILTER_FLAG_HOSTNAME => adds ability to specifically validate hostnames (they must start with an alphanumberic character and contain only alphanumerics or hyphens).
    public function validDomain($domain ,$flag = [])
    {
        return filter_var($domain ,FILTER_VALIDATE_DOMAIN ,array('flags'=>array($flag)) );
    }
   
    // validate MACADDRESS
    public function validMAC($mac )
    {
        return filter_var($mac ,FILTER_VALIDATE_MAC);
    }

    // validate IP
    /*
    flags :
    FILTER_FLAG_IPV4
    FILTER_FLAG_IPV6
    FILTER_FLAG_NO_PRIV_RANGE
    FILTER_FLAG_NO_RES_RANGE
    */

    public function validIp($ip ,$flag = [])
    {
        return filter_var($ip ,FILTER_VALIDATE_IP ,array('flags'=>array($flag)) );
    }
   
    // validate URL
    /*
    FILTER_FLAG_SCHEME_REQUIRED, 
    FILTER_FLAG_HOST_REQUIRED, 
    FILTER_FLAG_PATH_REQUIRED, 
    FILTER_FLAG_QUERY_REQUIRED
    */
    public function validUrl($url ,$flag = [])
    {
        return filter_var($url ,FILTER_VALIDATE_URL ,array('flags'=>array($flag)) );
    }


}

