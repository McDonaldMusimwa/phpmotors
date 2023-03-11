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
    
        <form method="post" action='/phpmotors/account/index.php' id='login' >
            <h1>Join Our Team </h1>
            <?php 
          if (isset($message)){
            
            echo $_message;
          }
          
          
          
          ?>
            <fieldset>
            <label class='title'>First name:
              <input name='clientFirstname' id='clientFirstName' type='text' required placeholder='FirstName' <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>>
            </label>
            <label class='title'>Last name:
              <input name='clientLastname' id='clientLastName' type='text' required placeholder='LastName' <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>>
            </label>
            <label class='title'>Email:
              <input name='clientEmail' id='clientEmail' type='email' required placeholder='Email' <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
            </label>
            <label class='title'>Password:

            </label>
            <span>Password must be atleast 8 characters and contain at least 1 number,1 capital letter and 1 special character</span>
            <input name='clientPassword' id='clientPassWord' type='password' required placeholder='Password' pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            </fieldset>
            <fieldset id='area2'>
            <input id='regbtn' name='submit' type='submit'  value='Register'>
            <!-- Add the action name - value pair-->
            <input type="hidden" name="action" value="register">
            
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