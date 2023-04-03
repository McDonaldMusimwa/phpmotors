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
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP MOTORS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" >
    <link rel="stylesheet" href="/phpmotors/css/mobile.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/desktop.css" media="screen">
    
  </head>
  <body>
    
        <header id="beforenav">
        <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/header.php'; ?>
        </header>
        <nav>
        <button id="humburgerBtn">
          <span>&#9776;</span>
          <span>X</span>
        </button>
            <?php
             echo $navList; ?>
        </nav>
      <main> 
        
        
        
        
        <form method="post" action='/phpmotors/vehicles/index.php' id='addvehicle' >
        <h1 class="modifyhead"><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?></h1>
            <h2>* Note all fields are Required</h2>
            <?php 
        if(isset($message)){
          echo $message;
        }

        ?>
            <fieldset>
           <?php echo $classificationList; ?>
            <label class='title' for="invMake">Make:<input name='invMake' id='invMake' type='text' placeholder='Make' required
            <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>
            ></label>
            <label class='title' for="invModel">Model:<input name='invModel' id='invModel' type='text' placeholder='Model' required
            <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>
            ></label>
            <label class='title' for="invDescription">Description:<input name='invDescription' id='invDescription' type='text' placeholder='Description' required
            <?php if(isset($invDescription)){ echo "value='$invDescription'"; } elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; }?>
            ></label>
            <label class='title' for="invImage">Image Path:<input name='invImage' id='invImage' type='text' placeholder='image'
            <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>
            ></label>
            <label class='title' for="invThumbnail">Thumbnail Path:<input name='invThumbnail' id='invThumbnail' type='text' placeholder='thumbnail'
            <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>
            >
        </label>
            <label class='title' for="invPrice">Price:<input name='invPrice' id='invPrice' type='text' placeholder='Price' required
            <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>
            ></label>
            <label class='title' for="invStock">invStock:<input name='invStock' id='invStock' type='text' placeholder='Stock'
            <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>
            ></label>
            <label class='title' for="invColor">invColor:<input name='invColor' id='invColor' type='text' placeholder='Color'
            <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>
            ></label>
          </fieldset>
            <fieldset id='area2'>
            <input id='regbtn' name='submit' type='submit'  value='UpdateVehicle'>
            <!-- Add the action name - value pair-->
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="
            <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
            elseif(isset($invId)){ echo $invId; } ?>
            ">
            
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