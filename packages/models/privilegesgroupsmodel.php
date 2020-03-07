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

class PrivilegesgroupsModel extends AbstractModel
{


    public $id              ;
    public $privilegesid    ;
    public $permissionsid   ;
    // set tablename for get infos
    protected static $tablename     = 'privileges_groups' ;

    protected static $tableschema = [
        'id'                    => self::DATATYPE_INT,
        'privilegesid'          => self::DATATYPE_INT,
        'permissionsid'         => self::DATATYPE_INT,

    ];

    // set primarykey for get infos
    protected static $primarykey    = 'id';

    // lasi insert method we used in abstract model to suplie lastinsertId

    public function lastId($id)
    {
        $this->id = $id ;
    }

    public static function getPrivilegs($param = null ,$id = null){
        $sql = 'SELECT pr.name ,per.* ,prgr.* FROM privileges AS pr ' ;
        $sql.= 'INNER JOIN privileges_groups prgr ON prgr.privilegesid = pr.id ';
        $sql.= 'INNER JOIN permissions per ON per.id = prgr.permissionsid ';
        if ($id !== null && $param !== null) {
            $sql .= 'WHERE '.$param.' = '.$id ;
        }
        return static::get($sql) ;
    }

    public static function privilegs($groupid){
        $sql = 'SELECT pr.*, per.scope FROM '. self::$tablename. ' pr' ;
        $sql .= ' INNER JOIN permissions per ON per.id = pr.permissionsid' ;
        $sql .= ' WHERE pr.privilegesid = '. $groupid ;
        $privileges =  static::get($sql) ;
        $userprivileges = [] ;
        foreach ($privileges as $privilege) {
            $userprivileges[] = $privilege->scope ;
        }
        return $userprivileges ;

    }

}