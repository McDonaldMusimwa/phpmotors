<?php
/*****************************
 * vehicle management controller
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
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)){
        if ($classification['classificationId']===classificationId){
            $classificationList .= ' selected ';
            break;
        }
    }
    $classificationList.=">$classification[classificationName] </option>"; 
}
$classificationList .="</select>";

 
$action = filter_input(INPUT_POST,'action');
if ($action==NULL){
    $action = filter_input(INPUT_GET,'action');
}

switch ($action){
    case 'classification':
        //filter stoe the data
        $classificationName=trim(filter_input(INPUT_POST,'classificationName',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationName=checkClassificationName($classificationName);
        //check for missing data
        if (empty($classificationName)){
            $message='<p class="message">Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
        }
            //Sennd the data to the model
            $regOutcome = regClassification($classificationName);
            //check and report
            if ($regOutcome===1){
                $message ="<p> $classificationName, has been added.</p>";
                include '../view/add-classification.php';
                exit;
            }else{
                $message ="<p class='message'>Sorry $classificationName, but the registration failed.Please try again</p>";
                include '../view/add-classification.php';
                exit;
            }
    break;        
       
    case 'Register Vehicle':
        
        // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice',FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock',FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST,'classificationId',FILTER_SANITIZE_NUMBER_INT));
        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)|| empty($classificationId)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit; 
        }

        // Send the data to the model
        $newVehicle = regVehicle($invMake, $invModel, $invDescription, $invImage,$invThumbnail,$invPrice,$invStock,$invColor,$classificationId);
        
        
        // Check and report the result
        if($newVehicle === 1){
            $message = "<p>The $invModel was added.</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p class='message'>Sorry but the registratiopn of $invModel failed. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;
        
    
    case 'addvehicle':
        include '../view/add-vehicle.php';
    break;
    case 'addclassification':
        include '../view/add-classification.php';
    break;
    default:
    //$pageTitle='VEHICLE MANAGEMENT';
    include '../view/vehicle-man.php';
    break;
}






?>