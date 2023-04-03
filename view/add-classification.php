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
    <title>Php motors</title>
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
        
    
        <form method="post" action='/phpmotors/vehicles/index.php' id='addclassification' >
               
          <h1>Add Car Classification </h1>
          <?php 
          if(isset($message)){
            echo $message;
          }

          ?>
        
            <fieldset>
        
            <label class='title'>ClassificationName:</label>
              <span>classificationName must be less than 30 charasters long</span>
              <input name='classificationName' id='classification' type='text' placeholder='classificationName '
            required pattern = '^(?=.{1,30}$).*'
           
            >
     
            
            <input id='regbtn' name='submit' type='submit'  value='Add Classification'>
            <!-- Add the action name - value pair-->
            <input type="hidden" name="action" value="classification">
            
            </fieldset>
        </form>

    </main>
    <hr>
	
    <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/footer.php'; ?>

</footer>
<script src="/phpmotors/scripts/index.js"></script>

  </body>
</html>