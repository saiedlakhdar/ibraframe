<?php


namespace App\models\common;

use App\controllers\common\AuthsController;
use App\Database\databaseHandler;
use App\library\Chef;
use App\Traits\SanitizeTrait;
use \PDOStatement;

class AbstractModel
{
    use SanitizeTrait ;

    const DATATYPE_BOOL = \PDO::PARAM_BOOL;
    const DATATYPE_INT = \PDO::PARAM_INT;
    const DATATYPE_STR = \PDO::PARAM_STR;
    const DATATYPE_DECIMAL = 4;
    const DATATYPE_DATE = 5;

    /**
     * @author : github.com/saiedlakhdar
     * mysql datetime YYYY-MM-DD [1992-08-01 OR 1990-8-3] starts from 1000-01-01 TO 9999-12-31
     * this [450-01-01] date pattern is not valid
     */
    const MYSQL_DATE_PATTERN = '/^([1-9][0-9][0-9][0-9])-((:?[0][1-9]|[1-9])|[1][02])-((:?[0][1-9])|[12][0-9]|[1-9]|[3][0-2])$/';
    /**
     * @author : github.com/saiedlakhdar
     * mysql datetime YYYY-MM-DD HH:II:SS [1992-08-01 00:00:00 OR 1990-8-3 00:00:00] starts from 1000-01-01 00:00:00 TO 9999-12-32 23:59:59
     * this [450-01-01 1:2:5] datetime pattern is not valid
     */
    const MYSQL_DATETIME_PATTERN = '/^([1-9][0-9][0-9][0-9])-((:?[0][1-9]|[1-9])|[1][02])-((:?[0][1-9])|[12][0-9]|[1-9]|[3][0-2]) (([01][0-9]|[2][0-3]):([0-5][0-9]):([0-5][0-9]))$/';

    /**
     * The DATETIME type is used for values that contain both date and time parts.
     * MySQL retrieves and displays DATETIME values in 'YYYY-MM-DD hh:mm:ss' format. The supported range is '1000-01-01 00:00:00' to '9999-12-31 23:59:59'.
     * The TIMESTAMP data type is used for values that contain both date and time parts. TIMESTAMP has a range of '1970-01-01 00:00:01' UTC to '2038-01-19 03:14:07' UTC.
     * @link https://dev.mysql.com/doc/refman/8.0/en/datetime.html
     */
    const DEFAULT_MYSQL_DATE = '1970-01-01' ;
    /**
     *
     */
    const VALIDATE_DATE_NUMERIC = '/^\d{6,8}$/' ;

    /**
     * @var instance of PDO object
     */
    private static $db;

    /**
     * @var AuthsController
     */
    protected static $_auths ;

    /**
     * @var Chef
     */
    protected static $_chef ;

    /**
     * @param AuthsController $auth
     */
    public static function  setAuths(AuthsController $auths)
    {
        self::$_auths = $auths ;
    }

    /**
     * @param Chef $chef
     */
    public static function  setChef(Chef $chef)
    {
        self::$_chef = $chef ;
    }
    /**
     * @return databaseHandler|instance
     */
    private static function dbcon()
    {
        if (self::$db === null) {
            self::$db = new DatabaseHandler();
        }
        return self::$db;
    }

