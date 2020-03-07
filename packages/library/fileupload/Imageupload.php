<?php


namespace App\library\fileupload;


use App\library\fileupload\fileUploader;
use App\library\fileupload\fileUploaderInterface;

class ImageUpload extends fileUploader implements fileUploaderInterface
{
    protected $savepath = IMAGES ;
    /**
     * @var array
     */
    protected $allowedExt = array(
        'jpg' => 'image/jpeg',
        'jpeg'=> 'image/jpeg',
        'jpe' => 'image/jpeg',
        'gif' => 'image/gif',
        'png' => 'image/png',
        'bmp' => 'image/bmp'
    ) ;

    public function __construct( $file = array() )
    {
        $this->name     = $this->name($file['name']) ;
        $this->type     = $file['type'] ;
        $this->tmp_name = $file['tmp_name'] ;
        $this->error    = $file['error'] ;
        $this->size     = $file['size'] ;
    }

}

