<?php 
if (! $_SESSION['loggedin']){
    header('Location:/phpmotors/index.php');
}
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php Admin motors</title>
    <link rel="stylesheet" href="/phpmotors/css/mobile.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/desktop.css" media="screen">
    
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
        <section class="client"> 
          <h1><?php echo $_SESSION['clientData']['clientFirstname'].'
          '.$_SESSION['clientData']['clientLastname']; ?></h1>
          <?php 
            if (isset($_SESSION['message'])){
                echo $_SESSION['message'];
            }
          ?>
          <ul id="client">
            <li><?php echo "First Name: ".$_SESSION['clientData']['clientFirstname']; ?>
            <li><?php echo "Last Name: ".$_SESSION['clientData']['clientLastname']; ?>
            <li><?php echo "Email: ".$_SESSION['clientData']['clientEmail']; ?>


          </ul>
          <?php 
          if ($_SESSION['clientData']['clientLevel']>1){
            echo '<p class"container" style="margin:20px;text-style:none;color:white;"><a href="/phpmotors/vehicles/index.php? ">
            <img src="../images/carmanagement2.png" alt="Smashicons" style="width:20%;display:block">
            <strong>View vehicle controller</strong>
            </a>
            </p>';
          }
          
          ?>
        </section>
        
        
    </main>
    <hr>
	
    <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/footer.php'; ?>

</footer>
<script src="/phpmotors/scripts/index.js"></script>
<script src="/phpmotors/scripts/index.js"></script>
  </body>
</html>
