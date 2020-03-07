<?php

namespace App\Tests;

/**
 * Class uploader
 * @package tests
 */
final class uploader
{
    /**
     * @var iuploader
     */
    private $uploader ;

    public function __construct(iuploader $uploader)
    {
        $this->setUploader($uploader) ;

    }

    /**
     * @return string
     */
    public function getFileName() : string
    {
        return $this->getUploader()->getfilename();
    }

    /**
     * @return iuploader
     */
    public function getUploader(): iuploader
    {
        return $this->uploader;
    }

    /**
     * @param iuploader $uploader
     */
    public function setUploader(iuploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function uploadFile()
    {
        $this->getUploader()->upload() ;
    }


}