<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/19/2020
 * Time:        2:31 AM
 * Filename :   templateload.php
 */

namespace App\library;


use App\controllers\common\AuthsController;
use App\traits\AssistTrait;

class TemplateLoad
{

    protected $_template                    ;
    protected $_viewfile                    ;
    protected $_themefolder                 ;
    protected $_pageicon      = 'icon.png'  ;
    protected $_data                        ;
    protected $_loadheadercss = ''          ;
    protected $_loadheaderjs  = ''          ;
    protected $_loadjs        = ''          ;
    protected $_jsfooter      = ''          ;
    /**
     * @var Chef
     */
    protected $_chef                        ;
    /**
     * @var AuthsController
     */
    protected $_auths                       ;


    use AssistTrait ;

    public function __construct($defaultTheme)
    {
        $this->_themefolder = $defaultTheme ;
        $file = THEMES_DIR.$this->_themefolder.DS.'includes'.DS.'template.php';
        if(file_exists($file)){
           $this->_template = require_once $file ;
        }

    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->_chef->$name ;
    }

    /**
     * @param mixed $chef
     * @return TemplateLoad
     */
    public function setChef($chef): TemplateLoad
    {
        $this->_chef = $chef;
        return $this ;
    }

    /**
     * @param AuthsController $auths
     * @return TemplateLoad
     */
    public function setAuths(AuthsController $auths): TemplateLoad
    {
        $this->_auths = $auths;
        return $this ;
    }




    /**
     * @param $data
     * @return TemplateLoad
     */
    public function setData(&$data): TemplateLoad
    {
        $this->_data = $data;
        return $this ;
    }

    /**
     * @param $viewfile
     * @return TemplateLoad
     */
    public function setViewfile($viewfile): TemplateLoad
    {
        $this->_viewfile = $viewfile;
        return $this ;
    }

    /**
     * @param $themefolder
     * @return TemplateLoad
     */
    public function setThemefolder($themefolder): TemplateLoad
    {
        $this->_themefolder = $themefolder;
        return $this ;
    }

    /**
     * @param string $pageicon
     * @return TemplateLoad
     */
    public function setPageicon(string $pageicon): TemplateLoad
    {
        $this->_pageicon = $pageicon;
        return $this ;
    }

    /**
     * @return mixed
     */
    public function getThemefolder()
    {
        return $this->_themefolder;
    }

    /**
     * @return array|mixed
     */
    private function sanitizeTemplateArray()
    {

        $templatefiles = &$this->_template ;
        if (is_array($templatefiles)){
            foreach ($templatefiles as $template => &$parts ){
                if ($template == 'template'){
                    foreach ($parts as $templ => &$prt){
                        if ($templ == '__view'){
                            $prt = $this->_viewfile ;
                        }
                    }
                }
                if ($template == "header_resources") {

                    foreach ($parts as $templat => &$part){
                        if ($templat == "css" || $templat == "js")
                        {
                            foreach ($part as $key => &$value){
                                $value = str_replace("__{themefoldetr}__/", DS.'resources'.DS.'themes'.DS.$this->_themefolder.DS, $value ) ;
                                $value = str_replace("/", DS, $value ) ;
                            }
                        }
                    }
                    continue ;
                }
                if ($template == "footer_resources") {

                    foreach ($parts as $footerkey => &$footerres){

                        $footerres = str_replace("__{themefoldetr}__/", DS.'resources'.DS.'themes'.DS.$this->_themefolder.DS, $footerres ) ;
                        $footerres = str_replace("/", DS, $footerres ) ;

                    }
                    continue ;
                }
                $parts = str_replace("__{themefoldetr}__/", THEMES_DIR.$this->_themefolder.DS, $parts )  ;
                $parts = str_replace("/", DS, $parts )  ;
            }

        }
        return $this->_template = &$templatefiles;
    }

    private function templateHeaderstart()
    {
        $file = THEMES_DIR . $this->_themefolder . DS . 'includes' .DS . 'inc'.DS. 'templateheaderstart.php' ;
        if (file_exists($file)){
          return $file ;
        }

    }

    private function templateHeaderend()
    {
        $file = THEMES_DIR . $this->_themefolder . DS . 'includes' .DS . 'inc'.DS. 'templateheaderend.php' ;
        if (file_exists($file)){
            return $file ;
        }
    }

    private function templateFooter()
    {
        $file = THEMES_DIR . $this->_themefolder . DS . 'includes' .DS . 'inc'.DS. 'templatefooter.php' ;
        if (file_exists($file)){
            return $file ;
        }
    }

