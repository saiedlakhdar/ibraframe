<?php

namespace App\Tests;


class Image extends upload implements iuploader
{


    /**
     * @var string
     */
    private $upFN ;

    /**
     * @var array
     */
    private $allowedExt = array(
        'jpg' => 'image/jpeg',
        'jpeg'=> 'image/jpeg',
        'jpe' => 'image/jpeg',
        'gif' => 'image/gif',
        'png' => 'image/png',
        'bmp' => 'image/bmp'
    ) ;


    public function __construct(array $files,string $path = null, array $option = ["prefix"=>"img","Maxupload"=>8])
    {
        $this->setMaxSizeUpload($option['Maxupload']);

        if ($path == null)
        {
            if (!file_exists($this->getStorpath()."images"))
            {

                mkdir($this->getStorpath()."images", 766, true) ;
            }
            $this->setStorpath($this->getStorpath()."images".DS) ;

        }
        else
        {
            if (!file_exists(PDIR.$path.DS))
            {
                mkdir(PDIR.$path, 766, true) ;
            }
            $this->setStorpath(PDIR.$path.DS) ;
        }



        parent::__construct($files) ;

        $this->setType($files['type']) ;
        $this->setNewName($option['prefix']) ;


        if (!$this->allowedExtension())
        {
            return  $this->getErrors() ;
        }
        if (!$this->maxuploadfilesize()) {
            return  $this->getErrors() ;
        }


    }

    /**
     * @return bool
     */
    public function allowedExtension() :bool
    {
        if (array_key_exists($this->getExtension(), $this->allowedExt)){
            if ($this->allowedExt[$this->getExtension()] === $this->getType()){
                return true ;
            }
            else
            {
                $this->setErrors(["Bad Extension" => $this->getType()." is valid extension type " ]) ;
                return false ;
            }
        }
        $this->setErrors(["Bad Extension" => $this->getExtension()." is not valid extension " ]) ;
        return false ;

    }

    protected function maxuploadfilesize() :bool
    {
        if ($this->getSize() > $this->getMaxSizeUpload() )
        {
            $filesize = ($this->getSize()/1024)/1024 ;
            $filesize = round($filesize, 2) ;
            $this->setErrors(["Unacceptable size  " => $filesize."MB is too large file size , the acceptable size is : ".$this->getMaxSizeUpload()."MB" ]) ;
            return false ;
        }
        return true ;
    }

    public function upload()
    {
        // TODO: Implement upload() method.
        if ($this->getErrors() == null )
        {
            if (move_uploaded_file($this->getTmpName(), ( $this->getStorpath() . $this->getNewName() )) )
            {
                $this->setfilename($this->getNewName());
                echo "File uploaded successfully " ;
            }
            else
            {
                $this->setErrors(["Uploading Filed" => "Some thing wrong try again " ]) ;
                return print $this->getErrors() ;
            }

        }
        else{
            return print $this->getErrors() ;
        }

    }



    /**
     * Get the value of upFN
     *
     * @return  string
     */ 
    public function getfilename()
    {
        if (isset($this->upFN)){
            return $this->upFN;
        }
        return false  ;

    }

    /**
     * Set the value of upFN
     *
     * @param  string  $upFN
     */ 
    public function setfilename(string $upFN)
    {
        $this->upFN = $upFN;

    }
}