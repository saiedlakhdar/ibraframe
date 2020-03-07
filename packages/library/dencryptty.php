<?php

namespace App\library;

/**
 * Created by : SAIED.LAKHDAR.LOAI.
 * User: djelfanetwork
 * Date: 6/8/2018
 * Time: 4:46 AM
 * Filename : dencryptty.php
 */




class dencryptty
{
    /**************************
     * Openssl configuration
     **************************/

    /**
     * @var string
     */
    private $opensslCipherMethod      ;
    /**
     * @var string
     */
    private $opensslSecretkey   ;

    /**
     * @var string
     * Not found in PHP < 5.3.3
     */
    private $opensslSecretIv    ;

    /**
     * @var string
     */
    private $opensslKey         ;

    /**
     * @var string
     * Not found in PHP < 5.3.3
     * Must be 16 bytes no more no less
     */
    private $opensslIv          ;

    /**
     * dencryptty constructor.
     * @param string $opensslCipherMethod
     * @param string $opensslSecretkey
     * @param string $opensslSecretIv
     * @throws \Exception
     */
    public function __construct(string $opensslCipherMethod = 'AES-256-CBC', string $opensslSecretkey = 'c968b3f30a33be58823212f89f491825',
                                string $opensslSecretIv = '223c2ddf941a1993cf1dd56c91c24dfe')
    {
        if(!extension_loaded('openssl'))
        {
            throw new \Exception('This app needs the Open SSL PHP extension.');
            exit ;
        }

        $this->setOpensslMethod($opensslCipherMethod)       ;
        $this->setOpensslSecretkey($opensslSecretkey)       ;
        $this->setOpensslSecretIv($opensslSecretIv)         ;

        $this->setOpensslKey($this->getOpensslSecretkey())  ;
        $this->setOpensslIv($this->getOpensslSecretIv())    ;

    }

    public function den_ecrypt($Encypttext)
    {
        if ($this->acceptphp() === true) {
            return openssl_encrypt($Encypttext, $this->getOpensslMethod(), $this->getOpensslKey(), 0 ,$this->getOpensslIv()) ;
        }
        return mcrypt_encrypt(MCRYPT_BLOWFISH,(substr($this->getOpensslKey(),0,mcrypt_get_key_size(MCRYPT_BLOWFISH,MCRYPT_MODE_CBC))), $Encypttext, MCRYPT_MODE_CBC,(substr($this->getOpensslIv(),0,8)) ) ;

    }

    public function den_decrypt($Decrypttext)
    {
        if ($this->acceptphp() === true)
        {
            return openssl_decrypt($Decrypttext, $this->getOpensslMethod(), $this->getOpensslKey(), 0 ,$this->getOpensslIv()) ;
        }
        return mcrypt_decrypt(MCRYPT_BLOWFISH,(substr($this->getOpensslKey(),0,mcrypt_get_key_size(MCRYPT_BLOWFISH,MCRYPT_MODE_CBC))), $Decrypttext, MCRYPT_MODE_CBC,(substr($this->getOpensslIv(),0,8)) ) ;
    }

    /*****************************
     * Openssl setter & getter
     *****************************/


    /**
     * @return string
     */
    private function getOpensslMethod(): string
    {
        return $this->opensslCipherMethod;
    }

    /**
     * @param string $opensslCipherMethod
     */
    private function setOpensslMethod(string $opensslCipherMethod)
    {
        $this->opensslCipherMethod = $opensslCipherMethod;
    }

    /**
     * @return string
     */
    private function getOpensslSecretkey(): string
    {
        return $this->opensslSecretkey;
    }

    /**
     * @param string $opensslSecretkey
     */
    private function setOpensslSecretkey(string $opensslSecretkey)
    {
        $this->opensslSecretkey = $opensslSecretkey;
    }

    /**
     * @return string
     */
    private function getOpensslSecretIv(): string
    {
        return $this->opensslSecretIv;
    }

    /**
     * @param string $opensslSecretIv
     */
    private function setOpensslSecretIv(string $opensslSecretIv)
    {
        $this->opensslSecretIv = $opensslSecretIv;
    }

    /**
     * @return string
     */
    private function getOpensslKey(): string
    {
        return $this->opensslKey;
    }

    /**
     * @param string $opensslKey
     */
    private function setOpensslKey(string $opensslKey)
    {
        $this->opensslKey = hash('sha256', $opensslKey);
    }

    /**
     * @return string
     * not found in php 5.3.3
     * Must be 16 bytes no more lo less
     */
    private function getOpensslIv(): string
    {
        return $this->opensslIv;
    }

    /**
     * @param string $opensslIv
     * not found in php 5.3.3
     * Must be 16 bytes no more lo less
     */
    private function setOpensslIv(string $opensslIv)
    {
        $this->opensslIv = substr(hash('sha256',$opensslIv), 0, 16);
    }

    private function acceptphp() : bool
    {
        if (version_compare(phpversion(), '5.3.3', '>'))
        {
            return true ;
        }
        return false ;
    }







}
