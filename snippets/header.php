<picture>
    <img src="/phpmotors/images/site/logo.png" alt="PHP Motors website logo." width="200" height="72">
</picture>
<div>
    <?php   if(isset($_SESSION['loggedin'])){
            $name = $_SESSION['clientData']['clientFirstname'];
            echo "<a href='/phpmotors/accounts/index.php' class='custom-button'>Welcome $name</a>";
    } ?>
    <?php   if(isset($_SESSION['loggedin'])){
        echo "<a class='account' href='/phpmotors/accounts/index.php?action=Logout'>Logout</a>";
    }else{
        echo '<a class="account" href="/phpmotors/accounts/index.php?action=login">My Account</a>';
            } ?>
</div>
