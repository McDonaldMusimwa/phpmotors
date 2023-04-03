<?php
if(!isset($_SESSION['loggedin'])){
  header('Location: /phpmotors/index.php');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify <?php
        if(isset($clientFirstname) && isset($clientLastname)){
            echo $clientFirstname . " " . $clientLastname;
        } elseif(isset($_SESSION['clientData']['clientFirstname'])){
            echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'];
        }
    ?> | PHP Motors</title>
    <meta
      name="description"
      content="Vehicle Page for Fernando Arias in CSE 340: Web Backend Development 1 at Brigham Young University - Idaho"
  >
    <link rel="stylesheet" href="/phpmotors/css/normalize.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico?v=2">
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
        <div class="form-container">
            <h1 class="title-form">Manage Account <?php
                if(isset($clientFirstname) && isset($clientLastname)){
                    echo $clientFirstname . " " . $clientLastname;
                } elseif(isset($_SESSION['clientData']['clientFirstname'])){
                    echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'];
                }
            ?></h1>
            <h2 class="title-form">Update Account</h2>
            <?php
              if (isset($_SESSION['messageAccount'])) {
                echo $_SESSION['messageAccount'];
              }
            ?>
            <form method="post" action="/phpmotors/accounts/index.php">
                <fieldset>
                    <legend>Basic Information</legend>
                    <label class="top">Name* <input type="text" id="clientFirstname" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($_SESSION['clientData']['clientFirstname'])){$name = $_SESSION['clientData']['clientFirstname']; echo "value=$name";} ?> required></label>
                    <label class="top">Last Name* <input type="text" id="clientLastname" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($_SESSION['clientData']['clientLastname'])){$lastName = $_SESSION['clientData']['clientLastname']; echo "value=$lastName";} ?> required></label>
                    <label class="top">Email* <input type="email" id="clientEmail" name="clientEmail" placeholder="someone@gmail.com" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData']['clientEmail'])){$email = $_SESSION['clientData']['clientEmail']; echo "value=$email";} ?> required></label>
                </fieldset>
                <input type="submit" name="submit" id="updateAccount" value="Update Account" class="button">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updateAccount">
                <input type="hidden" name="clientId" value="<?php if(isset($clientId)){echo "value='$clientId'";} elseif(isset($_SESSION['clientData']['clientId'])){$id = $_SESSION['clientData']['clientId']; echo "value=$id";} ?>">
            </form>
            <h2 class="title-form">Update Password</h2>
            <?php
              if (isset($_SESSION['messagePassword'])) {
                echo $_SESSION['messagePassword'];
              }
            ?>
            <form method="post" action="/phpmotors/accounts/index.php">
                <fieldset>
                    <legend>Password</legend>
                    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character <br><br>*note your original password will be changed.</span>
                    <label class="top">Password* <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label>
                    <label class="checkbox"><input type="checkbox" onclick="myFunction()" >Show Password</label>
                </fieldset>
                <input type="submit" name="submit" id="updatePassword" value="Update Password" class="button">
                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" value="<?php if(isset($clientId)){echo "value='$clientId'";} elseif(isset($_SESSION['clientData']['clientId'])){$id = $_SESSION['clientData']['clientId']; echo "value=$id";} ?>">
            </form>
        </div>
    </main>
    <footer>
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
  </div>
  <script src="/phpmotors/js/password.js"></script>
</body>
</html>
<?php unset($_SESSION['messagePassword']); unset($_SESSION['messageAccount']); ?>

