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
use http\Client\Curl\User;

class UsersModel extends AbstractModel
{


    public $id         ;
    public $username   ;
    public $email      ;
    public $password   ;
    public $rule       ;
    public $phone      ;
    public $status     ;
    public $token      ;
    public $lastlogin  ;
    public $rulename   ;
    /**
     * @var UserprofileModel
     */
    public $profile    ;
    public $privileges ;



    // set tablename for get infos
    protected static $tablename     = 'users' ;

    protected static $tableschema = [
        'id'                => self::DATATYPE_INT,
        'username'          => self::DATATYPE_STR,
        'email'             => self::DATATYPE_STR,
        'password'          => self::DATATYPE_STR,
        'rule'              => self::DATATYPE_INT,
        'phone'             => self::DATATYPE_STR,
        'status'            => self::DATATYPE_INT,
        'token'             => self::DATATYPE_STR,
        'lastlogin'         => self::DATATYPE_STR,
    ];

    // set primarykey for get infos
    protected static $primarykey    = 'id';

    /**
     * @param $password
     */
    public function cryptpass($password) :void
    {
        $this->password = self::crypt($password) ;
    }

    public static function crypt($value)
    {
        $salt = 'saied.lakhdar01@gmail.com' ;
        return md5(sha1(sha1($salt.$value))) ;
    }

    /**
     * @throws \Exception
     */
    public function generate_usertoken() :void
    {
        $this->token = base64_encode(random_bytes(64)) ;
    }

    public static function getAllUsers(UsersModel $user, $tablename = null)
    {
        if ($tablename == null) {
            $tablename = static::$tablename ;
        }
        return self::get('SELECT u.*, up.*, (ugp.name) as `rulename` FROM '.$tablename.' u LEFT JOIN userprofile as up ON u.id = up.userid LEFT JOIN `privileges` as ugp ON ugp.id = u.rule WHERE u.id != ' . $user->id);
    }

    /**
     * @param $username
     * @param $password
     * @return \ArrayIterator|bool
     */
    public static function authenticated($username, $password)
    {
//        $password = self::crypt($password) ;
        $sql = 'SELECT *, (SELECT name FROM `privileges` WHERE privileges.id = '.self::$tablename.'.id) rulename FROM '.self::$tablename .' WHERE username = "'.$username .'" AND password = "'. $password .'"';
        $founduser  = self::getOne($sql) ;
        if ($founduser !== false ){
            if ($founduser->status == 0 ){
                return 0 ;
            }
            $founduser->lastlogin = date('Y-m-d H-i-s') ;
            $founduser->save() ;
            $founduser->privileges = PrivilegesgroupsModel::privilegs($founduser->rule) ;
            self::$_chef->session->uid = $founduser ;
            $founduser->profile = UserprofileModel::getOneBy(['userid' => $founduser->id ]) ;
            return 1 ;
        }
        return false ;
    }

    public static function refreshLogin()
    {
        $username = self::$_chef->session->uid->username ;
        $password = self::$_chef->session->uid->password ;
        return UsersModel::authenticated($username, $password) ;
    }


}