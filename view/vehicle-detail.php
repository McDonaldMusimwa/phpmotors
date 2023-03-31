<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
  <link rel="stylesheet" href="/phpmotors/css/mobile.css">
  <link rel="stylesheet" href="/phpmotors/css/desktop.css">

</head>

<body>
  <?php   ?>

  <header id="beforenav">
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/header.php'; ?>
  </header>
  <nav><?php echo $navList; ?></nav>
  <main id="details-vehicle">
    <h1>Vehicle Details</h1>

    <?php
    if (isset($displayVehicle)) {
      echo $displayVehicle;
    }
    ?>
    <br>
    <h4>Customer Reviews</h4>
    
    <h5>Review the :<?php echo $vehicleDetailsForReviews['invMake'];

                    echo $vehicleDetailsForReviews['invModel']; ?></h5>

    <?php
    if (!$_SESSION) {
      echo '<p>You must<a href="/phpmotors/account?action=login"> login</a> to write a Review</p>';
    } else {
      echo "<form method='post' action='/phpmotors/reviews/index.php' id='ReviewForm' >
            <fieldset>
              <label>Screen Name: 
              <span>{$screenName}</span>
              </label>
            <label class='title'>Write Review:
              <textarea name='clientReview' id='clientReview' type='text' required placeholder='Write review here' ></textarea>
              </label>
            
            <div id='area2'>
            <input id='regbtn' name='submit' type='submit'  value='Submit Review'>
            <!-- Add the action name - value pair-->
            <input type='hidden' name='action' value='Add-new-review'>
            <input type='hidden' name='invId' value='$vehId'>
             
             <input type='hidden' name='clientId' value='$clieId'>
             
        
            </div>
            </fieldset>
        </form>";
    }; ?>

    <div id="Reviews">

      <?php
      if (isset($displayReview)) {

        echo $displayReview;
      }



      ?>


    </div>
  </main>


  <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>

  </footer>
  <script src="/phpmotors/scripts/index.js"></script>
</body>

</html>