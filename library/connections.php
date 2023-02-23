<?php 

/*
*Proxy connection to the phpmotors database
*/

function phpmotorsConnect(){
$server = 'localhost';
$dbname='phpmotors';
$username = 'iClient';
$password='qWy2B.PK([CkyLGW';
$dsn="mysql:host=$server;dbname=$dbname";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
/*add error handling mechanism*/
    try {
        $link=new PDO($dsn,$username,$password,$options);
        /*
        if(is_object($link)){
            echo 'it worked';
            }
        */
        return $link;
    } catch (PDOException $e){
    echo 'It did not work error' .$e->getMessage();
    //header('Location:/phpmotors/view/500.php');
    exit;
    

    }
}






?>

