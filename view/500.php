<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Php motors</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
  <link rel="stylesheet" href="../css/mobile.css">
  <link rel="stylesheet" href="../css/desktop.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;500&display=swap" rel="stylesheet">

</head>

<body>

  <header id="beforenav">
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/errormessageheader.php'; ?>
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
    <h1>Server Error</h1>
    <p>Sorry our server seens to be experiencing some technical difficulties .Please check back later.</p>
  </main>
  <hr>

  <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>

  </footer>
  <script src="/phpmotors/scripts/index.js"></script>
</body>

</html>