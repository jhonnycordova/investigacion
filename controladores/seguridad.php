<?php
error_reporting(0);
session_start();

if($_SESSION["autentificado"] != "yes") {
    header("Location: /investigacion/login/");
    exit();
}

?>