    /**
     * @param PDOStatement $stmt
     * @param null $schema
     */
    public function preparevalue(\PDOStatement $stmt , $schema = null )
    {
        if ($schema == null) {
            $schema = static::$tableschema ;
        }
        foreach ($schema as $columnname => $type) {
            if ($type == 4) {
                $sanitaied = filter_var($this->$columnname, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindvalue(":{$columnname}", $sanitaied);
            }
            $stmt->bindvalue(":{$columnname}", $this->{$columnname}, $type);
        }


    }

    /**
     * @return string
     */
    private static function buildparametersSQL($schema = null)
    {
        if ($schema == null) {
            $schema = static::$tableschema ;
        }
        $parameters = '';
        foreach ($schema as $columnname => $type) {
            $parameters .= $columnname . ' = :' . $columnname . ' ,';
        }
        return trim($parameters, ' ,');
    }

    /**
     * @param null $schema
     * @return string
     */
    private static function buildparametersSQL_AND($schema = null)
    {
        if ($schema == null) {
            $schema = static::$tableschema ;
        }
        $parameters = '';
        foreach ($schema as $columnname => $type) {
            $parameters .= $columnname . ' = :' . $columnname . ' AND ';
        }
        return trim($parameters, ' AND ');
    }

    /**
     * @param null $schema
     * @return string
     */
    private static function buildparametersSQL_OR($schema = null)
    {
        if ($schema == null) {
            $schema = static::$tableschema ;
        }
        $parameters = '';
        foreach ($schema as $columnname => $type) {
            $parameters .= $columnname . ' = :' . $columnname . ' OR ';
        }
        return trim($parameters, ' OR ');
    }

    private static function buildcolumns($columns)
    {
        $columnname = '' ;
        if (!empty($columns)){
            if (is_array($columns)){

                foreach ($columns as $column) {
                    $columnname .= ', ' .$column ;
                }
            } else {
                $columnname .= $columnname ;
            }
        }
        return trim($columnname, ' ,') ;
    }
    /**
     * @return bool
     */
    private function create()
    {
        $sql = 'INSERT INTO ' . static::$tablename . ' SET ' . self::buildparametersSQL();
        $stmt =  self::dbcon()->prepare($sql);
        $this->preparevalue($stmt);
        $query =  $stmt->execute();
        $this->{static::$primarykey} = self::dbcon()->lastInsertId() ;
//        if (method_exists(get_called_class() , 'lastId')){
//            $this->lastId(self::dbcon()->lastInsertId()) ;
//        }
        return $query ;
    }

    /**
     * @param null $tablename
     * @return bool
     */
    private function update($tablename = null )
    {
        if ($tablename == null) {
            $tablename = static::$tablename ;
        }
        $sql = 'UPDATE ' . $tablename . ' SET ' . self::buildparametersSQL() . ' WHERE ' . static::$primarykey . ' = ' . $this->{static::$primarykey};
        $stmt = self::dbcon()->prepare($sql);
        $this->preparevalue($stmt);
        return $stmt->execute();
    }

    /**
     * @param bool $skipPK
     * $this->{static::$primarykey} == null ? $this->create() : $this->update()
     * @return bool
     */
    public function save($skipPK = false)
    {
        return  $skipPK === false ? ($this->{static::$primarykey} == null ? $this->create() : $this->update()) :  $this->create() ;
    }

    /**
     * @param null $tablename
     * @return bool
     */
    public function delete($tablename = null)
    {
        self::dbcon();
        if ($tablename == null) {
            $tablename = static::$tablename ;
        }
        $sql = 'DELETE FROM ' . $tablename . ' WHERE ' . static::$primarykey . ' = ' . $this->{static::$primarykey};
        $stmt = self::dbcon()->prepare($sql);
        return $stmt->execute();
    }

    /**
     * @param null $tablename
     * @return \ArrayIterator|bool
     */
    public static function getAll($tablename = null )
    {
        if ($tablename == null) {
            $tablename = static::$tablename ;
        }
        $sql = 'SELECT * FROM ' . $tablename;
        $stmt = self::dbcon()->prepare($sql) ;
        $stmt->execute() ;
        if (method_exists(get_called_class() , '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableschema)) ;
        }else{
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS , get_called_class()) ;
        }
        if ( is_array($results) && !empty($results) ){
           return new \ArrayIterator($results) ;
        }
        return false ;
    }

    /**
     * @param null $tablename
     * @return \ArrayIterator|bool
     */
    public static function _getOne($tablename = null )
    {
        if ($tablename == null) {
            $tablename = static::$tablename ;
        }
        $sql = 'SELECT * FROM ' . $tablename;
        $stmt = self::dbcon()->prepare($sql) ;
        $stmt->execute() ;
        $results = $stmt->fetch(\PDO::FETCH_ASSOC) ;
        if ( is_array($results) && !empty($results) ){
            var_dump($results);
            return new \ArrayIterator($results) ;
        }
        return false ;
    }
    /**
     * @param $primarykey
     * @param null $tablename
     * @return array|bool|mixed
     */
    public static function getByPK($primarykey ,$tablename = null)
    {
        if ($tablename == null) {
            $tablename = static::$tablename ;
        }
        $sql = 'SELECT * FROM ' . $tablename . ' WHERE ' . static::$primarykey . ' = ' . $primarykey;
        $stmt = self::dbcon()->prepare($sql);
        if ($stmt->execute() == true){
            if (method_exists(get_called_class() , '__construct')) {
                $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableschema)) ;
            }else{
                $result = $stmt->fetchAll(\PDO::FETCH_CLASS , get_called_class()) ;
            }
//            $result = array_shift($result) ;
//            if ($result == null){
//                return false ;
//            }
        }
        return !empty($result) ? array_shift($result) : false  ;
    }

    /**
     * @param $sql passed like "SELECT * FROM tablename WHERE "
     * @param array $options passed like  ['columnname' => ['datatype' , 'data']]
     * @return \ArrayIterator|bool
     * if the class who called this method has __constract must be has too static proprete $tableschema as array contains table columns to passed into the constractor
     */
    public static function get($sql, $options = array() , $oper = 'AND')
    {
        if (!empty($options)){
            $oper == 'OR' ? $sql .= self::buildparametersSQL_OR($options) :$sql .= self::buildparametersSQL_AND($options) ;
        }
        $stmt = self::dbcon()->prepare($sql) ;
        if (!empty($options))
        {
            foreach ($options as $columnname => $type )
            {
                if ($type[0] === 4)
                {
                 $stmt->bindValue(":{$columnname}", self::sanFloat($type[1])) ;
                }elseif ( $type[0] === 5 )
                {
                    if (!preg_match(self::MYSQL_DATE_PATTERN,$type[1]) ||
                        !preg_match(self::MYSQL_DATETIME_PATTERN) ||
                        !preg_match(self::VALIDATE_DATE_NUMERIC)){
                        $stmt->bindValue(":{$columnname}", self::DEFAULT_MYSQL_DATE) ;
                    }
                    $stmt->bindValue(":{$columnname}", $type[1]) ;

                }else{
                    $stmt->bindValue(":{$columnname}", $type[1], $type[0]) ;
                }
            }
        }
        $stmt->execute() ;
        if (method_exists(get_called_class() , '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableschema)) ;
        }else{
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS , get_called_class()) ;
        }

        if ( is_array($results) && !empty($results) ){
            return  new \ArrayIterator($results) ;
        }
        return false ;

    }


    /**
     * @param $sql passed like "SELECT * FROM tablename WHERE "
     * @param array $options passed like  ['columnname' => ['datatype' , 'data']]
     * @param string $oper
     * @return bool|mixed
     * if the class who called this method has __constract must be has too static proprete $tableschema as array contains table columns to passed into the constractor
     */
    public static function getOne($sql )
    {
        $stmt = self::dbcon()->prepare($sql) ;
        $stmt->execute() ;
        if (method_exists(get_called_class() , '__construct')) {
            $results = $stmt->fetchObject(get_called_class(), array_keys(static::$tableschema)) ;
        }else{
            $results = $stmt->fetchObject(get_called_class()) ;
        }
       return $results ;
    }

    /**
     * @param $columnname passed as associative array
     * @return \ArrayIterator|bool
     * pass like this PermissionsModel::getBy(['scope' => $permission->scope])
     */
    public static function getBy($columnnames)
    {
       $wherecolumns = array_keys($columnnames);
       $wherevalues = array_values($columnnames);
       $where = [] ;
       for ($i = 0 , $ii = count($wherecolumns); $i < $ii ; $i++ ) {
           $where[] = $wherecolumns[$i] . ' = "' . $wherevalues[$i]. '"' ;
       }
       $where = implode(' AND ', $where) ;
       $sql = 'SELECT * FROM '. static::$tablename . ' WHERE ' . $where ;
       return static::get($sql) ;
    }

    /**
     * @param $columnname passed as associative array
     * @return bool|mixed
     * pass like this PermissionsModel::getBy(['scope' => $permission->scope])
     */
    public static function getOneBy($columnnames)
    {
        $wherecolumns = array_keys($columnnames);
        $wherevalues = array_values($columnnames);
        $where = [] ;
        for ($i = 0 , $ii = count($wherecolumns); $i < $ii ; $i++ ) {
            $where[] = $wherecolumns[$i] . ' = "' . $wherevalues[$i]. '"' ;
        }
        $where = implode(' AND ', $where) ;
        $sql = 'SELECT * FROM '. static::$tablename . ' WHERE ' . $where ;
        return static::getOne($sql) ;
    }

    public function rollback()
    {
        static::dbcon()->cancelTransaction() ;
    }

    /**
     * @param array $values
     * @return \ArrayIterator|bool
     * pass like this PermissionsModel::getBy(['scope' =>  $permission->scope])
     */
    public function uniqueField($values = [])
    {
        if (!empty($values)){
            return self::getBy($values) ? true : false ;
        }
        return false ;
    }

    public static function existsField($field)
    {
        return array_key_exists($field, static::$tableschema) ;
    }





}