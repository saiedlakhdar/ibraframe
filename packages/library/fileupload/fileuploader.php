<?php


namespace App\library\fileupload ;


abstract class fileUploader
{

    public $name       ;
    protected $type       ;
    protected $tmp_name   ;
    protected $error      ;
    // size in byles must be converted
    protected $size       ;
    protected $ext        ;

    protected $inputFileErrors = [
         0 => 'upload_err_ok',
         1 => 'upload_err_ini_size',
         2 => 'upload_err_form_size',
         3 => 'upload_err_partial',
         4 => 'upload_err_no_file',
         6 => 'upload_err_no_tmp_dir',
         7 => 'upload_err_cant_write',
         8 => 'upload_err_extension',
         9 => 'upload_err_unknown',
         10 => 'upload_err_max_size',
         11 => 'upload_err_bad_ext',
    ] ;



    public function acceptedSize()
    {
        preg_match_all( '/(\d+)([MG])$/', ini_get('upload_max_filesize'), $matchs) ;
        return $matchs[2][0] = 'M' ? ($this->size / 1024 / 1024) < $matchs[1][0] : ($this->size / 1024 / 1024 / 1024) < $matchs[1][0] ;
    }


    public function acceptedext()
    {
        if (array_key_exists($this->ext, $this->allowedExt )){
            return $this->allowedExt[$this->ext] == mime_content_type($this->tmp_name) ;
        }
        return false ;
    }

    public function name($name)
    {

        preg_match_all( '/[a-zA-Z]+$/', $name , $matchs) ;
        $this->ext = $matchs[0][0] ;
        return substr(md5(random_bytes(30)),0,20) . '.'. $matchs[0][0];
    }

    public function fullname()
    {
        $path = '/resources/uploads/images/' ;
        return $path . $this->name ;
    }
    /**
     * @return bool|mixed
     */
    public function upload()
    {
        if (array_key_exists($this->error, $this->inputFileErrors) ){
            if ($this->error == 0){
                if ($this->acceptedSize() === false ){
                    return $this->inputFileErrors[10] ;
                }elseif($this->acceptedext() === false){
                    return $this->inputFileErrors[11] ;
                }else{
                    move_uploaded_file($this->tmp_name, ($this->savepath.$this->name )) ;
                    return true ;
                }
            }
            return $this->inputFileErrors[$this->error];
        }
        return $this->inputFileErrors[8];
    }




}