<?php
if (!$_SESSION['loggedin']) {
  header('Location:/phpmotors/index.php');
}
?>
<!DOCTYPE html>
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
    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/header.php'; ?>
  </header>
  <nav>
    <?php
    echo $navList; ?>
  </nav>
  <main>



    <section class="client">
      <h1><?php echo $_SESSION['clientData']['clientFirstname'] . '
          ' . $_SESSION['clientData']['clientLastname'];

          ?></h1>
      <?php
      if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
      }
      ?>
      <ul id="client">
        <li><?php
            if ($_SESSION['updated'] === FALSE) {
              echo "First Name: " . $_SESSION['clientData']['clientFirstname'];
            } else {
              echo "First Name: " . $_SESSION['clientFirstname'];
            }; ?>
        <li><?php
            if ($_SESSION['updated'] === FALSE) {
              echo "Last Name: " . $_SESSION['clientData']['clientLastname'];
            } else {
              echo "Last Name: " . $_SESSION['clientLastname'];
            }; ?>
        <li><?php
            if ($_SESSION['updated'] === FALSE) {
              echo "Email: " . $_SESSION['clientData']['clientEmail'];
            } else {
              echo "Email: " . $_SESSION['clientEmail'];
            }; ?>


      </ul>
      <section>
        <h2>Account Management</h2>
        <div>
          <a href="/phpmotors/account/index.php?action=update">
            <img style="width:60px;display:block;" class="admin" src="/phpmotors/images/user.png" alt="user icon">
            Update Account information
          </a>
        </div>

      </section>
      <section class="adminlinks">
        <?php
        if ($_SESSION['clientData']['clientLevel'] > 1) {
          echo '<h3  ><a  href="/phpmotors/vehicles/index.php? ">
            <img class="admin" src="../images/carmanagement2.png" alt="Smashicons" >
            <strong class="admin">View vehicle controller</strong>
            </a>
            </h3>';
        }

        ?>
      </section>
      <section class="adminlinks">
        <h4 style="margin-left:black;">Review Management</h4>
        <?php
        if ($_SESSION['clientData']['clientLevel'] >= 1) {
          echo '<p style="margin-left:0;">
            <a  href="/phpmotors/reviews?action=Review-management ">
            <img class="admin" src="../images/reviews.png" alt="freepik" style="width:20%;display:block">
            <strong class="admin">Manage Reviews</strong>
            
            </a>
            </p>';
        }

        ?>
      </section>
    </section>


  </main>


  <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/modules/footer.php'; ?>

  </footer>
  <script src="/phpmotors/scripts/index.js"></script>
  <script src="/phpmotors/scripts/inventory.js"></script>
</body>

</html>