<?php
session_start();
require_once "pdo.php";
if (isset($_SESSION['usr']) )
$my_id= $_SESSION['usr_id'];

if (isset($_POST['submit'])){
    $file = $_FILES['file'];

    $FileName = $_FILES['file']['name'];
    $FileTmp = $_FILES['file']['tmp_name'];
    $FileSize = $_FILES['file']['size'];
    $FileError = $_FILES['file']['error'];
    $FileType = $_FILES['file']['type'];

$fileExt = explode('.', $FileName);
$fileExtent = strtolower(end($fileExt));
$allowed = array('jpg','jpeg', 'png');

if (in_array($fileExtent, $allowed)) {
    if($FileError === 0) {
        if($FileSize < 100000000){
            $FileNewName = "profile_pic_$my_id."."$fileExtent";
            $FileDestination = $_SERVER['DOCUMENT_ROOT'].'/wdev_arno/chesssite/img/uploads/'.$FileNewName;
            move_uploaded_file($FileTmp, $FileDestination);

            $sql= "UPDATE wdev_arno.users SET usr_pic = 'profile_pic_$my_id.$fileExtent'
                    WHERE usr_id = '$my_id'";
           ExecuteSQL($sql);
            header("location:../account.php?uploadsuccess");


        }else { header("location:../account.php?uploadtoobig");}

    }else {header("location:../account.php?uploadfiletype");}

}
else { header("location:../account.php?uploadfailed");}

}
?>