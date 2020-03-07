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
use App\library\fileupload\ImageUpload;
use App\library\Messenger;
use App\models\CountriesModel;
use App\models\GenderModel;
use App\models\UserprofileModel;
use App\models\UsersModel;

class SettingsController extends AbstractController
{
    // Backend valiation rules
    private $_updateActionRule = [
        'username'      => 'req|vstring',
        'phone'         => 'req|phone',
    ] ;

    private $_updatePassActionRule = [
        'current_password'      => 'req',
        'password'              => 'req|eqf(cpassword)',
        'cpassword'             => 'req',
    ] ;

    public function defaultAction()
    {
        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.'.$this->_action);
        $this->templatelang->load('errors');

        // passing js file for this action
        $this->_template->loadjs('js/settings.js') ;

        // Get User details
        $userid  = $this->session->uid->id ;
        $user    = UsersModel::getOneBy(['id'=> $userid]) ;
        $userprofile = UserprofileModel::getOneBy(['userid'=> $userid]) ;
        $this->_data['user'] = $user ;
        $this->_data['userprofile'] = $userprofile ;
        $this->_data['countries']   = CountriesModel::getAll() ;
        $this->_data['genders']   = GenderModel::getAll() ;

        // Update account details
        if (isset($_POST['account']) && $this->is_valid($this->_updateActionRule)){
            $username     = $this->sanSting($_POST['username']) ;
            $phone        = $this->sanSting($_POST['phone']) ;
            if ( $user->uniqueField(['username' => $this->sanSting($_POST['username'])]) &&  $user->username != $username ){
                $this->Messanger->send($this->templatelang->fill('error_label_username' ,[$this->templatelang->get('users_text_username')] ), Messenger::ERROR_MGS ) ;
            }elseif ( $user->uniqueField(['phone' => $this->sanSting($_POST['phone'])])  && $user->phone != $phone ){
                $this->Messanger->send($this->templatelang->fill('error_label_phone' ,[$this->templatelang->get('users_text_phone')]), Messenger::ERROR_MGS  ) ;
            }else{
                $user->username     = $username ;
                $user->phone        = $phone ;
                if ( $user->save() ) {
                    UsersModel::refreshLogin() ;
                    $this->Messanger->send($this->templatelang->get('users_text_save_success') ) ;
                }
            }
        }

        // Update profile details
        if (isset($_POST['profile'])){
            $userprofile->firstname   = $this->sanSting($_POST['firstname']);
            $userprofile->lastname    = $this->sanSting($_POST['lastname']);
            $userprofile->country     = $this->sanSting($_POST['country']);
            $userprofile->sex         = $this->sanSting($_POST['gender']);
            $userprofile->dateofbirth = $this->sanSting($_POST['dateofbirth']);

            if ($_FILES['imagefile']['name'] != ''){
                $picture     = new ImageUpload($_FILES['imagefile']) ;
            }
            $userprofile->bio         = $this->sanSting($_POST['bio']);
            if (isset($picture) && is_object($picture)){
                 if ($picture->upload() === true){
                     $oldpic = ltrim($userprofile->picture,'/');
                     $oldpic = str_replace('/', DS, $oldpic);
                     $userprofile->picture = $picture->fullname();
                     $userprofile->save() ;
                     deleteFile(PDIR.$oldpic);
                     UsersModel::refreshLogin() ;
                     $this->Messanger->send($this->templatelang->get('users_text_save_success')) ;
                 }else{
                     $this->Messanger->send($this->templatelang->get($picture->upload()), Messenger::ERROR_MGS) ;
                 }

            }else{
                $userprofile->save() ;
                UsersModel::refreshLogin() ;
                $this->Messanger->send($this->templatelang->get('users_text_save_success')) ;
            }
        }

        // Update password
        if (isset($_POST['changepassword']) && $this->is_valid($this->_updatePassActionRule) ){
            $currentPassword    = UsersModel::crypt($this->sanSting($_POST['current_password'])) ;
            $Password           = UsersModel::crypt($this->sanSting($_POST['password'])) ;
            if ($this->session->uid->password == $currentPassword ){
                $user->password = $Password ;
                if ($user->save()){
                    UsersModel::refreshLogin() ;
                    $this->Messanger->send($this->templatelang->get('users_text_save_success') ) ;
                }
            }else{
                $this->Messanger->send($this->templatelang->fill('error_label_error' ,[$this->templatelang->get('users_text_current_password')] ), Messenger::ERROR_MGS ) ;
            }
        }

        // Rendering view page
        $this->_view();
    }

}