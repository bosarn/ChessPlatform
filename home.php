<?php
require_once "lib/autoload.php";
if (isset($_SESSION['usr']) ){
    $my_id= $_SESSION['usr_id'];
    $myname = $_SESSION['usr_username'];}

    else{
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="vieuwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <title>Home is where the heart is</title>
</head>

<body>

<!-- Mainheader -->

<header class="mainheader">
    <div class="overlay">
        <p>Become a <span>Chessmaster</span></p>
        <h1>CHESS PLATFORM</h1>
    </div> <!-- Overlay -->
</header>
<!-- section 1 -->
<section class="section-one container">
    <article>
        <div class="respo-img">
            <img src="img/Kasp-karp.jpg" alt="">
        </div> <!-- responsice image -->
        <div class="content">
            <p class="hoofding">Kasparov vs karpov</p>
            <h2>Het wereldkampioenschap</h2>
            <p>
                Kasparov (links) en Karpov tijdens de match om het wereldkampioenschap in 1985. Al op jonge leeftijd raakte Kasparov gefascineerd door het schaakspel en hij belandde dan ook op de bekende schaakschool van Michail Botvinnik. Op zijn dertiende werd hij voor het eerst Russisch jeugdkampioen schaken met een ongekend hoog niveau, een jaar later in 1977 herhaalde hij dit met   nog betere cijfers. Zijn eerste successen als jeugdspeler boekte hij onder de naam Harry           Weinstein,maar enkele jaren na het overlijden van zijn vader besloot hij verder te gaan        onder de gerussificeerde versie van de naam van zijn moeder (Kasparjan).

                In 1978 debuteerde hij, 15 jaar oud, in het kampioenschap van de Sovjet-Unie. In 1979 werd hij voor het eerst 'losgelaten' op een internationaal toernooi en liet in Banja Luka 14 grootmeesters achter zich. In 1980 werd hij wereldkampioen bij de jeugd en in 1981 de jongste kampioen van de Sovjet-Unie.
            </p>
            <button>Lees meer</button>
        </div> <!-- content -->
    </article>
    <article>
        <div class="respo-img">
            <img src="img/MagnusCarlsen.jpg" alt="">
        </div> <!-- responsice image -->
        <div class="content">
            <p class="hoofding">Sven Magnus Øen Carlsen </p>
            <h2>De huidige wereldkampioen</h2>
            <p>Sven Magnus Øen Carlsen (Tønsbergis een Noors schaker en is de huidige wereldkampioen. Hij drong reeds op jonge leeftijd door tot de wereldtop en wordt beschouwd als een van de sterkste schakers ooit. Hij werd op zijn dertiende grootmeester. Op 1 januari 2010 werd Carlsen de jongste schaker die ooit de FIDE-ratinglijst aanvoerde. In januari 2013 bereikte Carlsen een rating van 2861 en verbrak daarmee het record van Garri Kasparov. Carlsen won het kandidatentoernooi in Londen van 2013. In de tweekamp tegen de regerend wereldkampioen Viswanathan Anand (zie Wereldkampioenschap schaken 2013) in november in Chennai versloeg hij Anand met 6½-3½, waardoor hij de op een na jongste wereldkampioen ooit werd. Alleen Kasparov was jonger. In 2014 (tegen Anand), 2016 (tegen Sergej Karjakin) en 2018 (tegen Fabiano Caruana)[1] verdedigde hij zijn titel met succes.
            </p>
            <button>Lees meer</button>
        </div> <!-- content -->
    </article>
</section>
<!-- section 2 -->
<section class="section-two">
    <header class="container">
        <p class="hoofding">“Typically, however, the winner is just the player who made the next-to-last mistake.”
        </p>
        <h2>― Garry Kasparov</h2>
    </header>
</section>

<!-- Mainfooter -->
<footer class="mainfooter">
    <ul class="list-unstyled social">
        <li>
            <a href="#" type="" title="">
                <span class="fa fa-twitter"></span>
                <span class="sr-only">Twitter</span>
            </a>
        </li>
        <li>
            <a href="#" type="" title="">
                <span class="fa fa-facebook"></span>
                <span class="sr-only">Facebook</span>
            </a>
        </li>
        <li>
            <a href="#" type="" title="">
                <span class="fa fa-instagram"></span>
                <span class="sr-only">Instagram</span>
            </a>
        </li>
        <li>
            <a href="contact.php" type="" title="">
                <span class="fa fa-envelope-o"></span>
                <span class="sr-only">E-mail</span>
            </a>
        </li>
    </ul>
    <p>&copy;Chess Platform. Alle rechten voorbehouden.</p>
</footer>

<nav id="metanav">
    <a href="#" type="logo"><img src="img/logonavw.png"  class="logonav" alt=""></a>
    <ul class="metanav">
        <li><a href="account.php" type="" title="" class="actiefitemmeta">Account</a></li>
        <li><a href="friends.php" type="" title="">Friends</a></li>
        <li><a href="contact.php" type="" title="">Contact</a></li>
        <li><a href="lib/logout.php" type="" title="" class="logout">Log Out</a></li>
    </ul>


    <!--####################-->
    <?php

    echo '
        <div class="quickplay">        
        <form id="game" method="post" action="lib/matching.php"">
        <label for="game"></label>';

    echo "<input type=hidden value='$my_id' name=game>";

    echo '<button name="match" id="match" value="Quick Play" class="btnplay">Quick Play</button></form></div>';
    ?>
    <!--####################-->
</nav>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
