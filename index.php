<?php
/*****************************
 * main controller
 ****************************/
 //create a session 
 session_start();
 
/*this is the main controller for the site  controller*/
// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
//get the function in the functions folder
require_once 'library/functions.php';



//Get the array of classifications from Database using model.
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = createNavList($classifications);

//check if the firstname cookie exists gets its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   }
  
$action = filter_input(INPUT_POST,'action');
if ($action==NULL){
    $action = filter_input(INPUT_GET,'action');
}

switch ($action){

    case 'template':
        include 'view/template.php';
        break;
    case 'template':
        include 'view/vehicle-man.php';
        break;
    default;
        $pageTitle='home';
        include 'view/home.php';
        break;
}






?>