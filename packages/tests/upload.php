<?php

namespace App\Tests;

/**
 * Class upload
 * @package tests
 */

abstract class upload
{
    /**
     * @var string
     */
    private $storpath = PDIR."storagefiles".DS ;

    /**
     * @var string
     */
    private $name ;

    /**
     * @var string
     */
    private $tmpName ;

    /**
     * @var string
     */
    private $newName ;

    /**
     * @var string
     */
    private $type ;

    /**
     * @var string
     */
    private $Extension ;

    /**
     * @var string
     */
    private $error  ;

    /**
     * @var array
     */
    public $errors = [] ;

    /**
     * @var int
     */
    private $size ;

    /**
     * @var int
     */
    private $maxSizeUpload ;


    public function __construct(array $files)
    {
        $this->setName($files['name']) ;
        $this->setTmpName($files['tmp_name']) ;
        $this->setError($files['error']) ;
        $this->setSize($files['size']) ;
        $this->setExtension() ;


    }

    /**
     * @return string
     */
    public function getStorpath(): string
    {
        return $this->storpath;
    }

    /**
     * @param string $storpath
     */
    public function setStorpath(string $storpath)
    {
        $this->storpath = $storpath;
    }

    /**
     * @return string
     */
    protected function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    protected function getTmpName(): string
    {
        return $this->tmpName;
    }

    /**
     * @param string $tmpName
     */
    public function setTmpName(string $tmpName)
    {
        $this->tmpName = $tmpName;
    }

    /**
     * @return string
     */
    public function getNewName(): string
    {
        return $this->newName;
    }

    /**
     * @param string $newName
     */
    public function setNewName(string $prefix = null)
    {
        $this->newName = uniqid($prefix).".".$this->getExtension();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = mime_content_type($this->getTmpName());
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->Extension;
    }

    /**
     * @param
     */
    public function setExtension()
    {
        $name = $this->getName() ;
        $name = explode(".", $name) ;
        $name = end($name) ;

        $this->Extension = $name;
    }

    /**
     * @return string
     */
    protected function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError(string $error)
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getErrors(): string
    {
        $output = "" ;
        if (is_array($this->errors)){
            foreach ($this->errors as  $key => $value)
            {
                $output .=  "<strong style='color: red'>$key : </strong>" . $value ;
            }

        }else{
            $output = $this->errors ;
        }
        return $output;

    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;

    }

    /**
     * @return int
     */
    protected function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getMaxSizeUpload(): int
    {
        return $this->maxSizeUpload;
    }

    /**
     * @param int $maxSizeUpload
     */
    public function setMaxSizeUpload(int $maxSizeUpload)
    {
        $this->maxSizeUpload = $maxSizeUpload * 1024 * 1024;
    }


}