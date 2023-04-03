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
     
     $dv .= "<img class='car' src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
     $dv .= "<span>R $vehicle[invPrice]</span>";
     
     $dv .= '</li>';
     $dv .='</a>';
    }
    $dv .= '</ul>';
    return $dv;
   }

   function vehicleDisplayDetails($vehicle,$image){
    
    
    $div = '<div id="detail-main" >';
    $div .='<div id="detail-main-picarea">';
    $div .= "<img class='admin' id='main-pic' src='$vehicle[invImage]' alt='$vehicle[invMake]' >";
    foreach ($image as $img){
        $div .= "<img class='' src='$img[imgPath]' alt='vehicle'>";
    }
    $div .= "<p id='vehicle-descr'>$vehicle[invDescription]</p>";
    $div .= "<p id='vehicle-color'><strong>Color :$vehicle[invColor]</strong></p>";
    $div .= "<h2 id='vehicle-stock'>InStock: $vehicle[invStock]</h2>";
    $div .='</div>';
    $div .='<section id="head-price">';
    $div .= "<h2>$vehicle[invMake],$vehicle[invModel]</h2>";
    $div .= "<h3 ><strong>Price :$ $vehicle[invPrice]</strong></h3>";
    

    
     $div .= '<a href="#Reviews">Reviews<input type="hidden" name="invId" value=$vehicle[invId]></a>';
    
    
    
    
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
    $div .= '</section>';
    $div .= '</div>';
return $div;
   }
/* helper functions for images */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
   }

   // Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
   }

   // Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
   }

   // Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
   }

   // Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }


// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends resizeImage function



   /*this generate a template top render all customers reviews for each vehicle from the database*/



   function renderAllReviews($reviews) {
    $rev = '<div class="reviewline"></div>';
    $rev .= '<div class="reviews">';
    
    foreach ($reviews as $review) {
        $firstname = substr($review['clientFirstname'],0,1);
        $lastname = $review['clientLastname'];
        $date = date('d F, Y',strtotime(date($review['reviewDate'])));
     $rev .= "<div class='each-review'><strong>$firstname $lastname Reviewed on $date</strong>";
     $rev .= "<p>$review[reviewTxt]</p>";
     $rev .= "</div>";
    }
    $rev .= '</div>';
    return $rev;
   }


   


/* the function to deliver review template per client*/
function buildReviewList($data) { 
    $ul = '<ul id="reviewDisplay">';
    
    foreach($data as $review){
        $date =date('d F, Y',strtotime( date($review['reviewDate'])));
        
        $ul .= "<li>$review[invMake]  $review[invModel] (Revised on $date ";
       
        $ul .= "<div class='li-Btns'>";
        $ul .= "<a class='altBtn mod' href='/phpmotors/reviews?action=edit&reviewId={$review['reviewId']}'>Modify </a>";
        $ul .= "<a class='altBtn del' href='/phpmotors/reviews?action=delete&reviewId={$review['reviewId']}'>Delete </a>";
        $ul .= "<input type='hidden' name='reviewId' value='<?php echo $review[reviewId]   ?>' >";
        $ul .= "</div>";
        $ul .= "</li>";
        
    }

    $ul .= '</ul>';

    return $ul;
   }
   
   

?>