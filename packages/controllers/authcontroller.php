<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/22/2020
 * Time:        3:56 AM
 * Filename :   authcontroller.php
 */

namespace App\controllers;


use App\Controllers\common\AbstractController;
use App\models\UsersModel;

class AuthController extends AbstractController
{

    public function defaultAction()
    {
        $this->redirect('/auth/login');
    }
    public function loginAction()
    {
        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.'.$this->_action);
        $this->templatelang->load('errors');


        if (isset($_POST['login'])){
            $username = $this->sanSting($_POST['username']) ;
            $password = UsersModel::crypt($_POST['password']);
            $logedin = UsersModel::authenticated($username, $password) ;
            if($logedin === 0  ){
                // account disabled
                $this->Messanger->send($this->templatelang->get('login_account_disabled')) ;
            }elseif($logedin === false){
                // user not found
                $this->Messanger->send($this->templatelang->get('login_username_and_password_error')) ;
            }elseif($logedin == 1 ) {
                // user found & authorized to get access
                $this->redirect('/');
            }

        }

        // rendering view page
        $this->_viewpage();
    }

    public function registerAction()
    {
        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.'.$this->_action);
        $this->templatelang->load('errors');

        // rendering view page
        $this->_viewpage();

    }

    public function logoutAction()
    {
        // kill session
        $this->session->kill() ;
        $this->redirect('/auth');
    }

    public function accessdeniedAction()
    {
        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.common');

        // rendering view page
        $this->_view();
    }
}