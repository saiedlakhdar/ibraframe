<?php
use App\Tests\Image ;
use App\Tests\uploader ;
use App\Library\sessiongrip ;
use App\Library\dencryptty ;



require_once "..".DIRECTORY_SEPARATOR."packages".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php" ;
echo '<pre>' ;
if (isset($_POST['submit']))
{

    if (!empty($_FILES['fileToUpload']))
    {
        $image      = new Image($_FILES['fileToUpload']) ;
        $uploader   = new uploader($image) ;
        $uploader->uploadFile() ;
        echo $uploader->getFileName() ;
//        var_dump($image) ;
//        var_dump($uploader) ;
//        var_dump($uploader->uploadFile()) ;
    }

}
if (isset($_POST['submit2']))
{

    if (!empty($_FILES['fileTo']))
    {

        var_dump($_FILES['fileTo']) ;
        print_r(mime_content_type($_FILES['fileTo']['tmp_name']) );
    }

}
//var_export(session_id()) ;
//if (session_id())
$sess = new sessiongrip() ;
$sess->start() ;

//echo  '<br>'. $text = 'Welcome this encrypted Text ^^ ' ;
//echo  '<br>';
// $crypt = new dencryptty() ;
// var_export($crypt) ;
// $cr = $crypt->den_ecrypt("") ;
// echo '<br>' ;
// echo 'this is empty value crypt : ' . $cr ;
// echo '<br>' ;

// var_export($cr);
// echo '<br>sss' ;
// var_export($crypt->den_decrypt($cr)) ;
//echo '<br>'. $crypted = $crypt->den_ecrypt($text) ;

//echo  '<br>'. $crypt->den_decrypt($crypted) ;

//echo  '<br>'.$sess->test('some data ') ;
////echo $sess->den_ecrypt($text) ;
////echo '<br>' ;
////var_export($sess->den_ecrypt($text)) ;
////echo '<br>' ;
//$key = 'c968b3f30a33be58823212f89f491825';
//$plaintext = "message to be encrypted";
//$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
//$iv = openssl_random_pseudo_bytes($ivlen);
//$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
//$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
//$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
//
////decrypt later....
//$c = base64_decode($ciphertext);
//$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
//$iv = substr($c, 0, $ivlen);
//$hmac = substr($c, $ivlen, $sha2len=32);
//$ciphertext_raw = substr($c, $ivlen+$sha2len);
//$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
//$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
//if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
//{
//    echo $original_plaintext."\n";
//}


//echo '<br>'.$opensslCipherMethod = 'AES-256-CBC';
//echo '<br>'.$opensslSecretkey = 'c968b3f30a33be58823212f89f491825';
//echo '<br>'.$opensslSecretIv = '223c2ddf941a1993cf1dd56c91c24dfe' ;
//echo '<br>'.$opensslkey = hash('sha256', $opensslSecretkey) ;
//echo '<br>'.$openssliv = substr(hash('sha256',$opensslSecretIv), 0, openssl_cipher_iv_length($opensslCipherMethod) );
//
//echo '<br> Encrypted text : '. $enc = openssl_encrypt($text, $opensslCipherMethod, $opensslSecretkey,0, $openssliv,$tag ) ;
//echo '<br>'. $enc ;
//echo '<br> Decrypted text : '. openssl_decrypt($enc, $opensslCipherMethod, $opensslSecretkey,1, $openssliv,$tag ) ;
//
////var_export($sess->den_decrypt($text)) ;
////$sess->test() ;
//echo '<br>' ;
//echo $iv = openssl_cipher_iv_length('AES-256-CBC') ;
//echo openssl_random_pseudo_bytes($iv) ;
//echo $sess->den_decrypt($text) ;

echo '<pre>' ;
//session_id('18k00001548445832154') ;
var_export($_SESSION) ;



$sess->name = "ali" ;
//session_start('18k00001548445832154') ;

echo $sess->name ;
//var_export(session_status() ) ;
echo '<br>' ;

//var_export(session_id()) ;
////var_export(session_start()) ;
////sessiongrip::sesStart() ;
//var_export($_SESSION) ;
//
//$_SESSION['msg'] = 'welcome my web site ' ;
//
//echo $_SESSION['msg'] ;
//echo "this PDIR ".PDIR ;
//echo "<br>" ;
//echo "this BDIR ".BDIR ;
//echo "<br>" ;
//$text = "" ;
//if ($text == null)
//{
//    echo "your text is null" ;
//}
//$hash = new dencryptty() ;
//echo $texthash = $hash->den_ecrypt($text) ;
//echo "<br>" ;
//echo $hash->den_decrypt($texthash) ;

//function encrypt($string)
//{
//    $output = false;
//
//    $encrypt_method = "AES-256-CBC";
//    $secret_key = 'ExampleKey';
//    $secret_iv = 'ExampleIv';
//
//    // hash
//    $key = hash('sha256', $secret_key);
//
//    $iv = substr(hash('sha256', $secret_iv), 0, 16);
//
//    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
//    $output = base64_encode($output);
//
//    return $key;
//}

//
//$textToEncrypt = "My super secret information.";
//$encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
//$secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";
//
////To encrypt
//$encryptedMessage = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash,0 , "dshfsodfasjhlgs1");
//
////To Decrypt
//$decryptedMessage = openssl_decrypt($encryptedMessage, $encryptionMethod, $secretHash,0 , "dshfso5fasjhlgs7");
// RpsOLTBoEymLg1dfJo+AV3+HXhVoghNDudvF+J4hO5Y=

//Result
//echo "Encrypted: $encryptedMessage <br>Decrypted: $decryptedMessage";



//$path = null ;
//
//
//$path == null ?  : $path = "hi world " ;
//echo $path ;
//var_dump(version_compare(phpversion(),'5.3.3', '>')) ;
//var_dump(phpversion()) ;

//var_dump(ini_get_all()) ;
//phpinfo() ;
//$classmap =  require "../packages/vendor/autoloadNamespace.php" ;



//echo "<pre>" ;
//print_r($classmap);



//foreach ($classmap as $key => $value)
//{
//    echo $key . " => " . $value ;
//}



//
//function getdirtree($dir)
//{
//    $dirtree = array() ;
//
//    $sdir = scandir($dir) ;
//
//    foreach ($sdir as $key => $value)
//    {
//        if (!in_array($value,array(".","..")))
//        {
//            if (is_dir($dir. DIRECTORY_SEPARATOR . $value))
//            {
//                $dirtree[$value] = getdirtree($dir. DIRECTORY_SEPARATOR.$value);
//            } else
//            {
//                $dirtree[] = $value ;
//            }
//        }
//    }
//    return $dirtree ;
//}
//
//
//$dir    =  "../";
//$files1 = scandir($dir);
//$files2 = scandir($dir, 1);
//
//print_r($files1);
//print_r($files2);
//
//print_r(getdirtree("../") );

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="runner.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>


<form action="runner.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileTo" id="fileTo">
    <input type="submit" value="Upload Image" name="submit2">
</form>

</body>
</html>
