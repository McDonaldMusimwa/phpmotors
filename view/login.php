<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php motors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" >
    <link rel="stylesheet" href="/phpmotors/css/mobile.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/desktop.css" media="screen">
    
  </head>
  <body>
    
        <header id="beforenav">
        <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/header.php'; ?>
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
      
        <form method="post" action='/phpmotors/account/index.php' id='login'>
            
            <h1>LOGIN</h1>
            <?php 

          if (isset($_SESSION['registered'])===TRUE){
            
            echo $_SESSION['message'];
          }
          
          ?>
            <fieldset>
            <label class='title'>Email:<input name='clientEmail' id='clientEmail' type='text' placeholder='Username' required <?php if(isset($clientEamil)){echo "value='$clientEamil'";}?>></label>
            <span >Password must be atleast 8 characters and contain at least 1 number,1 capital letter and 1 special characteer</span>
            <label class='title'>Password:</label>
            
            <input name='clientPassword' id='clientPassword' type='password' placeholder='Password' required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            </fieldset>
            <fieldset id='area2'>
            <input style="color:white;background-color:#444;" id='submit' name='submit' type='submit' value='Sign In'>
            <!-- Add the action name - value pair-->
            <input type="hidden" name="action" value="Login">
            <label class='signup'>No Account?<a style=" margin: 1rem 0;" href='/phpmotors/account/index.php?action=registration'>Sign-up</a></label>
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