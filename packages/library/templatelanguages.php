<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/20/2020
 * Time:        5:22 PM
 * Filename :   templatelanguages.php
 */

namespace App\Library;


class TemplateLanguages
{
    /**
     * @var array
     */
    private $_lexicon = [] ;
    /**
     * @var Sessiongrip
     */
    private $_session ;

    public function __construct($_session)
    {
        $this->_session = $_session ;
        if (!isset($this->_session->app_lang)){ $this->_session->app_lang = 'en' ; }
    }

    /**
     * @param $path
     * @return $this
     */
    public function load($path)
    {
        //NotfoundController
        //NotfoundAction

//        $_SESSION['app_lang'] = 'ar';
        $defaultlang = $this->_session->app_lang ;
        $scopepath = str_replace('.',DS,$path);
        $langfile =  LANG_DIR .$defaultlang .DS. $scopepath. '.lang.php' ;
        if (file_exists($langfile)){
            require $langfile ;
            if (is_array($_lang) && !empty($_lang)){
                foreach ($_lang as $key => $value){
                    $this->_lexicon[$key] = $value ;
                }
                return $this ;
            }else{
                trigger_error("Sorry this array {$langfile} donsen't exist or empty  ", E_USER_WARNING) ;
            }
            return $this ;
        }else{
            trigger_error("Sorry the file {$langfile} donsen't exist ", E_USER_WARNING) ;
            var_dump($path);
        }
    }

    /**
     * @return array
     */
    public function getLexicon(): array
    {
        return $this->_lexicon;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        // TODO: Implement __get() method.
        if (array_key_exists($key , $this->_lexicon)) {
            return $this->_lexicon[$key] ;
        }
    }

    public function fill($key , $data )
    {
        if (array_key_exists($key, $this->_lexicon)) {
            array_unshift($data, $this->_lexicon[$key]) ;
           return call_user_func_array('sprintf', $data) ;
        }
    }


}