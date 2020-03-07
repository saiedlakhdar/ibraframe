<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/23/2020
 * Time:        12:38 AM
 * Filename :   userscontroller.php
 */

namespace App\controllers;


use App\Controllers\common\AbstractController;
use App\controllers\interfaces\ActionInterface;
use App\library\Messenger;
use App\models\PrivilegesModel;
use App\models\UserprofileModel;
use App\models\UsersModel;

class UsersController extends AbstractController implements ActionInterface
{

    // Backend valiation rules
    private $_addActionRule = [
        'username'  => 'req|vstring|between(5,20)',
        'email'     => 'req|email',
        'password'  => 'req|vstring|eqf(cpassword)',
        'cpassword' => 'req|vstring',
        'phone'     => 'req|phone',
        'rule'      => 'req|int',
    ] ;
    // Backend valiation rules
    private $_editActionRule = [
        'phone'     => 'req|phone',
        'rule'      => 'req|int',
    ] ;

    public function defaultAction()
    {
        // files loads just for "piece" theme in this action only
        if (DEFAULT_THEME == 'piece'){
            $this->_template->loadjs('vendor/datatables/jquery.dataTables.min.js')
                ->loadjs('vendor/datatables/dataTables.bootstrap4.min.js')
                ->loadheadercss('vendor/datatables/dataTables.bootstrap4.min.css');
        }

        $this->templatelang->load($this->_controller.'.'.$this->_action);
        $this->_data['usersdata'] = UsersModel::getAllUsers($this->session->uid) ;

//        var_dump($this->session->uid);
        // view rendering
        $this->_view();
    }

    public function addAction()
    {
        // languages file
        $this->templatelang->load($this->_controller.'.'.$this->_action);
        $this->templatelang->load('errors');

//            TODO : check unique fields
//            TODO : csrf prevent

        $this->_data['usergroups']  =  PrivilegesModel::getAll() ;
        // Add post method
        if (isset($_POST['submit'])  && $this->is_valid($this->_addActionRule) === true){
            $user = new UsersModel() ;
            $user->username     = $this->sanSting($_POST['username']) ;
            $user->email        = $this->validEmail($_POST['email']) ;
            $user->phone        = $this->sanSting($_POST['phone']) ;
            $user->rule         = $this->sanInt($_POST['rule']) ;
            $user->status       = 1 ;
            $user->lastlogin    = date('Y-m-d H:i:s') ;
            $user->cryptpass($_POST['password']);
            $user->generate_usertoken() ;

            if ($user->uniqueField(['username' => $user->username]) !== false) {
                $this->Messanger->send($this->templatelang->fill('error_label_username' , [$this->templatelang->get('users_text_username')] ),Messenger::ERROR_MGS) ;
            }elseif ($user->uniqueField(['email' => $user->email]) !== false){
                $this->Messanger->send($this->templatelang->fill('error_label_email' , [$this->templatelang->get('users_text_email')] ),Messenger::ERROR_MGS) ;
            }elseif ($user->uniqueField(['phone' => $user->phone]) !== false){
                $this->Messanger->send($this->templatelang->fill('error_label_phone' , [$this->templatelang->get('users_text_phone')] ),Messenger::ERROR_MGS) ;
            }else{
                if ($user->save()){
                    $userprofile = new UserprofileModel() ;
                    $userprofile->userid  = $user->id ;
                    $userprofile->picture = $this->imgValue(substr($user->username ,0,1)) ;
                    $userprofile->regdate = date('Y-m-d H:i:s') ;
                    // TODO : USER EMAIL WELCOME
                    if ($userprofile->save(true)){
                        $this->Messanger->send($this->templatelang->get('users_msg_success')) ;
                        $this->redirect('/users/');
                    }
                }else{
                    $this->Messanger->send($this->templatelang->get('users_msg_failed'), Messenger::ERROR_MGS) ;
                }
            }
        }

        // view rendering 
        $this->_view();
    }

    public function editAction()
    {
        // language file
        $this->templatelang->load($this->_controller.'.'.$this->_action);
        $this->templatelang->load('errors');


        if (!isset($this->_params[0]) || empty($this->_params[0])){
            $this->redirect('/'.$this->_controller);
        }
        $id = $this->validInt($this->_params[0]) ;
        if ($id === false || $this->session->uid->id == $id){
            $this->redirect('/'.$this->_controller);
        }
        $this->_data['user'] = $user  = UsersModel::getByPK($id) ;
        if ( $user === false){
            $this->redirect('/'.$this->_controller);
        }
        $this->_data['usergroups']  =  PrivilegesModel::getAll() ;

        // Edit post method
        if (isset($_POST['submit'])  && $this->is_valid($this->_editActionRule) === true){
            $oldphone           = $user->phone ;
            $user->phone        = $this->sanSting($_POST['phone']) ;
            $user->rule         = $this->sanInt($_POST['rule']) ;
            if ($user->uniqueField(['phone' => $user->phone]) !== false && $oldphone !== $user->phone){
                $this->Messanger->send($this->templatelang->fill('error_label_phone' , [$this->templatelang->get('users_text_phone')] ),Messenger::ERROR_MGS) ;
            }else{
                if ($user->save()){
                    $this->Messanger->send($this->templatelang->get('users_msg_success')) ;
                    $this->redirect('/'.$this->_controller);
                }else{
                    $this->Messanger->send($this->templatelang->get('users_msg_failed')) ;
                }
            }

        }

        // view rendering
        $this->_view();
    }

    public function delAction()
    {
        // no language needed
        // no view will rendering

        if (!isset($this->_params[0]) || empty($this->_params[0])){
            $this->redirect('/'.$this->_controller);
        }
        $id = $this->validInt($this->_params[0]) ;
        if ($id === false){
            $this->redirect('/'.$this->_controller);
        }
        $user  = UsersModel::getByPK($id) ;
        if ( $user === false || $this->session->uid->id == $id){
            $this->redirect('/'.$this->_controller);
        }

        if($user->delete()){
            $this->redirect('/'.$this->_controller);
        }

    }

    public function ajaxmethodAction()
    {
        // no language needed
        // no view will rendering
        if (!isset($this->_params[0]) || empty($this->_params[0])){
            $this->referer('/'.$this->_controller);
        }
        if (!isset($this->_params[1]) || empty($this->_params[1])){
            $this->referer('/'.$this->_controller);
        }

        $paramName = $this->sanSting($this->_params[0]) ;
        $paramValue= $this->sanSting($this->_params[1]) ;

        $user = new UsersModel() ;
        if (UsersModel::existsField($paramName)){
            echo $result = (int)  ($user->uniqueField([$paramName => $paramValue ]) XOR $this->session->uid->$paramName == $paramValue);
            header('Content-Type: application/json');
        }else{
            $this->referer('/'.$this->_controller);
        }




    }

}