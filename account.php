<?php
$login_form = true;
require_once "lib/autoload.php";
if (isset($_SESSION['usr']) )
    $guestid= $_SESSION['usr_id'];
    $myid = $_SESSION['usr_id'];
    $myname = $_SESSION['usr_username'];

$requestID = $_POST['friendID'];
$formname= $_POST['formname'];
if (isset($_POST['checkaccount'])){
    $guestid=$requestID;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="vieuwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="stylesheet" href="css/opmaak.css">
    <link rel="stylesheet" href="css/home.css"
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <title> Chessplatform - Account</title>
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

<main class="accountmain">
    <section class="accountsection">
    <div class="accountimgholder">
<?php
 $sql = "SELECT usr_pic from wdev_arno.users Where usr_id = '$guestid'";

$image = GetData($sql);
$imagename = array_column($image, 'usr_pic');
$UserProfielPicture = '/wdev_arno/chesssite/img/uploads/'.$imagename[0];

echo "<img src='$UserProfielPicture' class='accountimg' alt=''>";
if(isset($_GET['uploadsuccess']))
{
    echo '<p> Upload Succesfull!</p>';
}

if(isset($_GET['uploadfailed']))
{
    echo '<p> Upload failed!</p>';
}
if(isset($_GET['uploadtoobig']))
{
    echo '<p> file too big!</p>';
}
if(isset($_GET['uploadfiletype']))
{
    echo '<p> File Type incorrect!</p>';
}
        if (isset($_POST['checkaccount'])){
            LoadFriend($myid,$guestid);
            LoadRequest($myid,$guestid);
            RequestSent ($myid,$guestid);
            LoadAdd($myid,$guestid);
        }


        else {



            echo '  <form action="lib/upload.php" method="POST" enctype="multipart/form-data" class="accountform">
                    <input type="file" name="file">
                    <button type="submit" name="submit" class="accountbutton"> Change Profile Picture</button>
                    </form>';


                }
        ?>
    </div>
    <table class="accountlist">
        <tr>
            <td>
                Name:
            </td>
            <td>
                <?php LoadRealName($guestid);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Username:
            </td>
            <td>

                <?php  LoadName($guestid);
                ?>
            </td>
        </tr>
        <tr>
            <td>
                E-mail:
            </td>
            <td>
                <?php  LoadEmail($guestid); ?>

            </td>
        </tr>
    </table>

        <?php

        if (isset($_POST['checkaccount']))
            echo "";


            else

        echo '  <form action="lib/delete.php" method="POST" class="accountformdelete">


            <label for="delete">
                <input type="text" name="deleteaccount" placeholder="Type delete to delete your account!">
            </label>
            <button type="submit" name="delete" class = "accountbuttondelete"> Delete Account !</button>
        </form>  '

        ?>





    </section>
    <aside class="accountaside">
        <?php echo "<h1 class='accounth1'>Account:";
        LoadName($guestid);
        echo "</h1>";
        ?>

        <h2 class="friendsh2"> Game history</h2>
        <?php
        echo"<p>Games played:"; LoadGamesPlayed($guestid);echo"</p>";
        echo"<p>Games won:";LoadGameswon($guestid);echo"</p>";
        echo"<p>Games lost:"; LoadGamesLost($guestid);echo"</p>";
        echo"<p>Games drawn:"; LoadGamesDrawn($guestid);echo"</p>";
        echo"<p>Games played as white:"; LoadGamesPlayedAsWhite($guestid);echo"</p>";
        echo"<p>Games played as black:"; LoadGamesPlayedAsBlack($guestid);echo"</p>";

?>
        <h2 class="friendsh2"> Friends</h2>
        <?php echo "<p> Ammount: ";
        $sql = "select count(usr_id) as total from wdev_arno.users
                WHERE usr_id IN
                (SELECT userone from wdev_arno.friends where usertwo = '$guestid' And status = 1
                            UNION
                SELECT usertwo from wdev_arno.friends WHERE userone = '$guestid' and status=1)";
        $data= GetData($sql);
        foreach ($data as $key => $value) {
                foreach($value as $p){
                    echo$p;
                }
        }
        echo "</p>"
        ?>
        <h2 class="friendsh2">Rating </h2>
        <?php
        echo'<p> Current rating: '; LoadRating($guestid);
        echo '</p>';
        ?>
    </aside>
</main>
</body>
</html>