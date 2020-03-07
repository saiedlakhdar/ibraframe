<?php
namespace App\Controllers\common;


use App\library\Chef;
use App\library\TemplateLoad;
use App\models\common\AbstractModel;
use App\traits\AssistTrait;
use App\traits\SanitizeTrait;
use App\traits\ValidateTrait;
use App\traits\ValidTrait;

Abstract class AbstractController
{
    use AssistTrait ;
    use ValidTrait ;
    use SanitizeTrait ;
    use ValidateTrait ;

    protected $_controller           ;
    protected $_action               ;
    protected $_params               ;
    /**
     * @var TemplateLoad
     */
    protected $_template             ;
    protected $_defaulttheme         ;
    protected $_data = []            ;
    /**
     * @var Chef
     */
    protected $_chef                 ;

    /**
     * @var AuthsController
     */
    protected $_auths                ;

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->_chef->$name ;
    }

    /**
     *
     */
    public function NotfoundAction()
    {
        $this->_view() ;
    }


    /**
     * Setter & Getter section
     */


    /**
     * @param mixed $chef
     * @return AbstractController
     */
    public function setChef(&$chef): AbstractController
    {
        $this->_chef = $chef;
        AbstractModel::setChef($chef);
        return $this ;
    }

    /**
     * @param mixed $auths
     * @return AbstractController
     */
    public function setAuths($auths): AbstractController
    {
        $this->_auths = $auths;
        AbstractModel::setAuths($auths);
        return $this ;
    }


    /**
     * @param $defaulttheme
     * @return AbstractController
     */
    public function setDefaulttheme($defaulttheme): AbstractController
    {
        $this->_defaulttheme = $defaulttheme;
        return $this ;
    }


    /**
     * @param mixed $controller
     * @return AbstractController
     */
    public function setController($controller): AbstractController
    {
        $this->_controller = $controller;
        return $this ;
    }

    /**
     * @param mixed $action
     * @return AbstractController
     */
    public function setAction($action): AbstractController
    {
        $this->_action = $action;
        return $this ;
    }

    /**
     * @param mixed $params
     * @return AbstractController
     */
    public function setParams($params): AbstractController
    {
        $this->_params = $params;
        return $this ;
    }

    /**
     * @param mixed $template
     * @return AbstractController
     */
    public function setTemplate(&$template): AbstractController
    {
        $this->_template = $template;
        return $this ;
    }


    /**
     * theme folder name
     */
    protected function _view()
    {
//        Pass Controller & Action & params to chaf class to use it ant where in our project
        $this->_chef->requestController = $this->_controller ;
        $this->_chef->requestAction = $this->_action ;
        $this->_chef->requestParams = $this->_params ;
        if (($this->_controller == RequestController::NOT_FOUND_CONTROLLER) || ($this->_action == RequestController::NOT_FOUND_ACTIOM)  ){
             $view = THEMES_DIR . $this->_defaulttheme .DS. 'views' .DS. 'notfound' .DS. 'default.view.php' ;
        }else{
            $view = THEMES_DIR . $this->_defaulttheme .DS. 'views' .DS. $this->_controller .DS. $this->_action.'.view.php' ;
        }
        if (file_exists($view)){
            $this->templatelang->load('common') ;
            if($this->session->app_lang == 'ar'){
                $this->_template->loadheadercss('css/custom-rtl.css') ;
            }

            $this->_data = array_merge($this->_data, $this->templatelang->getLexicon());


            $this->_template->setViewfile($view)
                ->setData($this->_data)
                ->setThemefolder($this->_defaulttheme)
                ->setChef($this->_chef)
                ->setAuths($this->_auths)
                ->renderTemplate();

        }
    }

    protected function _viewpage()
    {
        if (($this->_controller == RequestController::NOT_FOUND_CONTROLLER) || ($this->_action == RequestController::NOT_FOUND_ACTIOM)){
            $view = THEMES_DIR . $this->_defaulttheme .DS. 'views' .DS. 'notfound' .DS. 'default.view.php' ;
        }else{
            $view = THEMES_DIR . $this->_defaulttheme .DS. 'views' .DS. $this->_controller .DS. $this->_action.'.view.php' ;
        }
        if (file_exists($view)){
            $this->templatelang->load('common') ;
            $this->_data = array_merge($this->_data, $this->templatelang->getLexicon());
            extract($this->_data) ;
            require_once $view ;

//            $this->_template->setViewfile($view)->setData($this->_data)->setThemefolder($this->_defaulttheme)->renderTemplate();

//            var_dump($this->_template->renderTemplate());
        }
    }





}