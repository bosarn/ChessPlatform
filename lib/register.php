<?php
$register_form = true;
require_once "autoload.php";

$formname = $_POST["formname"];
$tablename = $_POST["tablename"];
$pkey = $_POST["pkey"];
$pic = "profile_pic_0.jpg"; // Geeft de user een standaard profielfoto
$rating = '1500'; // standaard rating
if ( $formname == "registration_form" AND $_POST['registerbutton'] == "Register" )
{
    //controle of gebruiker al bestaat
    $sql = "SELECT * FROM wdev_arno.users WHERE usr_email='" . $_POST['usr_email']."'";
    $data = GetData($sql);


    if ( count($data) > 0 ) header("Location:../index.php?registerfailed");



    //wachtwoord coderen
    $password_encrypted = password_hash ( $_POST["usr_pasw"] , PASSWORD_DEFAULT );

    $sql = "INSERT INTO $tablename SET " .
        " wdev_arno.users.usr_name='" . htmlentities($_POST['usr_name'], ENT_QUOTES) . "' , " .
        " wdev_arno.users.usr_username='" . htmlentities($_POST['usr_username'], ENT_QUOTES) . "' , " .
        " wdev_arno.users.usr_email='" . $_POST['usr_email'] . "' , " .
        " wdev_arno.users.usr_pasw='" . $password_encrypted . "'  ," .
        " wdev_arno.users.usr_pic='" . $pic . "'  ,".
        "wdev_arno.users.usr_rating ='" . $rating . "';";

    if ( ExecuteSQL($sql) )
    {
                    header("Location:../index.php");

    }
    else
    {
        header("Location:../index.php?registerfailed");
    }
}
?>