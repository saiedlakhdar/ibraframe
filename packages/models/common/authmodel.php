<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/24/2020
 * Time:        3:03 AM
 * Filename :   authmodel.php
 */

namespace App\models\common;


class AuthModel extends AbstractModel
{


    public static function Isgranted($scope,$userid = '')
    {
        $Is = self::get("SELECT accessscopes.rulescope FROM users
                      INNER JOIN accessrules  ON users.userrule = accessrules.userrule
                      INNER JOIN accessscopes ON accessrules.accessruleid = accessscopes.accessruleid 
                      WHERE users.id = 14") ;
        if ($Is !== false & !empty($Is)) {
            foreach ($Is as $value => $key) {
                if ($value == $scope)
                {
                    return true ;
                }
            }
        }
        return false ;
    }


}