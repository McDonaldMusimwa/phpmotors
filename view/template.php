<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php motors</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/large.css">
    
  </head>
  <body>
    
        <header id="beforenav">
        <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
      <main>  
        <div>The content goes here</div>
    </main>
    <br>
	
    <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/footer.php'; ?>

</footer>
<script src="scripts/index.js"></script>
  </body>
</html>