<?php
/*this is the account controller*/
// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get account model
require_once '../model/accounts-model.php';
//Get the function library
require_once '../library/functions.php';




//Get the array of classifications from Database using model.
$classifications = getClassifications();

//build a navigation bar using the $classifications array
//var_dump($classifications)
    


// Build a navigation bar using the $classifications array

$navList = createNavList($classifications);

  
$action = filter_input(INPUT_POST,'action');
if ($action==NULL){
    $action = filter_input(INPUT_GET,'action');
}

switch ($action){
    
    case 'register':
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname',FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname',FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail',FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword',FILTER_SANITIZE_FULL_SPECIAL_CHARS));


        $clientEmail=checkEmail($clientEmail);
        $checkPassword=checkPassword($clientPassword);

        //check for existing email
        $existingEmail = checkExistingEmail($clientEmail);
        //deal with existing email
        if($existingEmail){
            $message = '<p class="message">This email adress already exists in our database.Do you want to log in instead?</p>';
            include '../view/login.php';
            exit ;
        }

        //Hach the password
        $hashedCientPassword = password_hash($checkPassword,PASSWORD_DEFAULT);
     // Check for missing data
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($hashedCientPassword)){
        $message = '<p class="message">Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit; 
    }

    // Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

    // Check and report the result
    if ($regOutcome === 1) {
        setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
        $message = "<p class='message good'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        include '../view/login.php';
        exit;
       
    } else {
        $message = '<p class="message">Sorry $clientFirstname, but the registration failed. Please try again.</p>';
        include '../view/registration.php';
        exit;
    }
    break;

    case 'Login':
        //check the email and password and validate them
        $loginEmail = trim(filter_input(INPUT_POST,'clientEmail',FILTER_SANITIZE_STRING));
        $loginEmail = checkEmail($loginEmail);
        $loginPassWord = trim(filter_input(INPUT_POST,'clientPassWord',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $logInCheckPassWord = checkPassword($loginPassWord);
        if(empty($loginEmail) || empty($logInCheckPassWord)){
            $message = '<p>Login successfull</p>';
        }

        break;
    
    case 'registration':
        include '../view/registration.php';
    break;
    default;
    $pageTitle='LOGIN';
    include '../view/login.php';
    break;
}




?>