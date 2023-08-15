<?php
    include_once("../config/Config.php");

    session_start();
    if (isset($_SESSION['sess_username'])) {
        session_destroy();
        header("Location:  ".ROOT."index.php");
    } else {
        header("Location:  ".ROOT."index.php?mensaje=0");
    }
?>