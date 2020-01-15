<?php
function LoadName ($ID){
  $sql= "select usr_username from wdev_arno.users
              WHERE usr_id = $ID";
        $data= GetData($sql);
        foreach ($data as $key => $value) {
            foreach($value as $p){
                echo$p;
            }
        }}

function LoadRating ($ID){
        $sql= "select usr_rating from wdev_arno.users
              WHERE usr_id = $ID";
        $data= GetData($sql);
        foreach ($data as $key => $value) {
            foreach($value as $p){
                echo$p;
            }
        }}
function LoadEmail ($ID){
    $sql= "select usr_email from wdev_arno.users
              WHERE usr_id = $ID";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $p){
            echo$p;
        }
    }}
function LoadRealName ($ID){
    $sql= "select usr_name from wdev_arno.users
              WHERE usr_id = $ID";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $p){
            echo$p;
        }
    }}

function  LoadGamesPlayed($ID){
    $sql= "select count(gam_id) from wdev_arno.game
              WHERE gam_usr_black_id = $ID OR gam_usr_white_id = $ID";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $p){
            echo$p;
        }
    }}
function  LoadGamesPlayedAsWhite ($ID){
    $sql= "select count(gam_id) from wdev_arno.game
              WHERE  gam_usr_white_id = $ID";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $p){
            echo$p;
        }
    }}
function  LoadGamesPlayedAsBlack ($ID){
    $sql= "select count(gam_id) from wdev_arno.game
              WHERE  gam_usr_black_id = $ID";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $p){
            echo$p;
        }
    }}
function  LoadGamesDrawn($ID){
    $sql= "select count(gam_id) from wdev_arno.game
              WHERE gam_winner = 'draw' AND gam_usr_black_id = $ID OR gam_usr_white_id = $ID AND gam_winner = 'draw'";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $p){
            echo$p;
        }
    }}
function  LoadGameswon($ID){
    $sql=
    "select count(gam_id)   from wdev_arno.game
    WHERE gam_usr_black_id = $ID AND gam_winner = 'black'
    OR gam_usr_white_id = $ID AND gam_winner = 'white'";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $p){
            echo$p;
        }
    }}
function  LoadGamesLost($ID){
    $sql=
        "select count(gam_id)   from wdev_arno.game
    WHERE gam_usr_black_id = $ID AND gam_winner = 'white'
    OR gam_usr_white_id = $ID AND gam_winner = 'black'";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $p){
            echo$p;
        }
    }}
function FriendLoadImage ($IDself,$class)
{
    $sql = "SELECT usr_pic from wdev_arno.users Where usr_id = '$IDself'";

    $image = GetData($sql);
    $imagename = array_column($image, 'usr_pic');
    $UserProfielPicture = '/wdev_arno/chesssite/img/uploads/'.$imagename[0];

    echo "<img src='$UserProfielPicture' class='$class' alt=''>";
}

function LoadFriend ($IDself, $IDfriend) {
    $sql =
        "Select usr_id from users
left join friends on usr_id = userone
where usertwo = $IDfriend and userone = $IDself and status =1
UNION
Select usr_id from users
    left join friends on usr_id = usertwo
where userone = $IDfriend and usertwo = $IDself and status =1
group by usr_id";
    $data = GetData($sql);

    foreach ($data as $row) {
        $key = (array_values($row));

        echo '
                   <form id="unfriend" method="post" action="lib/FriendAccept.php" class="accountform">
                   <input type="hidden" id="formname" name="formname" value="unfriend">
                   <input type="hidden" value="Unfriend" name="buttonid" id="buttonid">';
        echo "
                       <input type=\"hidden\" value='$key[0]' name=\"friendID\" id=\"friendID\">
                    <button class='accountbutton' name=\"Unfriend\">Unfriend</button>
                   </form>";
}}

