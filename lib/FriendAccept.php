<?php
session_start();
require_once "functions.php";
require_once "pdo.php";

$formname = $_POST["formname"];
$buttonID = $_POST["buttonid"];
$friendID = $_POST["friendID"];
$ID_self = $_SESSION["usr_id"];


//_____________ACCEPTFRIEND____________________________________________________________________________________________________________________
if ($formname == "accept" AND $buttonID == "Accept request")
{
    SetStatus($friendID,$ID_self,1);
    header("location: ../friends.php");}
else
    header("location: ../friends.php?acceptfailed");


//______________ADDFRIEND__________________________________________________________________________________________________________________
if ($formname == "addfriend" AND $buttonID == "addfriend")
{
    $sql ="INSERT INTO wdev_arno.friends (userone,usertwo,status )
            VALUES ($ID_self, $friendID, 0)";
    ExecuteSQL($sql);
    header("location: ../friends.php?requestsent");}
else
    header("location: ../friends.php?requestfailed");

//____________UNFRIEND____________________________________________________________________________________________________________________
if ($formname == "unfriend" AND $buttonID == "Unfriend"){

$sql="DELETE FROM wdev_arno.friends WHERE userone = $ID_self AND usertwo = $friendID";
ExecuteSQL($sql);
$sql="DELETE FROM wdev_arno.friends WHERE usertwo = $ID_self AND userone = $friendID";
ExecuteSQL($sql);}
else{
    header("location: ../friends.php?unfriendfailed");

}