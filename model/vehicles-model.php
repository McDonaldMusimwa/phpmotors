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







  







?>