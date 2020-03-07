<?php
namespace App\Database ;

use App\Library\Loadconfig;
use \PDO;
use \PDOException;

/**
 * Created by : SAIED.LAKHDAR.LOAI.
 * User: djelfanetwork
 * Date: 5/2/2018
 * Time: 7:06 PM
 * Filename : databaseHandler.php
 */

class DatabaseHandler
{
    private static $dsn ;
    private $error ;
    private $stmt ;


    public function __construct()
    {
            try
            {
                $db = new Loadconfig() ;
                self::$dsn = new \PDO($db->db_connection.":host=".$db->db_host.";port=".$db->db_port.";dbname=".$db->db_database.";charset".$db->db_charset,$db->db_username,$db->db_password,array(
                    \PDO::ATTR_PERSISTENT => true ,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,

                ));
            }
            catch(\PDOException $er){
                $this->error = $er->getMessage() ;
            }
    }

    public static function Handler()
    {
        if ( self::$dsn === null){
            self::$dsn = new self() ;
        }
        return self::$dsn ;
    }

    public function prepare($query)
    {
        return $this->stmt = self::$dsn->prepare($query) ;
    }

    /*
     * Bind
     *  The next method we will be looking at is the bind method.
     *  In order to prepare our SQL queries,
     *  we need to bind the inputs with the placeholders we put in place.
     *  This is what the Bind method is used for.
     *  The main part of this method is based upon the \PDOStatement::bindValue \PDO method.
     *  Firstly, we create our bind method and pass it three arguments.
     * Param is the placeholder value that we will be using in our SQL statement, example :name.
     * Value is the actual value that we want to bind to the placeholder, example “John Smith”.
     * Type is the datatype of the parameter, example string.
     * Next we use a switch statement to set the datatype of the parameter:
     */

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value): $type = \PDO::PARAM_INT;
                    break;
                case is_bool($value): $type = \PDO::PARAM_BOOL;
                    break;
                case is_null($value): $type = \PDO::PARAM_NULLL;
                    break;
                default: $type = \PDO::PARAM_STR;
            }      
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /*
     * Execute
     * The next method we will be look at is the \PDOStatement::execute.
     *  The execute method executes the prepared statement.
     */
    public function execute()
    {
        return $this->stmt->execute() ;
    }

    /*
     * Result Set
     *  The Result Set function returns an array of the result set rows.
     *  It uses the \PDOStatement::fetchAll \PDO method. First we run the execute method,
     *  then we return the results.
     */
    public function resultSet()
    {
        $this->execute() ;
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /*
     * Single
     *  Very similar to the previous method,
     *  the Single method simply returns a single record from the database. Again,
     *  first we run the execute method, then we return the single result.
     *  This method uses the \PDO method \PDOStatement::fetch.
     */
    public function single()
    {
        $this->execute() ;
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    /*
     * Row Count
     *  The next method simply returns the number of effected rows from the previous delete,
     *  update or insert statement. This method use the \PDO method \PDOStatement::rowCount.
     */
    public function rowCount()
    {
        return $this->stmt->rowCount() ;
    }

    /*
     * Last Insert Id
     *  The Last Insert Id method returns the last inserted Id as a string.
     *  This method uses the \PDO method \PDO::lastInsertId.
     */
    public function lastInsertId()
    {
        return self::$dsn->lastInsertId() ;
    }

    /*
     * Transactions
     *  Transactions allows you to run multiple changes to a database all in one batch to 
     *  ensure that your work will not be accessed incorrectly or there will be no outside
     *  interferences before you are finished. If you are running many queries that all rely
     *  upon each other, if one fails an exception will be thrown and you can roll back any
     *  previous changes to the start of the transaction.
     */
    public function beginTransaction()
    {
        return self::$dsn->beginTransaction() ;
    }

    /*
     * To end a transaction and commit your changes:
     */
    public function endTransaction()
    {
        return self::$dsn->commit() ;
    }

    /*
     * To cancel a transaction and roll back your changes:
     */

    public function cancelTransaction()
    {
        return self::$dsn->rollBack() ;
    }

    /*
     * Debug Dump Parameters
     *  The Debut Dump Parameters methods dumps the the information that was contained
     *  in the Prepared Statement. This method uses the \PDOStatement::debugDumpParams
     *  \PDO Method.
     */
    public function debugdumpParams()
    {
        return $this->stmt->debugDumpParams();
    }






}

