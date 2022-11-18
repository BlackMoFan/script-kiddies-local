<?php

    if(isset($_POST["update_student"])) {
        include("../utilities/connection.php");
        include("../utilities/functions.php");

        require_once 'functions.inc.php';

        $user_id = $_POST["user_id"];

        //get user data
        // $user_data = userIdExistence($conn, $user_id)

        $new_full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $new_gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $new_user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $new_birthday = $_POST['birthday'];
        $new_role = mysqli_real_escape_string($conn, $_POST['role']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        $new_employment_status = mysqli_real_escape_string($conn, $_POST['employment_status']);
        $new_email = mysqli_real_escape_string($conn, $_POST['email']);
        $current_password = mysqli_real_escape_string($conn, $_POST['current-password']);
        $new_password = mysqli_real_escape_string($conn, $_POST['password']);
        $new_passwordRepeat = mysqli_real_escape_string($conn, $_POST['passwordRepeat']);
        // $employment_status = "Employed";

        //empty field
        if(emptyInputEdit($new_full_name, $user_id, $new_user_name, $new_role, $new_employment_status, $new_email, $current_password) !== false) {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=emptyinput");
            exit();
        }
        //invalid user name
        if(invalidUid($new_user_name) !== false) {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=invaliduid");
            exit();
        }
        //invalid sex
        if(invalidGender($new_gender) !== false) {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=invalidsex");
            exit();
        }
        //invalid email
        if(invalidEmail($new_email) !== false) {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=invalidemail");
            exit();
        }
        //password dont match
        if(pwdMatch($new_password, $new_passwordRepeat) !== false) {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=passwordsdontmatch");
            exit();
        }
        //username already taken
        // if(userIdExists($conn, $new_user_name, $user_id) !== false) {
        //     header("Location: ./edit-user.inc.php?error=usernametaken");
        //     exit();
        // }
        if(userNameExistence($conn, $new_user_name, $user_id) !== false) {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=usernametaken");
            exit();
        }
        //if invalid salary was entered
        if(invalidSalary($salary) !== false) {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=invalidsalary");
            exit();
        }
        //if employment status is not Employed, On leave, or Resigned
        if(ESValid($new_employment_status) !== false) {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=invalidemploymentstatus");
            exit();
        }

        if(emptyCurrentPassword($current_password) !== false) {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=emptypassword");
            exit();
        }else {
            //if current password entered is not the same in the database
            if(wrongPassword($conn, $user_id, $new_user_name, $current_password) !== false) {
                header("Location: ./edit-user.inc.php?user_id=$user_id&error=wrongpassword");
                exit();
            }
        }


        updateUser($conn, $user_id, $new_full_name, $new_gender, $new_user_name, $new_birthday, $new_role, $salary, $new_employment_status, $new_email, $new_password);
    }
    else {
        header("Location: ./edit-user.inc.php");
        exit();
    }