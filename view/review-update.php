<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Update | PHP Motors</title>
    <meta
      name="description"
      content="Review Update Page for Fernando Arias in CSE 340: Web Backend Development 1 at Brigham Young University - Idaho"
  >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" >
    <link rel="stylesheet" href="/phpmotors/css/mobile.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/desktop.css" media="screen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
  </head>
<body>
  <div class="body">
    <header>
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
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
         <div class="form-container detail">
            <h2><?php echo $reviewInfo['invMake']." ".$reviewInfo['invModel']." "."Review" ?></h2>
            <?php
              if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
              }
            ?>
            <?php 
                $reviewDate = date('d F, Y',strtotime(date($reviewInfo['reviewDate'])));
                echo "<p>Reviewed on $reviewDate</p>"
            ?>
            <form method="post" action="/phpmotors/reviews/">
                <fieldset>
                    <legend>Review Update</legend>
                    <label class="top">Review Text: <textarea name="reviewText" id="reviewText" required><?php if(isset($reviewInfo['reviewText'])) {echo $reviewInfo['reviewText'];}  ?></textarea></label>
                    <input type="submit" id="submitReviewUpdate" value="Update" class="button">
                    <input type="hidden" name="action" value="update-review">
                    <input type="hidden" name="reviewId" value="<?php if(isset($invInfo['reviewId'])){echo $reviewInfo['reviewId'];} elseif(isset($reviewId)){echo $reviewId;} ?>">
                </fieldset>
            </form>
        </div>
    </main>
    <footer>
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
  </div>
</body>
</html>
<?php unset($_SESSION['message']) ?>