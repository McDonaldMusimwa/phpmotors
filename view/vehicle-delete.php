<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
    
  </head>
  <body>
    
        <header id="beforenav">
        <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/header.php'; ?>
        </header>
        <nav>
            <?php
             echo $navList; ?>
        </nav>
      <main> 
        
        
        
        
        <form method="post" action='/phpmotors/vehicles/index.php' id='addvehicle' >
        <h1><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
            <h2>* Note all fields are Required</h2>
            <?php 
        if(isset($message)){
          echo $message;
        }

        ?>
            <fieldset>
           <?php echo $classificationList; ?>
            <label class='title' for="invMake">Make:<input name='invMake' readonly id='invMake' type='text' placeholder='Make' required
            <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>
            ></label>
            <label class='title' for="invModel">Model:<input name='invModel' readonly id='invModel' type='text' placeholder='Model' required
            <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>
            ></label>
            <label class='title' for="invDescription">Description:<input name='invDescription' readonly id='invDescription' type='text' placeholder='Description' required
            <?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?>
            ></label>
            
          </fieldset>
            <fieldset id='area2'>
            <input id='regbtn' name='submit' type='submit'  value='Delete Vehicle'>
            <!-- Add the action name - value pair-->
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="
            <?php if(isset($invInfo['invId'])){echo $invInfo['invId'];} ?>">
            
            </fieldset>
        </form>

    </main>
    <hr>
	
    <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/footer.php'; ?>

</footer>
<script src="/phpmotors/scripts/index.js"></script>
<script src="/phpmotors/scripts/index.js"></script>
  </body>
</html>