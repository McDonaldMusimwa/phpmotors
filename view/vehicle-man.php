<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php motors</title>
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
        <h1>Vehicle Management Portal</h1>
        <section class="vehicles">
            
          <a href='/phpmotors/vehicles/index.php?action=addvehicle'>
            <div class="card">
                <img src="../images/car.png" alt="icon of a car" style="width:70%" >
                <section class='container'>
                <h2 > add Vehicle</h2>
                </section>
            </div>  
          </a>
          <a href='/phpmotors/vehicles/index.php?action=addclassification'>
            <div class="card">
                <img src="../images/classification.png" alt="branching icon" style="width:70%" >
                <section class='container'>
                <h2>add classification</h2>
                </section>
            </div>  
          </a>

          
</section>
<section class="inventoryTable">
<?php
if (isset($message)) { 
 echo $message; 
} 
if (isset($classificationList)) { 
 echo '<h2>Vehicles By Classification</h2>'; 
 echo '<p>Choose a classification to see those vehicles</p>'; 
 echo $classificationList; 
}
?>
<noscript>
<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>
<table id="inventoryDisplay"></table>
</seection>
    </main>
    <hr>
	
    <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/footer.php'; ?>

</footer>
<script src="/phpmotors/scripts/index.js"></script>
<script src="/phpmotors/scripts/inventory.js"></script>
  </body>
</html>
<?php unset($_SESSION['message']); ?>