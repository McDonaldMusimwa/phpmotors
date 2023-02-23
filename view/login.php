<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php motors</title>
    <link rel="stylesheet" href="/phpmotors/css/base.css">
    <link rel="stylesheet" href="/phpmotors/css/large.css">
    
  </head>
  <body>
    
        <header id="beforenav">
        <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/header.php'; ?>
        </header>
        <nav>
            <?php echo $navList; ?>
        </nav>
      <main>  
      
        <form method="post" action='/phpmotors/account/index.php' id='login'>
            <img  src='/phpmotors/images/login.png' alt='loginpicture'>
            <h1>Sign in</h1>
            <?php 
          if (isset($message)){
            echo $message;
          }
          
          
          
          ?>
            <fieldset>
            <label class='title'>Email:<input name='clientEmail' id='clientEmail' type='text' placeholder='Username' required <?php if(isset($clientEamil)){echo "value='$clientEamil'";}?>></label>
            <label class='title'>Password:</label>
            <span>Password must be atleast 8 characters and contain at least 1 number,1 capital letter and 1 special characteer</span>
            <input name='clientPassWord' id='clientPassWord' type='text' placeholder='Password' required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            </fieldset>
            <fieldset id='area2'>
            <input style="color:black" id='submit' name='submit' type='button' value='LOGIN'>
            <!-- Add the action name - value pair-->
            <input type="hidden" name="action" value="Login">
            <label class='signup'>No Account?<a href='/phpmotors/account/index.php?action=registration'>Sign-up</a></label>
            </fieldset>
        </form>
    </main>
    <br>
	
    <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/footer.php'; ?>

</footer>
<script src="/phpmotors/scripts/index.js"></script>
  </body>
</html>