<?php

session_start();
require_once "autoload.php";
if (isset($_SESSION['usr']))
    $my_id = $_SESSION['usr_id'];

if (isset($_POST['delete'])){
    $input = $_POST['deleteaccount'];
    if ($input == 'delete') {
        $sql = "DELETE  FROM wdev_arno.users WHERE usr_id = $my_id ";
        ExecuteSQL($sql);
        session_start();
        session_destroy();
        unset($_SESSION);

        session_start();
        session_regenerate_id();

        header("Location: ../index.php");

    }

}