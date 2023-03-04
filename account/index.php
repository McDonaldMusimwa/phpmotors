<?php
/*****************************
 * accounts management controller
 ****************************/
 //create a session 
 session_start();


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

  
$action = filter_input(INPUT_GET,'action');
if ($action==NULL){
    $action = filter_input(INPUT_POST,'action');
}

switch ($action){
    case 'registration':
        include '../view/registration.php';
    break;
    
    case 'login':
    
    include '../view/login.php';
    break;

    /*******REGISTRATION  CODE*********/
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

        
     // Check for missing data
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
        $message = '<p class="message">Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit; 
    }
        //Hach the password
        $hashedCientPassword = password_hash($clientPassword,PASSWORD_DEFAULT);
        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedCientPassword);

    // Check and report the result
    if ($regOutcome === 1) {
        //echo $regOutcome;
        //$message = "<p class='message'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        $_SESSION['registered'] = TRUE;
        $_SESSION['message']= "<p class='message good'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>" ;
        header('Location: /phpmotors/account/index.php?action=login');
       
        exit;
       
    } else {
        $message = '<p class="message">Sorry $clientFirstname, but the registration failed. Please try again.</p>';
        include '../view/registration.php';
        exit;
    }
    break;

    
    /********LOGINGIN CODE*********/
    case 'Login':
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $passwordCheck = checkPassword($clientPassword);
   

    // Run basic checks, return if errors
    if (empty($clientEmail) || empty($passwordCheck)) {
    $message = '<p class="message">Please provide a valid email address and password.</p>';
    include '../view/login.php';
    exit;
    }
    
    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
    $message = '<p class="message">Please check your password and try again.</p>';
    include '../view/login.php';
    exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    if ($_SESSION['loggedin']===TRUE){
        $_SESSION['message']="<p style='margin:10px 0'>You are logged in.</p>";
                include '../view/admin.php';
                exit;

}
    case 'logout':
        unset($_SESSION['clientData']);
        $_SESSION['clientData'];
        session_destroy();
        header('Location: /phpmotors/index.php');
        exit;

    case 'update':
        $sessionData = $_SESSION['clientData']['clientId'];
        
       
        $clientData = getClientInfo($sessionData);
       
        
        if (count($clientData)<1){
            $message = "Sorry no client found in the database";
        }
        include '../view/account-update.php';
        break;

    case 'updateinfo':
        
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname',FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname',FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail',FILTER_SANITIZE_EMAIL));
        $clientId = trim(filter_input(INPUT_POST, 'clientId',FILTER_SANITIZE_NUMBER_INT));
        //$clientId = $clientData['clientId'];
        $clientEmail=checkEmail($clientEmail);
        //check for existing email
        $existingEmail = checkExistingEmail($clientEmail);
        //deal with existing email
        if($existingEmail){
            $_SESSION['message'] = '<p class="message">This email adress already exists in our database.Do you want to log in instead?</p>';
            include '../view/admin.php';
            exit ;
        }

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
        $message = '<p class="message">Please provide information for all empty form fields.</p>';
        include '../view/admin.php';
        exit; 
    }
        
        // Send the data to the model
        $updateOutcome = updateClientInfo($clientFirstname, $clientLastname, $clientEmail,$clientId);
        echo $updateOutcome;
    // Check and report the result
    if ($updateOutcome === 1) {
        // update session with new udpated data
        $_SESSION['updated'] = TRUE;
        $_SESSION['clientData']['clientFirstname']=$clientFirstname;
        $_SESSION['clientData']['clientLastname']=$clientLastname;
        $_SESSION['clientData']['clientEmail']=$clientEmail;
        $_SESSION['message']= "<p class='message good'> $clientFirstname.You changed your data successfully.</p>" ;
        print_r ($_SESSION);
      
        header('Location: /phpmotors/account/index.php?action=admin');
       
        exit;
       
    } else {
        $_SESSION['message'] = '<p class="message">Sorry $clientFirstname, but the modifying failed. Please try again.</p>';
        include '../view/account-update.php';
        exit;
    }
    break;

    case 'updatePassword':
        
        
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, 'clientId',FILTER_SANITIZE_NUMBER_INT));

       
        $checkPassword=checkPassword($clientPassword);    
     // Check for missing data
    if(empty($clientPassword)){
        $_SESSION['message'] = '<p class="message">Please provide new password.</p>';
        include '../view/account-update.php';
        exit; 
    }
        //Hach the password
        $hashedCientPassword = password_hash($clientPassword,PASSWORD_DEFAULT);
        // Send the data to the model
        $updatedPassword = updateClientPassword($hashedCientPassword,$clientId);
        echo $updatedPassword;
    // Check and report the result
    if ($updatedPassword === 1) {
        //echo $regOutcome;
        //$message = "<p class='message'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
       
        $_SESSION['message']= "<p class='message good'> $clientFirstname.Your password change was successfully Please use your email and password to login.</p>" ;
        header('Location: /phpmotors/account/index.php?action=admin');
       
        exit;
       
    } else {
        $message = '<p class="message">Sorry but the update failed. Please try again.</p>';
        include '../view/account-update.php';
        exit;
    }
    break;

        
    case 'admin':    
        default:
        include '../view/admin.php';
        break;


    }




?>