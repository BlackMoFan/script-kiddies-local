<?php

    // THIS IS AN EXPERIMENT
    // CREATE A TABLE IN DATABASE USING PHP AND INSERT AN ADMIN ACCOUNT AUTOMATICALLY IF THERE IS NONE

    require_once './connection.php';

    //create sql query
    $sql = "CREATE TABLE IF NOT EXISTS `login_sample_db`.`users` ( 
        `id` BIGINT(20) NOT NULL AUTO_INCREMENT , 
        `user_id` BIGINT(20) NOT NULL , 
        `full_name` VARCHAR(100) NOT NULL , 
        `gender` VARCHAR(50) NOT NULL , 
        `user_name` VARCHAR(100) NOT NULL , 
        `role` VARCHAR(100) NOT NULL , 
        `email` VARCHAR(100) NOT NULL , 
        `password` VARCHAR(100) NOT NULL , 
        `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
        `employment_status` VARCHAR(100) NOT NULL , 
        PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    //declare php statement for secure storing of user data
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./login.php?error=tablecreationfailed");
        exit();
    }
    //bind the variables to the statement
    // mysqli_stmt_bind_param($stmt, "s", "Admin");
    mysqli_stmt_execute($stmt);

    // $resultData = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);

    // //CREATE ADMIN USER
    // require_once './includes/functions.inc.php';
    // require_once './functions.php';

    // //empty field
    // $user_name = "Admin";

    // if(adminExists($conn, $user_name) !== false) {
    //     // header("Location: ./login.php?error=adminAccountIsMissing");
    //     // exit();
    //     $user_id = random_num(20);
    //     $full_name = "The Administrator";
    //     $gender = "Male";
    //     // $user_name = $admin_name;
    //     $default_role = "Administrator";
    //     $email = "admin@gmail.com";
    //     $password = "root";
    //     $employment_status = "Employed";

    //     // createUser($conn, $user_id, $full_name, $gender, $user_name, $default_role, $email, $password, $employment_status);
    //     // $sql = "INSERT INTO users (user_id, full_name, gender, user_name, role, email, password, employment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    //     $sql = "INSERT INTO `users` (
    //         `id`, `user_id`, `full_name`, `gender`, `user_name`, `role`, `email`, `password`, `date`, `employment_status`) 
    //         VALUES 
    //         (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    //     $stmt = mysqli_stmt_init($conn);
    //     if(!mysqli_stmt_prepare($stmt, $sql)) {
    //         header("Location: ./login.php?error=tableinsertionfailed");
    //         exit();
    //     }

    //     //hashing the password
    //     $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    //     mysqli_stmt_bind_param($stmt, "iissssssss", '1', $user_id, $full_name, $gender, $user_name, $default_role, $email, $hashedPwd, current_timestamp(), $employment_status);
    //     mysqli_stmt_execute($stmt);
    //     mysqli_stmt_close($stmt);

    //     // header("Location: ./login.php?error=none");
    //     // exit();
    // }