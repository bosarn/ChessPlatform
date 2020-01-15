<?php
function ControleLoginWachtwoord( $login, $paswd )
{
    $sql = "SELECT * FROM wdev_arno.users WHERE wdev_arno.users.usr_email='" . $login . "' ";
    $data = GetData($sql);

    if ( count($data) == 1 )
    {
        $row = $data[0];
        //password controleren
        if ( password_verify( $paswd, $row['usr_pasw'] ) ) $login_ok = true;
    }

    if ( $login_ok )
    {
        session_start();
        $_SESSION['usr'] = $row;
        $_SESSION['usr_id'] = $row['usr_id'];
        $_SESSION['usr_username']= $row['usr_username'];
        $_SESSION['usr_email']= $row['usr_email'];
        $_SESSION['usr_name']= $row['usr_name'];


        return true;
    }

    return false;
}
?>
