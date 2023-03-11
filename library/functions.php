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
   $navList = '<ul id="myLinks">';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($carclassifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles?action=Classifications&classificationName="
 .urlencode($classification['classificationName']).
 "' title='View our $classification[classificationName] lineup
  of vehicles'>$classification[classificationName]</a></li>"; 
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

//Wrap vehicles by classification in a list
function buildVehiclesDisplay($vehicles){
    
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        
        $dv .= "<a href='/phpmotors/vehicles?action=selectvehicle&vehicleinfo= {$vehicle['invId']}>' ";
     $dv .= '<li class="car-card admin">';
     
     $dv .= "<img class='car' src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $dv .= "<span>R $vehicle[invPrice]</span>";
     
     $dv .= '</li>';
     $dv .='</a>';
    }
    $dv .= '</ul>';
    return $dv;
   }

   function vehicleDisplayDetails($vehicle){
    
    
    $div = '<div id="detail-main" >';
    $div .='<div id="detail-main-picarea">';
    $div .= "<img class='admin' id='main-pic' src='$vehicle[invImage]' alt='$vehicle[invMake]' >";
   
   
    $div .= "<p id='vehicle-descr'>$vehicle[invDescription]</p>";
    $div .= "<p id='vehicle-color'><strong>Color :$vehicle[invColor]</strong></p>";
    $div .= "<h2 id='vehicle-stock'>InStock: $vehicle[invStock]</h2>";
    $div .='</div>';
    $div .='<section id="head-price">';
    $div .= "<h2>$vehicle[invMake],$vehicle[invModel]</h2>";
    $div .= "<h3 ><strong>Price :$ $vehicle[invPrice]</strong></h3>";
    
    $div .= '<div id="printarea">';
    $div .= '<img class="icon" src="/phpmotors/images/printer.png" alt="printer icon">';
    $div .= '<p>Print Vehicle</p>';
    $div .= '<img class="icon" src="/phpmotors/images/calculator.png" alt="price calculator">';
    $div .='<p>Payment Calculator</p>';
    $div .='</div>';
    $div .= '</section>';
    
    $div .= '<form method="post" action="/phpmotors/account/index.php" id="clientcontact">';
    $div .= '<label class="label">To:phpmotors</label>';
    $div .= '<label class="label">From:<input type="email" placeholder="my email" name="clientName"></label>';
    $div .='<label class="label">Request Details<input type="text" name="request"></label>';
    $div .='<label class="label">I can be reached at:<input type="text" name="contact"></label>';
    $div .= '<label class="label">First name:<input type="text" name="firstname" placeholder="firstname"></label>';
    $div .= '<label class="label">Last name: <input type="text" name="lastname" placeholder="lastname" ></label>';
    $div .= '<label class="label-block">Additional info or Questions:<textarea id="textarea" type="text" name="description"></textarea></label>';
    $div .= '<fieldset id="button-area">';             
    $div .= '<input type="submit" name="submit" value="Send Message">';
    $div .= '<input type="hidden" name="action" value="sendmessage">';
    $div .= '<a style="margin-left:6rem;" href="" >Privacy Policy</a>';
    $div .= '</fieldset>';
    $div .= '</form>';   
    
$div .= '</div>';
return $div;
   }


?>