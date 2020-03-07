<?php
/******************************************
 * Created by : SAIED.LAKHDAR.LOAI.
 * User: djelfanetwork
 * Date: 5/2/2018
 * Time: 7:06 PM
 * Filename : index.php
 *****************************************/
namespace App ;

use App\controllers\common\AuthsController;
use App\controllers\common\RequestController;
use App\library\Chef;
use App\library\Sessiongrip;
use App\library\TemplateLanguages;
use App\library\TemplateLoad;
use App\library\Messenger;


/**************************************
 *  No instance before autoloader
 *  autoload.php load consts file
 *************************************/
require_once "..".DIRECTORY_SEPARATOR."packages".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php" ;

/*************************************
 * Set SESSION name = DJELFANETWORK
 * & SESSION lifetime 28 days
 *************************************/
$sessionhandler = '' ;//(new Sessiongrip())->start() ;

//$auth = new AuthsController() ;

// boss class to contain other classes { register class }
$chef = Chef::getInstance() ;
$chef->session = (new Sessiongrip())->start() ;

$chef->templatelang = (new TemplateLanguages( $chef->session)) ;
//$chef->auth = (new AuthsController()) ;
$chef->Messanger = (new Messenger($chef->session)) ;

$authorization = AuthsController::getInstance($chef->session) ;

//var_dump($chef);
$request = new RequestController(new TemplateLoad(DEFAULT_THEME), $chef, $authorization) ;
$request->dispatch();


//var_dump(get_defined_vars());


//$configvars = new Loadconfig() ;
//echo '<br>' ;
//echo $configvars->db_connecton ;
//
//

//echo "<pre>" ;
//require "../packages/database/databaseHandler.php" ;
//use Ibralak\database\databaseHandler ;

// $emp = new User("sauippppid", "sieudd@saiyed.com", "passcode", "0003498", "{L21}") ;
//    var_dump( $emp->save() );
// $saied  = User::getByPK(6) ;
// $saied->setUserName("saieeeed")  ;
//var_dump( $saied );
//var_dump(User::getbypk(5));





//echo $app_name ;
//echo  '<br>';
//sessiongrip::sesStart() ;
//echo $sess->name ;
//$_SESSION['msg'] = 'welcome my web site ' ;
//echo $_SESSION['msg'] ;
//var_export(session_id()) ;
//echo '<pre>' ;
//var_export(session_start()) ;
//var_export($_SESSION) ;

//$db = new databaseHandler() ;
//$db->query("INSERT INTO `users` (name, surname ) VALUES (:name, :surname)") ;
//$db->bind(":name", "ali");
//$db->bind(":surname", "lahoual");
//$db->execute() ;
//echo $db->lastInsertId() ;


// function readLinesFromFile($filePath)
//     {
//         // Read file into an array of lines with auto-detected line endings
//         $autodetect = ini_get('auto_detect_line_endings');
//         ini_set('auto_detect_line_endings', '1');
//         $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
//         ini_set('auto_detect_line_endings', $autodetect);
//         return $lines;
//     }

// print_r(readLinesFromFile("../packages/.env") );


// $arr = array(
//     "name" => "ibraframe",
//     "description" => "php enterprise framework ",
//     "keyword" => ["framework", "enterprse"],
//     "bachir" => array(
//         "familyname" => "saied", 
//         "age" => 28 , 
//         "address" => "moudjbara"
//     )
// );


// $json =  file_get_contents("../packages/json/compiler.json");
// $readJson = json_decode($json, true) ; 
// $writeJson = json_encode($arr) ;

// file_put_contents("../packages/json/data.json" ,$writeJson );

// print_r($readJson);



// function item($method, $callback) {
//     echo $method ;

//     if (is_callable($callback)) {
//         call_user_func($callback) ;
//     }else
//     {
//         if (!preg_match("/^[\w+]*@[\w+]*$/", $callback)) {
//             echo "is not valid method and controller " ;
//         }
//         preg_match("/([\w+]*)@/" , $callback, $callbackMethod) ;
//         preg_match("/@([\w+]*)/" , $callback, $callbackController) ;
        
//         print_r($callbackMethod[1] );
//         print_r($callbackController[1] );
        
//         // preg_match($callback , "/^@[\w+]*$/", $callbackController) ;
        

//     }
    
// }



// echo $callbackMethod ;
// echo $callbackController ;
// echo "<br>" ;
// item("method ", "laker@control");
// echo "<br>" ;
// item("method ", "lakercontrol");
// echo "<br>" ;

// item("methods ", function() {    
//     echo "this is function called " ; 
// });





//      $array = array("23.32","22","12.009","23.43.43");
//      print_r(preg_grep("/^(\d+)?\.\d+\.\d+$/",$array));




// use Traits\validate ;
// echo '<pre>' ;
// $val = new validate();

// if(is_object($val) ){
//     echo "this is object ^^" ;

// }else {
//     echo "this is not object " ; 
// }

// $int = '6600';
// $min = 1;
// $max = 200 ;


// var_dump($val->validInt($int, null, FILTER_FLAG_ALLOW_OCTAL));

// echo $val->sanFloat($var , FILTER_FLAG_ALLOW_THOUSAND) ;
// 
// echo $val->sanSting($var , FILTER_FLAG_STRIP_HIGH) ;