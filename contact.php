
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="vieuwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="stylesheet" href="css/opmaak.css">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <title>Chess site - Contact </title>
</head>
<body class="accountbody">
<header class="accountheader">
    <nav id="metanav">
        <a href="home.php" type="logo"><img src="img/logonavw.png" class="logonav" alt=""></a>
        <ul class="metanav">
            <li><a href="home.php" type="" title="" class="">Home</a></li>
            <li><a href="account.php" type="" title="" class="">Account</a></li>
            <li><a href="friends.php" type="" title="" class="actiefitemmeta">Friends</a></li>
            <li><a href="contact.php" type="" title="">Contact</a></li>
            <li><a href="lib/logout.php" type="" title="" class="logout">Logout</a></li>
        </ul>
    </nav>

</header>

<main>
    <section class="formsection">

            <form action="lib/contact.php" id="contactform" method="post">
                <h3 class="formh3">Contact us!</h3>

                <input type="text" id="fname" name="name" placeholder="Your name..">
                <input type="email" id="email" name="email" placeholder="E-mail">
                <textarea id="message" name="message" placeholder="Text..."></textarea>
                <input type="submit" name="submit" value="Send" class="formbutton">
            </form>

    </section>

</main>

</body>
</html>