// Plakt friends in venster samen met een knop volgens status (friend,none,request sent, ...)
function LoadFriends($IDself,$status,$buttonstatus)
{
    $sql = "SELECT usr_id,usr_username  
FROM `wdev_arno`.friends AS F ,`users` AS U
WHERE CASE
    WHEN F.UserOne = $IDself
    THEN F.UserTwo = U.usr_id
    WHEN F.UserTwo =$IDself
    THEN F.UserOne = U.usr_id END
    AND F.status = $status
 group by usr_id";
    $data = GetData($sql);

    foreach ($data as $row) {
        $key = (array_values($row));


        echo "<div class='friendsdiv'>
        <form class='friendsform' id=\"unfriend\" method=\"post\" action=\"lib/FriendAccept.php\">
        <input type=\"hidden\" id=\"formname\" name=\"formname\" value=\"unfriend\">";
        FriendLoadImage($key[0], 'friendsimg');
        echo "
        
        <label for='$buttonstatus'>$key[1]</label>
        <input type='hidden' value='$buttonstatus' name='buttonid' id='buttonid'>
        <input type='hidden' value='$key[0]' name='friendID' id='friendID'>
        <button name='$buttonstatus'>$buttonstatus</button>
        </form>
        
        <form method='post' action='account.php' class='checkform'> 
        <input type='hidden' id='formname' name='formname' value='checkaccount'>
        <input type='hidden' value='$key[0]' name='friendID' id='friendID'>
        <button type='submit' name='checkaccount' class='checkaccount'> Check profile</button>
        </form>
        </div>";
    }
}
// REQUEST BUTTON
function LoadRequest ($IDself, $IDfriend){
    $sql = "select usr_id, usr_username from users
            left join friends on usr_id = userone
            where userone = $IDfriend And usertwo = $IDself And status = 0";

    $data = GetData($sql);

    foreach ($data as $row) {
        $key = (array_values($row));
        echo '
                   <form id="accept" method="post" action="lib/FriendAccept.php" class="accountform">
                   <input type="hidden" id="formname" name="formname" value="accept">
                   <input type="hidden" value="Accept request" name="buttonid" id="buttonid">';
        echo "
                       <input type=\"hidden\" value='$key[0]' name=\"friendID\" id=\"friendID\">
                    <button class='accountbutton' name=\"accept\">Accept request</button>
                   </form>";
}}
function RequestSent ($IDself, $IDfriend){
    $sql = "select usr_id, usr_username from users
            left join friends on usr_id = userone
            where userone = $IDself And usertwo = $IDfriend And status = 0";

    $data = GetData($sql);

    foreach ($data as $row) {
        $key = (array_values($row));
        echo '<button name="">Already sent</button>';
    }}
function LoadRequests($IDself,$status,$buttonstatus)
{
    $sql = "SELECT usr_id,usr_username  
FROM `wdev_arno`.friends AS F ,`users` AS U
WHERE 
CASE
    WHEN F.UserTwo =$IDself
    THEN F.UserOne = U.usr_id END
    AND F.status = $status
 group by usr_id";
    $data = GetData($sql);

    foreach ($data as $row) {
        $key = (array_values($row));

        echo "<div class='friendsdiv'>
        <form class='friendsform ' id=\"accept\" method=\"post\" action=\"lib/FriendAccept.php\" >
        <input type=\"hidden\" id=\"formname\" name=\"formname\" value=\"accept\" '>";
        FriendLoadImage($key[0], 'friendsimg');
        echo "
        <label for='$buttonstatus'>$key[1]</label>
        <input type='hidden' value='$buttonstatus' name='buttonid' id='buttonid'>
        <input type='hidden' value='$key[0]' name='friendID' id='friendID'>
        <button name='$buttonstatus'>$buttonstatus</button> 
        </form>
        <form method='post' action='account.php' class='checkform'> 
        <input type='hidden' id='formname' name='formname' value='checkaccount'>
        <input type='hidden' value='$key[0]' name='friendID' id='friendID'>
        <button type='submit' name='checkaccount' class='checkaccount'> Check profile</button>
        </form>
        </div>";

    }
}
function LoadAdd($IDself,$IDfriend){

    $sql = "select userone,usertwo from friends
            Where usertwo=$IDself AND userone=$IDfriend
            OR userone=$IDself AND usertwo = $IDfriend";
        $data = GetData($sql);
        $countdata =count($data);

        if ($countdata == 1) {

        }
        else {
                echo '
                   <form id="addfriend" method="post" action="lib/FriendAccept.php" class="accountform">
                   <input type="hidden" id="formname" name="formname" value="addfriend">
                   <input type="hidden" value="addfriend" name="buttonid" id="buttonid">';
                echo "
                       <input type=\"hidden\" value='$IDfriend' name=\"friendID\" id=\"friendID\">
                    <button class='accountbutton' name=\"addfriend\">Add</button>
                   </form>";}



}

function SetStatus ($ID1,$ID2,$Status){
    $sql ="UPDATE wdev_arno.friends SET status = '$Status' 
            WHERE wdev_arno.friends.userone='$ID1' AND friends.usertwo = '$ID2'";
    ExecuteSQL($sql);

}
