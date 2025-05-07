<?php
    session_name("session_delivered");
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
?>
