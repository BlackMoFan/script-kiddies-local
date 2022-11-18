<?php

if(isset($_POST["submit"])) {
    $user_name = $_POST["uid"];
    $password = $_POST["password"];

    include("../utilities/connection.php");

    require_once 'functions.inc.php';

    if(emptyInputLogin($user_name, $password) !== false) {
        header("Location: ../utilities/login.php?error=emptyinput");
        exit();
    }

    logUser($conn, $user_name, $password);

} else {
    header("Location: ../utilities/login.php");
    exit();
}