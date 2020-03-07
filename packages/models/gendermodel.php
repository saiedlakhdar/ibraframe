<?php


namespace App\models;


use App\models\common\AbstractModel;

class GenderModel extends AbstractModel
{
    public $id              ;
    public $gender          ;


    // set tablename for get infos

    protected static $tablename     = 'gender' ;

    protected static $tableschema   = [
        'id'                    => self::DATATYPE_INT,
        'gender'          => self::DATATYPE_STR,
    ];

    // set primarykey for get infos
    protected static $primarykey    = 'id';
}