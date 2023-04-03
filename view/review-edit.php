<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" >
    <link rel="stylesheet" href="/phpmotors/css/mobile.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/desktop.css" media="screen">

</head>

<body>
  <?php   ?>

  <header id="beforenav">
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/header.php'; ?>
  </header>
  <nav>
        <button id="humburgerBtn">
          <span>&#9776;</span>
          <span>X</span>
        </button>
            <?php
             echo $navList; ?>
        </nav>
  <main id="editReview-main">

            <?php if ($_SESSION){
                $CarToReview = $reviewData['invMake']. " ". $reviewData['invModel']; 
                
                echo "<h4> $CarToReview</h4>";
            }
            ?>

    <h5>Reviewed On : <?php echo date('d F, Y',strtotime(date($reviewData['reviewDate'])));?></h5>


    <form method='post' action='/phpmotors/reviews/index.php' id='ReviewForm'>
      <fieldset>
        <label>Screen Name:
          <input readonly name='clientName' id='clientName' <?php if (isset($clientFirstname)) {
                                                              echo "value='$clientFirstname'";
                                                            } elseif (isset($reviewData['clientLastname'])) {
                                                              echo "value='$reviewData[clientLastname]'";
                                                            } ?>>
        </label>
        <label class='title'>Write Review:
          <textarea name='clientReview' id='clientReview'  required>
          <?php if(isset($reviewData['reviewTxt'])) {echo $reviewData['reviewTxt'];}  ?>
        
        
        </textarea>
        </label>
      </fieldset>
       
      <fieldset >
              <input id='passwordbtn' name='submit' type='submit'  value='Submit Review'>
              <!-- Add the action name - value pair-->
              <input type="hidden" name="action" value="edit-Review">
              <input type="hidden" name="reviewId" value="
                <?php if(isset($reviewData['reviewId'])){ echo $reviewData['reviewId'];} 
                elseif(isset($reviewId)){ echo $reviewId; } ?>
                ">
                
          </fieldset>
        
      
    </form>



  </main>


  <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>

  </footer>
  <script src="/phpmotors/scripts/index.js"></script>
</body>

</html>