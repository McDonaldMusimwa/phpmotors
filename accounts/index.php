<?php

// Accounts Controller

    // Create or access a Session
    session_start();

    // Get the database connection file
    require_once '../library/connections.php';
    // Get the phpmotors model for use as needed
    require_once '../model/main-model.php';
    // Get the accounts model
    require_once '../model/accounts-model.php';
    // Get the functions library
    require_once '../library/functions.php';
    // Get the reviews model
    require_once '../model/reviews-model.php';
    // Get the functions library

    // Get the array of classifications
    $classifications = getClassifications();
    
    // Call the createNavigation() function to create a dynamic navigation bar.
    $navList = createNavigation($classifications);

    // Get the value from the action name - value pair
    $action = filter_input(INPUT_POST,'action');
    if($action == NULL){
        $action = filter_input(INPUT_GET,'action');
    }

    // if(isset($_COOKIE['firstname'])){
    //     $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // }

    switch ($action) {
        // Code to deliver the views
        case 'login':
            include '../view/login.php';
            break;
        case 'register-page':
            include '../view/registration.php';
            break;
        case 'register':
            // Filter and store the data
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);

            $existingEmail = checkExistingEmail($clientEmail);

            // Check for existing email address in the table
            if($existingEmail){
                $message = '<p class="message error">That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
                $message = '<p class="message error">Please provide information for all empty form fields.</p>';
                include '../view/registration.php';
                exit;
            }

            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            // Send the data to the model
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

            // Check and report the result
            if($regOutcome ===1 ){
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                // $message = "<p class='message success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
                header('Location: /phpmotors/accounts/?action=login');
                exit;
            } else {
                $message = "<p class='message error'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }
            break;
        case 'Login':
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientEmail = checkEmail($clientEmail);
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $checkPassword = checkPassword($clientPassword);


            if(empty($clientEmail) || empty($checkPassword)){
                $message = '<p class="message error">Please provide information for all empty form fields.</p>';
                include '../view/login.php';
                exit;
            }
            
            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
            if(!$clientData) {
                $message = '<p class="message error">Please check your email and try again.</p>';
                include '../view/login.php';
                exit;
            }
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if(!$hashCheck) {
                $message = '<p class="message error">Please check your password and try again.</p>';
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
            header("Location: http://localhost/phpmotors/accounts/");
            exit;
        case 'Logout':
            unset($_SESSION['clientData']);
            session_destroy();
            include '../index.php';
            exit;
        case 'mod':
            $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);
            $clientInfo = getClientInfo($clientId);
            if(count($clientInfo)<1){
                $message = 'Sorry, no vehicle information could be found.';
            }
            include '../view/client-update.php';
            break;
        case 'updateAccount':
            // Filter and store the data
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
            
            $clientEmail = checkEmail($clientEmail);
            $clientId = checkInteger($clientId);
            $existingEmail = checkExistingEmail($clientEmail);

            // Check for existing email address in the table
            if($existingEmail){
                $_SESSION['messageAccount'] = "<p class='message error'>Sorry, " . $clientFirstname . " we could not update your account information. Pleas try again. That email address already exists.</p>";
                include '../view/client-update.php';
                exit;
            }

            // Check for missing data
            if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
                $_SESSION['messageAccount'] = '<p class="message error">Please provide information for all empty form fields.</p>';
                include '../view/client-update.php';
                exit;
            }

            // Send the data to the model
            $resultAccount = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);

            // Check and report the result
            if($resultAccount ===1 ){
                $clientData = getClientInfo($clientId);
                $_SESSION['clientData'] = $clientData;
                $_SESSION['message'] = "<p class='message success'>$clientFirstname. Your information has been updated.</p>";
                header('Location: /phpmotors/accounts/index.php');
                exit;
            } else {
                $_SESSION['message'] = "<p class='message error'>Sorry $clientFirstname, but the update failed. Please try again.</p>";
                include '../view/admin.php';
                exit;
            }
            break;
        case 'updatePassword':
            // Filter and store the data
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));

            $clientId = checkInteger($clientId);
            $checkPassword = checkPassword($clientPassword);

            // Check for missing data
            if(empty($checkPassword)){
                $_SESSION['messagePassword'] = '<p class="message error">Please Make sure your password matches the desired pattern.</p>';
                include '../view/client-update.php';
                exit;
            }

            $clientData = getClientInfo($clientId);
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            
            $resultPassword = 0;
            if(!$hashCheck){
                $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
                // Send the data to the model
                $resultPassword = updatePassword($hashedPassword, $clientId);
            }


            // Check and report the result
            if($resultPassword === 1){
                $clientData = getClientInfo($clientId);
                $_SESSION['clientData'] = $clientData;
                $_SESSION['message'] = "<p class='message success'>" . $_SESSION['clientData']['clientFirstname'] . ". Your password has been updated.</p>";
                header('Location: /phpmotors/accounts/index.php');
                exit;
            } else {
                $_SESSION['message'] = "<p class='message error'>Sorry " . $_SESSION['clientData']['clientFirstname'] . ", but the update of the password failed. Please try again.</p>";
                include '../view/admin.php';
                exit;
            }
            break;
        default:
            $reviewsClient = getReviewsClient($_SESSION['clientData']['clientId']);
            $clientReviewList = buildReviewsClient($reviewsClient);
            include '../view/admin.php';
            break;
    }


?>