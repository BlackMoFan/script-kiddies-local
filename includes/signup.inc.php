<?php

    if(isset($_POST["submit"])) {
        include("../utilities/connection.php");
        include("../utilities/functions.php");

        require_once './functions.inc.php';

        $user_id = random_num(20);
        $full_name = $_POST['full_name'];
        $gender = $_POST['gender'];
        $user_name = $_POST['user_name'];
        $birthday = $_POST['birthday'];
        // $birthyear = substr($birthday, 0, 4);
        // $birthmonth = substr($birthday, 5, 2);
        // $birth_day = substr($birthday, 8, 2);
        // $birthday = $birthyear . '-' . $birthmonth . '-' . $birth_day;
        // var_dump($birthday);
        // die;
        $default_role = $_POST['role'];
        //if user name is "Admin" then the role is Administrator
        if($user_name === "Admin"){
            $default_role = "Administrator";
        }
        $salary = $_POST['salary'];
        $employment_status = $_POST['employment_status'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['passwordRepeat'];
        // $employment_status = "Employed";

        //empty field
        if(emptyInputSignup($full_name, $user_name, $default_role, $employment_status, $email, $password, $passwordRepeat) !== false) {
            header("Location: ../utilities/signup.php?error=emptyinput");
            exit();
        }
        //invalid user name
        if(invalidUid($user_name) !== false) {
            header("Location: ../utilities/signup.php?error=invaliduid");
            exit();
        }
        //invalid birthday format
        if(invalidBirthday($birthday) !== false) {
            header("Location: ../utilities/signup.php?error=invalidbirthday");
            exit();
        }
        //invalid gender
        if(invalidGender($gender) !== false) {
            header("Location: ../utilities/signup.php?error=invalidsex");
            exit();
        }
        //invalid email
        if(invalidEmail($email) !== false) {
            header("Location: ../utilities/signup.php?error=invalidemail");
            exit();
        }
        //password dont match
        if(pwdMatch($password, $passwordRepeat) !== false) {
            header("Location: ../utilities/signup.php?error=passwordsdontmatch");
            exit();
        }
        //username already taken
        if(uidExists($conn, $user_name, $email) !== false) {
            header("Location: ../utilities/signup.php?error=usernametaken");
            exit();
        }

        if(ESValid($employment_status) !== false) {
            header("Location: ../utilities/signup.php?error=invalidemploymentstatus");
            exit();
        }

        if(invalidSalary($salary) !== false) {
            header("Location: ../utilities/signup.php?error=invalidsalary");
            exit();
        }

        createUser($conn, $user_id, $full_name, $gender, $user_name, $birthday, $default_role, $salary, $email, $password, $employment_status);
    }
    else {
        header("Location: ../utilities/signup.php");
        exit();
    }