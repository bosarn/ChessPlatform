<?php
require_once "autoload.php";
if (isset($_SESSION['usr']) )
    $my_id= $_SESSION['usr_id'];


if (isset($_POST['submit'])){
    $mail = $_POST['email'];
    $name = $_POST['name'];
    $text = $_POST['message'];

    $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
    $name = filter_var($name, FILTER_SANITIZE_STRING );
    $text = filter_var($text, FILTER_SANITIZE_STRING);

    $subject = 'ChessSite E-mail from' . $name;

mail('Mail@address.com', $subject, $text);
header('Location: ../contact.php');
}
?>