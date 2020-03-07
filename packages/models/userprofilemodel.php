<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/31/2020
 * Time:        10:57 AM
 * Filename :   userprofilemodel.php
 */

namespace App\models;


use App\models\common\AbstractModel;

class UserprofileModel extends AbstractModel
{


    public $userid      ;
    public $firstname   ;
    public $lastname    ;
    public $country    ;
    public $sex         ;
    public $dateofbirth ;
    public $picture     ;
    public $bio         ;
    public $regdate     ;

    // set tablename for get infos
    protected static $tablename     = 'userprofile' ;

    protected static $tableschema = [
        'userid'                 => self::DATATYPE_INT,
        'firstname'              => self::DATATYPE_STR,
        'lastname'               => self::DATATYPE_STR,
        'country'                => self::DATATYPE_STR,
        'sex'                    => self::DATATYPE_STR,
        'dateofbirth'            => self::DATATYPE_STR,
        'picture'                => self::DATATYPE_STR,
        'bio'                    => self::DATATYPE_STR,
        'regdate'                => self::DATATYPE_STR,
    ];

    // set primarykey for get infos
    protected static $primarykey    = 'userid';
}


