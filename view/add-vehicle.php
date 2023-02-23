


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php motors</title>
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
        <h1>Add Vehicle </h1>
            <h2>* Note all fields are Required</h2>
            <?php 
        if(isset($message)){
          echo $message;
        }

        ?>
            <fieldset>
           <?php echo $classificationList; ?>
            <label class='title' for="invMake">Make:<input name='invMake' id='invMake' type='text' placeholder='Make' required
            <?php if(isset($invMake)){echo "value='$invMake'";}  ?>
            ></label>
            <label class='title' for="invModel">Model:<input name='invModel' id='invModel' type='text' placeholder='Model' required
            <?php if(isset($invModel)){echo "value='$invModel'";}  ?>
            ></label>
            <label class='title' for="invDescription">Description:<input name='invDescription' id='invDescription' type='text' placeholder='Description' required
            <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?>
            ></label>
            <label class='title' for="invImage">Image Path:<input name='invImage' id='invImage' type='text' placeholder='image'
            <?php if(isset($invImage)){echo "value='$invImage'";}  ?>
            ></label>
            <label class='title' for="invThumbnail">Thumbnail Path:<input name='invThumbnail' id='invThumbnail' type='text' placeholder='thumbnail'
            <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?>></label>
            <label class='title' for="invPrice">Price:<input name='invPrice' id='invPrice' type='text' placeholder='Price' required
            <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>
            ></label>
            <label class='title' for="invStock">invStock:<input name='invStock' id='invStock' type='text' placeholder='Stock'
            <?php if(isset($invStock)){echo "value='$invStock'";}  ?>
            ></label>
            <label class='title' for="invColor">invColor:<input name='invColor' id='invColor' type='text' placeholder='Color'
            <?php if(isset($invColor)){echo "value='$invColor'";}  ?>
            ></label>
          </fieldset>
            <fieldset id='area2'>
            <input id='regbtn' name='submit' type='submit'  value='Register Vehicle'>
            <!-- Add the action name - value pair-->
            <input type="hidden" name="action" value="Register Vehicle">
            
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