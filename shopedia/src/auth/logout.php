<?php
    // Clearing the session variables
    session_start();
    session_destroy();
    $_SESSION = [];
    header("Location: login.php");
?>