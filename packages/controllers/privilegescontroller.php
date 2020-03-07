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
use App\models\PermissionsModel;
use App\models\PrivilegesgroupsModel;
use App\models\PrivilegesModel;
use App\library\Messenger;

class PrivilegesController extends AbstractController implements ActionInterface
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

        $this->_data['privileges'] = PrivilegesModel::getAll() ;
        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.'.$this->_action);
        // Rendering view page
        $this->_view();
    }

    public function addAction()
    {
        // TODO : CSFR SECURE
        // AutoLoad language file for this view
        $this->templatelang->load($this->_controller.'.'.$this->_action);
        $this->templatelang->load('errors');

        $this->_data['privileges'] = PermissionsModel::getAll() ;

        // posted data from add form
        if (isset($_POST['submit'])){
            $privileges =  new PrivilegesModel() ;
            $privileges->name = $this->sanSting($_POST['name']) ;
            if ($privileges->uniqueField(['name' => $privileges->name]) == false ){
                if ($privileges->save()) {
                    if (isset($_POST['privileges']) && is_array($_POST['privileges'])) {
                        foreach ($_POST['privileges'] as $privilege) {
                            $group                = new PrivilegesgroupsModel()  ;
                            $group->privilegesid  =  $privileges->id ;
                            $group->permissionsid =  $privilege     ;
                            $group->save() ;
                        }
                        $this->redirect('/'.$this->_controller);
                    }else{
                        $this->Messanger->send($this->templatelang->get('privileges_text_chose'), Messenger::WARNING_MGS) ;
                        $privileges->delete() ;
                    }
                }
            } else {
                $this->Messanger->send($this->templatelang->fill('error_label_taken', [$this->templatelang->get('privileges_text_name')] ), Messenger::ERROR_MGS) ;
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
        $privileges   = PrivilegesModel::getByPK($id) ;
        if ( $privileges === false){
            $this->redirect('/'.$this->_controller);
        }
        $currentpermissions = PrivilegesgroupsModel::getPrivilegs('privilegesid', $id);
        $extractepermissions = [] ;
        if ($currentpermissions !== false ){
            foreach ($currentpermissions as $currentpermission) {
                $extractepermissions[] = $currentpermission->permissionsid ;
            }
        }
        $this->_data['privileges'] = $privileges;
        $permissions = PermissionsModel::getAll() ;
        $this->_data['permissions'] = $permissions;
        $this->_data['extractepermissions'] = $extractepermissions;

        $oldpriviles =  $privileges->name;

        // posted data from edit form
        if (isset($_POST['submit'])){
            $privileges->name = $this->sanSting($_POST['name']) ;
            if ($privileges->uniqueField(['name' => $privileges->name]) == false || $oldpriviles == $privileges->name ){
                if ($privileges->save()) {
                    if (isset($_POST['privileges']) && is_array($_POST['privileges'])) {
                        // delete the unchecked permissions
                        $deletepermissions = array_diff($extractepermissions, $_POST['privileges'] ) ;
                        foreach ($deletepermissions as $deletepermission) {
                            $deleteed = PrivilegesgroupsModel::getBy(['privilegesid' => $privileges->id , 'permissionsid' => $deletepermission ]) ;
                            $deleteed->current()->delete() ;
                        }
                        // add the new permissions
                        $addpermissions    = array_diff($_POST['privileges'] , $extractepermissions) ;
                        foreach ($addpermissions as $privilege) {
                            $permissions = new PrivilegesgroupsModel() ;
                            $permissions->privilegesid  =  $privileges->id ;
                            $permissions->permissionsid =  $privilege     ;
                            $permissions->save();
                        }
                        // redirect to privileges page whene all done
                        $this->redirect('/'.$this->_controller);
                    }else{
                        $this->Messanger->send($this->templatelang->get('privileges_text_chose'), Messenger::WARNING_MGS) ;
                    }
                }
            } else {
                $this->Messanger->send($this->templatelang->fill('error_label_taken', [$this->templatelang->get('privileges_text_name')]), Messenger::ERROR_MGS) ;
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

        $privileges = PrivilegesModel::getByPK($id) ;
        if ($privileges === false ){
            $this->redirect('/'.$this->_controller);
        }
        $groupprivileges = PrivilegesgroupsModel::getBy(['privilegesid' => $privileges->id]) ;

        foreach ($groupprivileges as $groupprivilege) {
            $groupprivilege->delete() ;

        }
        if ($privileges->delete()){
            $this->redirect('/'.$this->_controller);
        }

    }
}