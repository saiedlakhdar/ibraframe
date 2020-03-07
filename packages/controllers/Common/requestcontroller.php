<?php


namespace App\Controllers\common;


use App\library\Chef;
use App\library\TemplateLoad;
use App\traits\AssistTrait;

class RequestController
{

    use AssistTrait ;
    const NOT_FOUND_CONTROLLER = 'NotfoundController' ;
    const NOT_FOUND_ACTIOM     = 'NotfoundAction'     ;
    const ACCESS_DENIED        = 'accessdeniedAction' ;

    private $_controller = 'index'     ;
    private $_action     = 'default'   ;
    private $_params     = []          ;
    /**
     * @var TemplateLoad
     */
    private $_template            ;
    /**
     * @var Chef
     */
    private $_chef                ;
    /**
     * @var AuthsController
     */
    private $_auths               ;

    public function __construct(TemplateLoad $template, Chef $chef, AuthsController $auths)
    {
        $this->_template          = $template ;
        $this->_chef              = $chef     ;
        $this->_auths             = $auths    ;
        $this->_parseUrl() ;
    }
    private function _parseUrl()
    {
        $url = trim(parse_url($_SERVER['REQUEST_URI'] ,PHP_URL_PATH), '/') ;
        $url = explode('/', $url, 3) ;

        if (!isset($url[0] ) || empty($url[0])){
            $url[0] = $this->_controller ;
        }
        $this->_controller = $url[0] ;

        if (!isset($url[1] ) || empty($url[1]) ){
            $url[1] = $this->_action ;
        }
        $this->_action = $url[1] ;

        if (isset($url[2] ) && !empty($url[2]) ){
           $params = explode('/', $url[2]) ;
           foreach ($params as $param) {
               $this->_params[] = $param ;
           }
        }
    }

    public function dispatch()
    {
        $requestClassname = 'App\Controllers\\' . ucfirst($this->_controller) . 'Controller' ; ;
        $methodName = $this->_action . 'Action' ;

        // check login authorized user
        if (!$this->_auths->loginSysAuthorized()){
            if (!($this->_controller == 'auth' && ($this->_action === 'login' || $this->_action === 'register' ) ) )  {
                $this->redirect('/auth/login');
            }
        }else{
            if (($this->_controller == 'auth' && ($this->_action === 'login' || $this->_action === 'register' ) ) )  {
                isset($_SERVER['HTTP_REFERER']) ? $this->redirect($_SERVER['HTTP_REFERER']) : $this->redirect('/');
            }
        }

        // check if the requested class controller & method is exist
        if (!class_exists($requestClassname ) || !method_exists($requestClassname, $methodName)  ){
            $requestClassname =  __NAMESPACE__ .'\\'.self::NOT_FOUND_CONTROLLER ;
            $this->_controller = self::NOT_FOUND_CONTROLLER ;
            $this->_action = $methodName = self::NOT_FOUND_ACTIOM ;
        }else{
            // check if the user has authorized to access the requested page
            if (AUTHS === true){
                if (!$this->_auths->isAccess($this->_controller , $this->_action)){
                    $this->redirect('/auth/accessdenied');
                }
            }
        }




        $requestController = new $requestClassname() ;

        $requestController->setController($this->_controller)
             ->setAction($this->_action)
             ->setParams($this->_params)
             ->setTemplate($this->_template)
             ->setChef($this->_chef)
             ->setDefaulttheme($this->_template->getThemefolder())
             ->setAuths($this->_auths)
             ->$methodName() ;
    }

}