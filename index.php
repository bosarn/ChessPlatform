<?php

$login_form = true;
require_once "lib/autoload.php";

//redirect naar homepage als de gebruiker al ingelogd is
if ( isset($_SESSION['usr']) )
{

    header("Location:home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="vieuwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/opmaak.css">
    <link rel="stylesheet" href="css/menu.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <title>Welkom op het ChessPlatform</title>
</head>
<header class="showcase">
    <!--   <img src="images/logo1.png" alt="" class="logoheader">-->
    <div class="container showcase-inner">

        <h1>Schaakplatform</h1>
<p>Click the hamburger top left to begin!</p>
        <?php

        if(isset($_GET['loginfailed']))
        {
            echo '<h2> Passwoord incorrect!</h2>';
        }

        if(isset($_GET['formfailed']))
        {
            echo '<h2> Form incorrect!</h2>';
        }

        ?>
        <?php

        if(isset($_GET['registerfailed']))
        {
            echo '<h2> Register Failed !</h2>';
        }
        ?>
    </div>
</header>
<body>
<div id="id01" class="modal"> <!--LOGIN KNOP HIDDEN  -->

    <form class="modal-content animate" action="lib/login.php" method="post" name="A" id="A">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="img/logo1.png" alt="logo" class="logo">
        </div>

        <div class="container">
            <input type="hidden" id="formname" name="formname" value="login_form">
            <label for="usr_email">E-mail</label>
            <input type="email"  id="usr_email" name="usr_email">

            <label for="usr_pasw">Wachtwoord</label>
            <input type="password"  id="usr_pasw" name="usr_pasw">
            <?php

            if(isset($_GET['loginfailed']))
            {
                echo '<p> Passwoord incorrect!</p>';
            }

            if(isset($_GET['formfailed']))
            {
            echo '<p> Form incorrect!</p>';
            }

            ?>
            <span class="register">No login yet? <a href="index.php" class="reg">Register here!</a></span>

            <button type="submit" name ="loginbutton" id="" value="login">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>

        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#" class="forgotpass">username or password?</a></span>
        </div>
    </form>
</div>
<div id="id02" class="modal"> <!--LOGIN KNOP HIDDEN  -->

    <form class="modal-content animate" action="lib/register.php" method="post" id="registration_form">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div >

        <div class="container">

            <input type="hidden" id="formname" name="formname" value="registration_form">
            <input type="hidden" id="tablename" name="tablename" value="users">
            <input type="hidden" id="pkey" name="pkey" value="usr_id">

            <label for="usr_name" >Naam</label>
            <input type="text"  id="usr_name" name="usr_name">


            <label for="usr_username" >username</label>
            <input type="text"  id="usr_username" name="usr_username">

            <label for="usr_email">E-mail</label>
            <input type="email"  id="usr_email" name="usr_email">

            <label for="usr_pasw">Wachtwoord</label>
            <input type="password"  id="usr_pasw" name="usr_pasw">


            <button name="registerbutton" type="submit" value="Register"> Register</button>

        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
</div>
<div class="menu-wrap">
    <input type="checkbox" class="toggler">
    <div class="hamburger"><div></div></div>
    <div class="menu">
        <div>
            <div>
                <ul>
                    <li><button class ="knoplogin" onclick="document.getElementById('id01').style.display='block'">Login</button></li>
                    <li><button class ="knopregister" onclick="document.getElementById('id02').style.display='block'" >Register </button></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById('id01');
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
            return false
        }
    };
    // Get the modal
    var modal2 = document.getElementById('id02');
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === modal2) {
            modal2.style.display = "none";
        }
    }
</script>


</body>
</html>
