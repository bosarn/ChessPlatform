<?php

require_once "autoload.php";

$my_id = $_SESSION['usr_id'];
$my_usrname = $_SESSION['usr_username'];
$game = $_POST['game'];
$match = $_POST['match'];

if ($game == $my_id AND $match == 'Quick Play') {


// Find flag in users

    $match = "select usr_id from wdev_arno.users where usr_id <> '$my_id' AND usr_flag = 1 limit 1 ";
    $data = GetData($match);
// False =>  insert into game usr_id and status 1 set usr_flag = 1

    if(empty($data)){
        $sql = "INSERT INTO wdev_arno.game (gam_usr_black_id,gam_status) VALUES ($my_id,1) ";
        ExecuteSQL($sql);
        $sql = "update wdev_arno.users set usr_flag = 1 WHERE usr_id = '$my_id'";
        ExecuteSQL($sql);
        $sql = "SELECT gam_id from wdev_arno.game WHERE gam_usr_black_id='$my_id' AND gam_status =1 ";
        $data = GetData($sql);
        foreach ($data as $val) {
            foreach ($val as $key) {
                }}
                $_SESSION['GameID'] = $key;
                $_SESSION['IDblack'] = $my_id;
                unset ($_SESSION['IDwhite']);
                header('Location: ../game.php');

    }
// true => Join game: find usr_id where flag 1, update game with own usr_id set status 0 set flag other player 0 --

    else {
        foreach ($data as $value) {
            $opponentid = $value['usr_id'];
            $sql = "SELECT gam_id from wdev_arno.game WHERE gam_usr_black_id='$opponentid'  AND gam_status =1 ";
            $data = GetData($sql);
            foreach ($data as $val) {
                foreach ($val as $key) {
                    $sql ="UPDATE wdev_arno.game set gam_usr_white_id = $my_id, gam_status = 0 WHERE gam_id = $key";
                    ExecuteSQL($sql);
                    $sql = "update wdev_arno.users set usr_flag = 0 WHERE usr_id = '$opponentid'";
                    ExecuteSQL($sql);
                    $_SESSION['GameID'] = $key;
                    $_SESSION['IDblack'] = $opponentid;
                    $_SESSION['IDwhite'] = $my_id;
                    header('Location: ../game.php');
                }
            }
        }
    }





    }
else {
    echo "return home please";
}