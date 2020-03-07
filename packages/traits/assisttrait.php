<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/18/2020
 * Time:        5:12 PM
 * Filename :   assisttrait.php
 */

namespace App\traits;


trait AssistTrait
{
    private $_colour = [
        1 => '#DC3023',
        2 => '#9D2933',
        3 => '#5D3F6A',
        4 => '#5B3256',
        5 => '#003171',
        6 => '#1F4788',
        7 => '#006442',
        8 => '#03A678',
        9 => '#A17917',
    ];

    private function hex2rgb($color = '#fff')
    {
        $color  = ltrim($color, '#');
        $length = strlen($color);

        if (preg_match('/[^0-9a-f]/i', $color) or $length <> 3 && $length <> 6) {
            throw new Exception('Invalid color format');
        }

        if ($length == 3) {
            $color = preg_replace('/(.)/', '$1$1', $color);
        }

        $color = hexdec($color);

        $r = 0xff & ($color >> 16);
        $g = 0xff & ($color >> 8);
        $b = 0xff & $color;

//        return sprintf('rgb(%d, %d, %d)', $r, $g, $b);
        return ['r'=>$r,'g'=>$g,'b'=>$b];
    }

    /**
     * @param $path
     */
    public function redirect($path)
    {
        session_write_close();
        header('Location: '.$path) ;
        exit();
    }

    /**
     * @param $path
     */
    public function referer($path)
    {
        if ($_SERVER['HTTP_REFERER']){
            $this->redirect($_SERVER['HTTP_REFERER']) ;
        }
        $this->redirect($path);
    }

    /**
     * @param $fieldName
     * @param null $object
     * @return mixed|string
     */
    public function priorFieldValue($fieldName ,$object = null)
    {
//        return isset($_POST[$fieldName]) ? $_POST[$fieldName] : (is_null($object) ? '' : $object->$fieldName ) ;
        return is_null($object) ? ( isset($_POST[$fieldName]) ? $_POST[$fieldName] : '' ) : $object->$fieldName ;
    }

    /**
     * @param $fieldName
     * @param $value
     * @param null $object
     * @return bool|string
     */
    public function priorOptionValue($fieldName ,$value ,$object = null)
    {
        return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || (!is_null($object) && $object->$fieldName == $value)) ? 'selected' : false ;
    }

    public function imgValue($imgtext = 'D')
    {
        $randormColor = random_int(1,9) ;
        $fileName     = md5(random_bytes(60)).'.jpeg' ;
        $savefileName = IMAGES . $fileName ;
        $dbfilename   = '/resources/uploads/images/'.$fileName ;
        $font = THEMES_DIR .DEFAULT_THEME.DS . 'includes'.DS .'assets'.DS .'fonts'.DS .'Cocon.ttf' ;
        $fontsize = 90 ;
        $color      = $this->hex2rgb('#ffffff') ;
        $background = $this->hex2rgb($this->_colour[$randormColor]) ;
        // Create the image resource
        $image = @imagecreate(200, 200) or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($image, $background['r'], $background['g'], $background['b']);
        $text_color       = imagecolorallocate($image, $color['r'], $color['g'], $color['b']);
        $bounding_box_size = imagettfbbox($fontsize, 0, $font, strtoupper($imgtext));
        $text_width = $bounding_box_size[2] - $bounding_box_size[0];
        $text_height = $bounding_box_size[7]-$bounding_box_size[1];
        // Text x&y coordinates
        $x = ceil((200 - $text_width) / 2);
        $y = ceil((200 - $text_height) / 2);
        // Write text to image
        imagettftext($image, $fontsize, 0, $x, $y, $text_color, $font, $imgtext);
//        header('Content-Type: image/jpeg');
        // Output the image
        imagejpeg($image , $savefileName);

        // Free up memory
        imagedestroy($image);
        return $dbfilename ;
    }




}