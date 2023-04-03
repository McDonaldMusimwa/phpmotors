<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php if(isset($clientData['clientFirstname']) && isset($clientData['clientLastname'])){ 
		echo "Modify $clientData[clientFirstname] $clientData[clientLastname]";} 
	elseif(isset($clientFirstname) && isset($clientLastname)) { 
		echo "Modify $clientFirstnane $clientLastname"; }?>Php motors</title>
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
        <?php echo $navList; ?></nav>
        <main>  
    
        <form method="post" action='/phpmotors/account/index.php' id='accountupdate' >
            <h1>Manage Account</h1>
            <?php 
          if (isset($message)){
            
            echo $_message;
          }
        
         
          
          ?>
            <fieldset>
              
              <label class='title'>First name:
                <input name='clientFirstname' id='clientFirstName' type='text' required placeholder='FirstName' 
                <?php if(isset($clientFirstname)){ echo "value='$clientFirstname'"; } elseif(isset($clientData['clientFirstname'])) {echo "value='$clientData[clientFirstname]'"; }?>>
              </label>
              <label class='title'>Last name:
                <input name='clientLastname' id='clientLastName' type='text' required placeholder='LastName' 
                <?php if(isset($clientLastname)){ echo "value='$clientLastname'"; } elseif(isset($clientData['clientLastname'])) {echo "value='$clientData[clientLastname]'"; }?>>
              </label>
              <label class='title'>Email:
                <input name='clientEmail' id='clientEmail' type='email' required placeholder='Email' 
                <?php if(isset($clientEmail)){ echo "value='$clientEmail'"; } elseif(isset($clientData['clientEmail'])) {echo "value='$clientData[clientEmail]'"; }?>
                >
              </label>
            
            </fieldset>

            <fieldset id='area2'>
              <input id='regbtn' name='submit' type='submit'  value='Update Info'>
              <!-- Add the action name - value pair-->
              <input type="hidden" name="action" value="updateinfo">
              <input type="hidden" name="clientId" value="
              <?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
              elseif(isset($clientId)){ echo $clientId; } ?>
              ">
            </fieldset>
        </form>

        <form method="post" action='/phpmotors/account/index.php' id='passwordupdate'>
            <fieldset>
              <label class='title'>Password:
                <span>Password must be atleast 8 characters and contain at least 1 number,1 capital letter and 1 special character</span>
                <span>* note your original password will be changed</span>
                <input name='clientPassword' id='clientPassWord' type='password' required placeholder='Password' pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
              </label>
            </fieldset>

            <fieldset id='area3'>
              <input id='passwordbtn' name='submit' type='submit'  value='Update Password'>
              <!-- Add the action name - value pair-->
              <input type="hidden" name="action" value="updatePassword">
              <input type="hidden" name="clientId" value="
                <?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
                elseif(isset($clientId)){ echo $clientId; } ?>
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