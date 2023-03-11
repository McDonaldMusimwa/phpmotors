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
$classificationList .='<option> Choose a Classification</option>';
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)){
        if ($classification['classificationId']===classificationId){
            $classificationList .= ' selected ';
            break;
        }
    } elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
         $classifList .= ' selected ';
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
    
    case 'getInventoryItems':
        //Get the classificationid and filter/sanitize it
        $classificationId = filter_input(INPUT_GET,'classificationId',FILTER_SANITIZE_NUMBER_INT);
        //fetch the vehicles by classification from the DB
        $inventoryArray = getInventoryByClassification($classificationId);
        //convert the array to a JSON object and send it back
        echo json_encode($inventoryArray);
        break ;


    case 'mod':
        $invId = filter_input(INPUT_GET,'invId',FILTER_VALIDATE_INT);
        $invInfo=getInvItemInfo($invId);
        if (count($invInfo)<1){
            $message='Sorry no vehicle information could be found';
        }
        include '../view/vehicle-update.php';
        
        break;

    case 'updateVehicle':
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
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($invDescription)
            || empty($invImage) || empty($invThumbnail) || empty($invPrice)
            || empty($invStock) || empty($invColor)|| empty($classificationId)){
            $message = '<p class-"message">Please complete all information for the item! Double check the classification of the item.</p>';
            include '../view/vehicle-update.php';
            exit; 
        }

        // Send the data to the model
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage,$invThumbnail,$invPrice,$invStock,$invColor,$classificationId,$invId);
        
        
        // Check and report the result
        if($updateResult){
            $message = "<p class='message good'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
        } else {
            $message = "<p class='message'>Sorry but the update of $invModel failed. Please try again.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;

        case 'del':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if (count($invInfo) < 1) {
                    $message = 'Sorry, no vehicle information could be found.';
                }
                include '../view/vehicle-delete.php';
                        break;

        case 'deleteVehicle':
            // Filter and store the data
        $invMake = trim(filter_input(INPUT_POST, 'invMake',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        $deleteResult = deleteVehicle($invId);
        // Check for missing data
        if ($deleteResult) {
            $message = "<p class='messgae good'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='message'>Error: $invMake $invModel was not
        deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
                
  

    case 'Classifications':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);
        
        if(!count($vehicles)){
         $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
         $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        
        include '../view/classification.php';
        break;

    case 'selectvehicle':
        $inventoryId=filter_input(INPUT_GET, 'vehicleinfo', FILTER_SANITIZE_NUMBER_INT);
        
        $vehicleDetails =getVehicleByClassificationId($inventoryId);
        
        if(!count($vehicleDetails)){
            $message = "<p class='message'>Sorry, no vehicle could be found.</p>";
        }else{
            $displayVehicle=vehicleDisplayDetails($vehicleDetails[0]);
           
        }
        include '../view/vehicle-detail.php';
        break;

    default:
        //include '../view/vehicle-man.php';

    $classificationList = buildClassificationList($classifications);
    include '../view/vehicle-man.php';
    break;

   
}






?>