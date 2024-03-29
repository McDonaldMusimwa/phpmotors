<?php 
// main php motors model
function regVehicle($invMake,$invModel,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invColor,$classificationId){
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO inventory (invMake, invModel,invDescription, invImage,invThumbnail,invPrice,invStock,invColor,classificationId)
        VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //Next 8 lines replace the placeholder in the SQL 
    //statement with the actual values in the variables
    //and tells the database the type of data it is
    $stmt->bindValue(':invMake',$invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel',$invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription',$invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage',$invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail',$invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice',$invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock',$invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor',$invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId',$classificationId, PDO::PARAM_INT);
    
    // Insert the data
    $stmt->execute(); 
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
   }

function regClassification ($classificationName){
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO carclassification (classificationName)
        VALUES (:classificationName)';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
     //Next 1 lines replace the placeholder in the SQL 
    //statement with the actual values in the variables
    //and tells the database the type of data it is
    $stmt->bindValue(':classificationName',$classificationName, PDO::PARAM_STR);
    
    // The next line runs the prepared statement 
    $stmt->execute(); 
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}

function getInventoryByClassification($classificationId){
    $db = phpmotorsConnect();
    $sql = 'SELECT *
            FROM  inventory
            WHERE classificationId = :classificationId';

   $stmt =$db->prepare ($sql);
   $stmt->bindValue(':classificationId',$classificationId,PDO::PARAM_INT);
   $stmt ->execute();
   $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $inventory;         


}
/*modify function*/
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }


   function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor,
	$classificationId, $invId) {
  $db = phpmotorsConnect();
  $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
   $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function deleteVehicle($invId){
 $db = phpmotorsConnect();
 $sql = 'DELETE FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;



}

function getVehiclesByClassification($classificationName){
    $db = phpmotorsConnect();
    $sql = 'SELECT inventory.invId,
            inventory.invMake,
            inventory.invModel,
            inventory.invDescription,
            inventory.invPrice,
            inventory.invStock,
            inventory.invColor,
            images.imgPath
            FROM inventory
            INNER JOIN images
            ON inventory.invId = images.invId
           WHERE classificationId
           IN 
               (SELECT classificationId 
               FROM carclassification 
               WHERE classificationName = :classificationName) 
               AND images.imgPath 
               LIKE "%-tn.%" 
               AND images.imgPrimary=1 ';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }


// get inventory by Id
function getVehicleByInvId($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT inventory.*,images.imgPath
           FROM inventory
           INNER JOIN images
           ON inventory.invId = images.invId
           WHERE inventory.invId = :invId
           AND images.imgPath
           NOT LIKE "%-tn%"';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }
  
function getVehicleByClassificationId($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $vehicleDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicleDetails;

}

// Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}




?>