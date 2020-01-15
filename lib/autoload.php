<?php
session_start();
$_SESSION["head_printed"] = false;

require_once "passwd.php";                      // Om psw niet te uploaden naar git
require_once "pdo.php";                          //database functies
require_once "functions.php";      //basic_head, load_template, replacecontent...
require_once "authorisation.php";      //controle login e.d.


