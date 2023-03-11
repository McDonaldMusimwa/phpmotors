
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Php motors</title>
    <link rel="stylesheet" href="/phpmotors/css/mobile.css" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/desktop.css" media="screen">
    
  </head>
  <body>
    
        <header id="beforenav">
        <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/header.php'; ?>
        </header>
        <nav>
            <?php
             echo $navList; ?>
        </nav>
      <main> 
        <section class="hero"> 
            <div class="details"> 
            <h1><strong>Welcome to PHP Motors!</strong></h1>
            <p><strong>DMC Delorean</strong><br>
            3 Cup holders <br>
            Superman doors <br>
            Fuzzy dice!</p></div>
            <picture class='car'>
                <img id='car' src='/phpmotors/images/vehicles/monster.jpg' alt="delorean gray fast car">
            </picture>
            <picture class='owntoday'><img id='button' src='/phpmotors/images/site/own_today.png' alt="open me button"></picture>
        </section>
        <div id="reviews_upgrades">
        <section class="reviews"> 
            <h2><strong>DMC Delorean Reviews</strong></h2>
           <ul>
            <li>"So fast its almost like traveling in time " (4/5)</li>
            <li>"Coolest ride on the road " (4/5)</li>
            <li>"I`m feelings Marty McFly" (5/5)</li>
            <li>"The most futuristic ride of our day " (4/5)</li>
            <li>"80`s livin and l love it!" (5/5)</li>
            </ul>
        </section>
        <section class='bottom_area'> 
            <h2><strong>Delorean Upgrades </strong></h2>
            <div class="bottom_section" >
            <div>
                <picture>
                    <img class="bottom_pics" src='/phpmotors/images/upgrades/flux-cap.png' alt="capacitor">
                </picture>
                <a href=''>Flux Capacitor</a>
            </div>
            <div>
                <picture>
                    <img class="bottom_pics" src='/phpmotors/images/upgrades/flame.jpg' alt="fire decal">
                </picture>
                <a href=''>Flame Decals</a>
            </div>
            <div>
                <picture>
                    <img class="bottom_pics" src='/phpmotors/images/upgrades/bumper_sticker.jpg' alt="sticke">
                </picture>
                <a href=''>Bumper Stickers</a>
            </div>
            <div>
                <picture>
                    <img class="bottom_pics" src='/phpmotors/images/upgrades/hub-cap.jpg' alt="wheel cover">
                </picture>
                <a href=''>Hub Caps</a>
            </div>
            </div>
        </section>
        </div>
        
    </main>
    <hr>
	
    <footer>

    <?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/modules/footer.php'; ?>

</footer>
<script src="/phpmotors/scripts/index.js"></script>
<script src="/phpmotors/scripts/index.js"></script>
  </body>
</html>