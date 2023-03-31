<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php motors | registration</title>
    <link rel="stylesheet" href="/phpmotors/css/base.css">
    <link rel="stylesheet" href="/phpmotors/css/large.css">
    
  </head>
  <body>
    
        <header id="beforenav">
        <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/header.php'; ?>
        </header>
        <nav><?php echo $navList; ?></nav>
        <main>  
    
        <form method="post" action='/phpmotors/reviews/index.php' id='Review' >
            <h1>Post a review</h1>
            <?php 
          if (isset($message)){
            
            echo $_message;
          }
          
          
          
          ?>
            <fieldset>
            <label class='title'>Write Review:
              <textarea name='clientReview' id='clientReview' type='text' required placeholder='Write review here' ></textarea>
            </label>
            
            <fieldset id='area2'>
            <input id='regbtn' name='submit' type='submit'  value='Write Review'>
            <!-- Add the action name - value pair-->
            <input type="hidden" name="action" value="Add-new-review">
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
  </body>
</html>