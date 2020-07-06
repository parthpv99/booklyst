<?php
    session_start();
    unset($_SESSION);
    header('Location: login.php');
    session_destroy();
    session_write_close();
    exit;
?>