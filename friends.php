<?php
$login_form = true;
require_once "lib/autoload.php";
if (isset($_SESSION['usr']) )
    $my_id= $_SESSION['usr_id'];
    $formname = $_POST["formname"];
    $myname = $_SESSION['usr_username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="vieuwport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie-edge">
    <link rel="stylesheet" href="css/opmaak.css">
    <link rel="stylesheet" href="css/home.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <title>You've got a friend in me</title>
</head>
<body class="friendsbody">
<header class="friendsheader">

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

<div class="friendskolom">

<main class="friendsmain">
    <?php
    echo "<div class='friendstest'>";
    FriendLoadImage ($my_id, 'friendsimg');
    echo "<h1>Hello, $myname </h1>";
    echo "</div>"

    ?>
    <!-- display current friends______________________________________________________________-->
    <h2 class="friendsh2"> All your friends</h2>
    <section>

            <?php
            if(isset($_GET["unfriendfailed"])){
                echo '<p> </p>';
            }
            LoadFriends($my_id,1,'Unfriend');

            ?>

        </section>

            

</main>

<aside class="friendsaside">
    <!--Searchfriends_____________________________________________________________________-->
    <h2 class="friendsh2">  Search </h2>
    <form id="searchfriends" method="post" action="friends.php" class="friendsform">

        <input type="hidden" id="formname" name="formname" value="searchfriends">
        <div>
            <label for="input_friend">Search friends</label>
            <input type="text" id="input_friend" name="input_friend" value="">
        </div>
        <?php
        if(isset($_GET["requestsent"])){
            echo '<p> </p>';
        }
        if(isset($_GET["requestfailed"])){
            echo '<p> </p>';
        }
        ?>
        <button name="searchbutton" id="searchfriends" value="searchfriends">Search</button>

    </form>
    <!--//___________SEARCHFRIENDPHP______________________________________________________________________________________________________-->
    <?php if ($formname == "searchfriends" AND $_POST['searchbutton'] == "searchfriends")


        if (empty($_POST['input_friend']))
        { echo "no input! please enter a name";}
        else{
            $input = $_POST['input_friend'];

            $sql = " select usr_id,usr_username from wdev_arno.users
                            
                            WHERE usr_username like '%" . htmlentities($_POST['input_friend'], ENT_QUOTES) . "%' 
                            AND usr_id NOT IN 
                            (SELECT userone from wdev_arno.friends where usertwo = $my_id
                            UNION
                            SELECT usertwo from wdev_arno.friends WHERE userone = $my_id)
                            GROUP BY usr_id, usr_username";

            $sqlexec = GetData($sql);
            { foreach ($sqlexec as $friend)

            {echo " <div class='friendsdiv'> 
                        
                        <form id=\"addfriend\" method=\"post\" action=\"lib/FriendAccept.php\" class='friendsform'>
                        <input type=\"hidden\" id=\"formname\" name=\"formname\" value=\"addfriend\">";
                FriendLoadImage($friend['usr_id'], 'friendsimg');
                echo "
                        $friend[usr_id], $friend[usr_username]
                        <input type='hidden' value='addfriend' name='buttonid' id='buttonid'>
                        <input type='hidden' value='$friend[usr_id]' name='friendID' id='friendID'>
                        <button name='addfriend'>Add</button></form>
                        
                        <form method='post' action='account.php' class='checkform'> 
                        <input type='hidden' id='formname' name='formname' value='checkaccount'>
                        <input type='hidden' value='$friend[usr_id]' name='friendID' id='friendID'>
                        <button type='submit' name='checkaccount' class='checkaccount'> Check!</button>
                        </form></div>";
            }
            }}
    ?>

    <div>
    <!-- display friendrequests_________________________________________________________________________________________________________________-->
    <h2 class="friendsh2">  Friendrequests </h2>
    <div>


            <?php
            if(isset($_GET["acceptfailed"])){
                echo '<p>  </p>';
            }
            LoadRequests($my_id,0,'Accept request');
            ?>
    </div>
</aside>
</div>



</body>
</html>


