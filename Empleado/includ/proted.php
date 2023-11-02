<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['authentication']) && $_SESSION['authentication'] === true) {
    
    if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] === true) {

        if (isset($_SESSION['cont']) && $_SESSION['cont'] === true) {
            unset($_SESSION['cont']);
            header("location: ../index.php");
        }



    } else {
        if (isset($_SESSION['cont']) && $_SESSION['cont'] === false) {
            unset($_SESSION['cont']);
            header("location: ../index.php");
        }
        
    }
} else {
    header("location: ../userLogin.php"); 
}
