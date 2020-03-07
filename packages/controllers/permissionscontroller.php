<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/31/2020
 * Time:        3:11 PM
 * Filename :   privilegescontroller.php
 */

namespace App\controllers;


use App\Controllers\common\AbstractController;
use App\controllers\interfaces\ActionInterface;
use App\library\Messenger;
use App\models\PermissionsModel;

class PermissionsController extends AbstractController implements ActionInterface
{

    public function defaultAction()
    {
        // files loads just for "piece" theme in this action only
        if (DEFAULT_THEME == 'piece'){
            $this->_template->loadjs('vendor/datatables/jquery.dataTables.min.js')
                ->loadjs('vendor/datatables/dataTables.bootstrap4.min.js')
                ->loadjs('js/demo/datatables-demo.js')
                ->loadheadercss('vendor/datatables/dataTables.bootstrap4.min.css');
        }
        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.'.$this->_action);

        $this->_data['permissions'] = PermissionsModel::getAll() ;
        // Rendering view page
        $this->_view();
    }

    public function addAction()
    {
        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.'.$this->_action);
        $this->templatelang->load('errors');

        if (isset($_POST['submit'])){
            $permission = new PermissionsModel() ;
            $permission->name = $this->sanSting($_POST['name']) ;
            $permission->scope = $this->sanSting($_POST['scope']) ;
            // check if the unique fields are not dublicate
            if ($permission->uniqueField(['scope' => $permission->scope]) == false ){

                if ($permission->save()) {
                    $this->Messanger->send($this->templatelang->get('permissions_text_save_success')) ;
                    $this->redirect('/'.$this->_controller);
                }
            } else{
                $this->Messanger->send($this->templatelang->fill('error_label_taken' ,[$this->templatelang->get('permissions_text_scope')]), Messenger::ERROR_MGS) ;
            }
        }
        // Rendering view page
        $this->_view();
    }

    public function editAction()
    {
        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.'.$this->_action);
        $this->templatelang->load('errors');

        if (!isset($this->_params[0]) || empty($this->_params[0])){
            $this->redirect('/'.$this->_controller);
        }

        $id = $this->validInt($this->_params[0]) ;
        if ($id === false){
            $this->redirect('/'.$this->_controller);
        }
        $permissions = PermissionsModel::getByPK($id) ;
        if ($permissions === false) {
            $this->redirect('/'.$this->_controller);
        }
        $this->_data['permissions'] = $permissions ;
        $oldpermission = $permissions->scope ;

        if (isset($_POST['submit'])){
            $permissions->id = $id ;
            $permissions->name = $this->sanSting($_POST['name']) ;
            $permissions->scope = $this->sanSting($_POST['scope']) ;
            // check if the unique fields are not dublicate
            if ($permissions->uniqueField( ['scope' =>  $permissions->scope] ) == false || $oldpermission == $permissions->scope ){
                if ($permissions->save()) {
                    $this->Messanger->send($this->templatelang->get('permissions_text_save_success')) ;
                    $this->redirect('/'.$this->_controller);
                }
            } else{
                $permissions->scope = $oldpermission ;
                $this->Messanger->send($this->templatelang->fill('error_label_taken' ,[$this->templatelang->get('permissions_text_scope')]), Messenger::ERROR_MGS) ;

            }
        }


        // Rendering view page
        $this->_view();
    }

    public function delAction()
    {
        // no languaage file needed
        // no view will return

        if (!isset($this->_params[0]) || empty($this->_params[0])){
            $this->redirect('/'.$this->_controller);
        }
        $id = $this->validInt($this->_params[0]) ;

        if ($id === false){
            $this->redirect('/'.$this->_controller);
        }

        $permission = PermissionsModel::getByPK($id) ;
        if ($permission === false ){
            $this->redirect('/'.$this->_controller);
        }

        if ($permission->delete()){
            $this->redirect('/'.$this->_controller);
        }
    }

}