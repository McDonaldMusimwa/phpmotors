<?php 
/* custom function for checking email*/
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail,FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

/*check the password for a minimum of 8 characters ,
at least 1 capital letter 
at least 1 number and
at least 1 special character
*/

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern,$clientPassword);
}

function checkClassificationName($classificationName){
    if(preg_match('/^.{1,30}$/', $classificationName) === 1){
        return $classificationName;
    }else{
        return (preg_match('/^.{1,30}$/', $classificationName) === 1);
    };



};

//function dynamicaly creates a navigation list
function createNavList($carclassifications){
   $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($carclassifications as $classification) {
        $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our$classification[classificationName] product line'>$classification[classificationName]</a></li>"; 
    }
    $navList .= '</ul>';
        return $navList;
}

function sessionEnd(){
    session_start();
    session_destroy();
    header('location:index.php');
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
 $classificationList = '<select name="classificationId" id="classificationList">'; 
 $classificationList .= "<option>Choose a Classification</option>"; 
 foreach ($classifications as $classification) { 
  $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
 } 
 $classificationList .= '</select>'; 
 return $classificationList; 
}



?>