<?php

/*****************************
 * reviews controller
 ****************************/
//create a session 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get account model
require_once '../model/vehicles-model.php';
//Get account model
require_once '../library/functions.php';
//Get uploads model
require_once '../model/uploads-model.php';
//Get reviews model
require_once '../model/reviews-model.php';





//Get the array of classifications from Database using model.
$classifications = getClassifications();

//build a navigation bar using the $classifications array
// var_dump($classifications);
// exit;


// Build a navigation bar using the $classifications array
$navList = createNavList($classifications);


//Build a drop down list for classification name

$classificationList = '<label for="classificationId">Select a classification</label>';
$classificationList .= '<select name="classificationId" id="classificationId">';
$classificationList .= '<option> Choose a Classification</option>';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] === $classificationId) {
            $classificationList .= ' selected ';
            break;
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($classification['classificationId'] === $invInfo['classificationId']) {
            $classifList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName] </option>";
}
$classificationList .= "</select>";


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}


switch ($action) {
    case 'new-review-view':
        $reviews = retriveAllReviews($invId);

        include '/phpmotors/view/write-review.php';
        break;

    case 'Add-new-review':
        // Filter and store the data

        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $clientreview = trim(filter_input(INPUT_POST, 'clientReview', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        echo $invId;
        echo $clientreview;
        echo $clientId;

        $reviews = AddReview(intval($invId), intval($clientId), $clientreview);
        if ($reviews === 1) {
            $message = "<p class='message'>Review was added successfully.</p>";
        } else {
            $message = "<p>Review not added</p>";
        }
        include '../view/admin.php';
        break;

    case 'Review-management':
        $clientId = $_SESSION['clientData']['clientId'];
        $clientReviews = retriveEachClientReviews($clientId);
        
        if (empty($clientReviews)) {
            $message = '<p>Sorry you have not reviewed any product</p>';
        } else {
            $displayClientReviews = buildReviewList($clientReviews);
            
        }
        include '../view/review-man.php';
        break;

    case 'edit':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $reviewData = getReviewData($reviewId);
        



        include '../view/review-edit.php';

        break;

    case 'edit-Review':
        //filter the data to be delete
        
        $reviewId = filter_input(INPUT_POST, 'reviewId',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $clientreview = trim(filter_input(INPUT_POST, 'clientReview', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
       
        // Check for missing data
        if (empty($clientreview) || empty($reviewId)) {
            $message = '<p class-"message">Please complete all information for the item! Double check the classification of the item.</p>';
            $reviewData = getReviewData($reviewId);
            include '../view/review-man.php';
            exit;
        }

        // Send the data to the model
        $updateResult = updateReview($reviewId,$clientreview);


        // Check and report the result
        if ($updateResult===1) {
            $message = "<p class='message good'>Congratulations, you successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews');
            exit;
        } else {
            $message = "<p class='message'>Sorry but the update failed. Please try again.</p>";
            header('location: /phpmotors/reviews');
            exit;
        }
        break;

        case 'delete':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $reviewData = getReviewData($reviewId);
            
    
    
    
            include '../view/review-delete.php';
    
            break;    

    case 'delete-Review':
        //filter 
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteReview($reviewId);
        // Check for missing data
        if ($deleteResult) {
            $message = "<p class='messgae good'>Congratulations the, Your review was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews');
            exit;
        } else {
            $message = "<p class='message'>Sorry your was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/reviews');
            exit;
        }
        break;

    default:
        //include '../view/review-man.php';

        $classificationList = buildClassificationList($classifications);
        include '../view/admin.php';
        break;
}
