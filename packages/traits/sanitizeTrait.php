<?php

namespace App\traits ;

/**
 * Created by : SAIED.LAKHDAR.LOAI.
 * User: djelfanetwork
 * Date: 5/2/2018
 * Time: 7:06 PM
 * Filename : sanitizeTrait.php
 */


/**
 * 
 */
trait SanitizeTrait
{
    // sanitze Email
    public function sanEmail($email)
    {
        return filter_var($email ,FILTER_SANITIZE_EMAIL ) ;
    }

    // sanitize String
    /*
    FILTER_FLAG_NO_ENCODE_QUOTES - Do not encode quotes
    FILTER_FLAG_STRIP_LOW - Remove characters with ASCII value < 32
    FILTER_FLAG_STRIP_HIGH - Remove characters with ASCII value > 127
    FILTER_FLAG_ENCODE_LOW - Encode characters with ASCII value < 32
    FILTER_FLAG_ENCODE_HIGH - Encode characters with ASCII value > 127
    FILTER_FLAG_ENCODE_AMP - Encode the "&" character to &amp;
     */ 
    public function sanSting($string, $flag = null)
    {
        return filter_var($string ,FILTER_SANITIZE_STRING , $flag) ;
    }



    // sanitize URL
    public function sanUrl($url)
    {
        return filter_var($url ,FILTER_SANITIZE_URL);
    }

    // sanitize INT
    public function sanInt($int)
    {
        return filter_var($int ,FILTER_SANITIZE_NUMBER_INT);
    }

    // sanitize FLAOT 
    /*
    FILTER_FLAG_ALLOW_FRACTION - Allow fraction separator (like . )
    FILTER_FLAG_ALLOW_THOUSAND - Allow thousand separator (like , )
    FILTER_FLAG_ALLOW_SCIENTIFIC - Allow scientific notation (like e and E)
    */
    public function sanFloat($float ,$flag = FILTER_FLAG_ALLOW_FRACTION)
    {
        return filter_var($float ,FILTER_SANITIZE_NUMBER_FLOAT , $flag );
    }





}



