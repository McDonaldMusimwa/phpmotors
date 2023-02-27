<img class='logo' src='/phpmotors/images/site/logo.png' alt="php logo">
<p class="myaccount">
<?php 

if(isset($_SESSION['clientData'])){
    $userName = $_SESSION['clientData']['clientFirstname'];
   
    echo "<a href='/phpmotors/account/index.php?'> Welcome <strong>$userName</strong> | </a>";
    
   echo "<a href='/phpmotors/account/index.php?action=logout'><img class='icon' src='/phpmotors/images/logout.png' alt='logout'> Logout</a>";
   


    
    
}else{
    echo '<a href="/phpmotors/account/index.php?action=login">
    <img class="icon"  src="/phpmotors/images/user.png" alt="user login"> 
    My Account</a>';
   
   
   }
?>

</p>