<?php
    session_start();
    unset($_SESSION['adminID']);
    session_destroy();
    header("location:admin-login.php");
?>