    private function templateblocks()
    {
        if(!array_key_exists('template', $this->_template)){
         trigger_error("Sorry :You have to define key template in template file  ", E_USER_ERROR) ;
        }
        $files = $this->_template['template'] ;
        if (!empty($files)){
            extract($this->_data) ;
            foreach ($files as $key => $file){
                if (file_exists($file)){
                    require $file ;
                }
            }
        }
    }

    private function templateResourcesheader()
    {
        if(!array_key_exists('header_resources', $this->_template)){
        trigger_error("Sorry :You have to define key header_resources in template file  ", E_USER_ERROR) ;
        }

        $output = '' ;
        $files = $this->_template['header_resources'] ;
        // get Css files
        $css = $files['css'] ;
        if (!empty($css)){
            foreach ($css as $key => $value ){
                    $output .= '<link rel="stylesheet" href="'.$value.'"> ' ;
            }
        }
        // get js files
        $js = $files['js'] ;
        if (!empty($js)){
            foreach ($js as $key => $value ){
                $output .= '<script src="'.$value.'"></script>' ;
            }
        }
        echo $output ;
    }

    private function templateResourcesfooter()
    {
        if(!array_key_exists('footer_resources', $this->_template)){
        trigger_error("Sorry :You have to define key header_resources in template file  ", E_USER_ERROR) ;
        }
        $output =  '';
        $js = $this->_template['footer_resources'] ;
        // get js files
        if (!empty($js)){
            foreach ($js as $key => $value ){
                $output .= ' <script src="'.$value.'"></script> ' ;
            }
        }
        echo $output ;
    }

    public function jsfooter($script = false )
    {
        if ($script !== false){
        $output  =  '<script> ';
        $output .= $script ;
        $output .=  ' </script> ';
        $this->_jsfooter =  $output ;
        }
    }

    public function loadheadercss($path)
    {
        $path = trim($path, DS) ;
        $path = str_replace('/',DS,$path);
        // vendor/datatables/dataTables.bootstrap4.min.css
        $path = 'resources'.DS.'themes'.DS.$this->_themefolder.DS.'includes'.DS.'assets'.DS. $path ;
        $file =  PDIR.$path ;
        if (file_exists($file)){
            $this->_loadheadercss .= '<link rel="stylesheet" href="'.DS.$path.'" >' ;
        }else{
            trigger_error("Sorry the file {$file} donsen't exist ", E_USER_WARNING) ;
        }
        return $this ;
    }

    public function loadheaderjs($path)
    {
        $path = trim($path, DS) ;
        $path = str_replace('/',DS,$path);
        $path = 'resources'.DS.'themes'.DS.$this->_themefolder.DS.'includes'.DS.'assets'.DS. $path ;
        $file =  PDIR.$path ;
        if (file_exists($file)){
            $this->_loadheaderjs .= '<script src="'.DS.$path.'"></script>' ;
        }else{
            trigger_error("Sorry the file {$file} donsen't exist ", E_USER_WARNING) ;
        }
        return $this ;
    }

    public function loadjs($path)
    {
        $path = trim($path, DS) ;
        $path = str_replace('/',DS,$path);
        // \resources\themes\default\includes\assets\js\datatables.min.js
        // vendor/datatables/dataTables.bootstrap4.min.css
        $path = 'resources'.DS.'themes'.DS.$this->_themefolder.DS.'includes'.DS.'assets'.DS. $path ;
        $file =  PDIR.$path ;
        if (file_exists($file)){
            $this->_loadjs .= '<script src="'.DS.$path.'"></script>' ;
        }else{
            trigger_error("Sorry the file {$file} donsen't exist ", E_USER_WARNING) ;
        }
        return $this ;
    }

    private function templateFavicon(  )
    {
        $file = THEMES_DIR . $this->_themefolder . DS . 'includes' .DS . $this->_pageicon ;
        if (file_exists($file)){
            $file = DS.'resources'.DS.'themes'.DS.$this->_themefolder.DS.'includes' .DS . $this->_pageicon ;
            echo '<link rel="shotcut icon" href="'.$file.'" type="image/gif" >' ;
        }

    }

    public function renderTemplate($icon = 'icon.png' )
    {


     $this->sanitizeTemplateArray() ;

     extract($this->_data) ;
     //
     require_once $this->templateHeaderstart();
     //
     $this->templateFavicon() ;
     //
     $this->templateresourcesheader();
     //
     echo $this->_loadheadercss ;
     //
     echo $this->_loadheaderjs ;
     //
     require_once $this->templateHeaderend();
     //
     $this->templateblocks();
     $this->templateResourcesfooter() ;
     //
     echo $this->_loadjs ;
     //
     echo $this->_jsfooter ;
     //
     require_once $this->templateFooter();

    }



}