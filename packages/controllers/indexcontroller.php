<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/16/2020
 * Time:        4:17 PM
 * Filename :   homecontroller.php
 */

namespace App\controllers;


use App\Controllers\common\AbstractController;

class IndexController extends AbstractController
{

    public function defaultAction()
    {

        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.'.$this->_action);

        // Rendering view page
        $this->_view();
    }

    public function addAction()
    {
        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.'.$this->_action);

        // Rendering view page
        $this->_view();
    }

    public function testAction()
    {


        var_dump(' test action');

    }
}