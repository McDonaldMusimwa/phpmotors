<img class='logo' src='/phpmotors/images/site/logo.png' alt="php logo">

<?php 
if(isset($cookieFirstname)){
    echo "<span id='cookiedisplayname'>Welcome $cookieFirstname</span>";
   } 
?>
<p id="myaccount"><a href='./account/index.php?action=login'>My Account</a></p>