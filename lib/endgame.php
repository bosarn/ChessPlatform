<?php
require_once "autoload.php";

$my_id = $_SESSION['usr_id'];
$my_usrname = $_SESSION['usr_username'];

$gameID = $_POST['gameID'];
$IDwhite = $_POST['IDwhite'];
$IDblack = $_POST['IDwhite'];
$pgn = $_POST['pgn'];

if (isset($_POST['submit'])){
    $sql= "UPDATE wdev_arno.game SET gam_position = '$pgn' WHERE gam_usr_white_id = '$IDwhite' AND gam_usr_black_id='$IDblack' ";
    ExecuteSQL($sql);
    header('Location: ../home.php');

}


// if last 2 digits of position 1-0 white = win
//update DB gam_winner white

// if last 2 digits of position 0-1 black = win
//update DB gam_winner black

// if last 2 digits of position 1/2-1/2 none = win
//update DB gam_winner none

// else
// Game ended early




if (isset($_POST['black'])){
    $sql= "UPDATE wdev_arno.game SET gam_winner = 'black' WHERE gam_status = 1 And gam_usr_white_id = '$IDwhite' AND gam_usr_black_id='$IDblack' ";
    ExecuteSQL($sql);

    $sql= "select usr_rating from wdev_arno.users
              WHERE usr_id = $IDblack";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $rating) {
            $newrating = $rating + 20 ;
        }}

    $sql = "UPDATE wdev_arno.users SET usr_rating = '$newrating' WHERE usr_id = '$IDblack' ";
    ExecuteSQL($sql);

    $sql= "select usr_rating from wdev_arno.users
              WHERE usr_id = $IDwhite";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $rating) {
            $newrating = $rating - 20 ;
        }}

    $sql = "UPDATE wdev_arno.users SET usr_rating = '$newrating' WHERE usr_id = '$IDwhite' ";
    ExecuteSQL($sql);

    header('Location: ../home.php');

}


if (isset($_POST['white'])){
    $sql= "UPDATE wdev_arno.game SET gam_winner = 'white' WHERE gam_status=1 AND gam_usr_white_id = '$IDwhite' AND gam_usr_black_id='$IDblack' ";
    ExecuteSQL($sql);

    $sql= "select usr_rating from wdev_arno.users
              WHERE usr_id = $IDblack";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $rating) {
            $newrating = $rating - 20 ;
        }}

    $sql = "UPDATE wdev_arno.users SET usr_rating = '$newrating' WHERE usr_id = '$IDblack' ";
    ExecuteSQL($sql);

    $sql= "select usr_rating from wdev_arno.users
              WHERE usr_id = $IDwhite";
    $data= GetData($sql);
    foreach ($data as $key => $value) {
        foreach($value as $rating) {
            $newrating = $rating + 20 ;
        }}

    $sql = "UPDATE wdev_arno.users SET usr_rating = '$newrating' WHERE usr_id = '$IDwhite' ";
    ExecuteSQL($sql);

    header('Location: ../home.php');

}