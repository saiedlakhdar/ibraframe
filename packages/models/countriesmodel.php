<?php


namespace App\models;


use App\models\common\AbstractModel;

class CountriesModel extends AbstractModel
{
    public $id              ;
    public $country_code    ;
    public $country_name    ;

    // set tablename for get infos

    protected static $tablename     = 'list_countries' ;

    protected static $tableschema   = [
        'id'                    => self::DATATYPE_INT,
        'country_code'          => self::DATATYPE_STR,
        'country_name'          => self::DATATYPE_STR,
    ];

    // set primarykey for get infos
    protected static $primarykey    = 'id';
}