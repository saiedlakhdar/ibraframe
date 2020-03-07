<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/23/2020
 * Time:        11:11 PM
 * Filename :   UsersModel.php
 */

namespace App\models;


use App\models\common\AbstractModel;

class PermissionsModel extends AbstractModel
{


    public $id              ;
    public $name            ;
    public $scope           ;

    // set tablename for get infos

    protected static $tablename     = 'permissions' ;

    protected static $tableschema   = [
        'id'                    => self::DATATYPE_INT,
        'name'                  => self::DATATYPE_STR,
        'scope'                 => self::DATATYPE_STR,
    ];

    // set primarykey for get infos
    protected static $primarykey    = 'id';



}