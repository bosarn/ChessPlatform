<?php

$login_form = true;
require_once "autoload.php";
$formname = $_POST["formname"];
$buttonvalue = $_POST['loginbutton'];

if ( $formname == "login_form" AND $buttonvalue == "login")

{
    if ( ControleLoginWachtwoord( $_POST['usr_email'], $_POST['usr_pasw'] ) )
    {
        header("Location: ../home.php");
    }
    else
    {
        header("Location:../index.php?loginfailed");

    }
}
else
{

    header("Location:../index.php?formfailed");
}
