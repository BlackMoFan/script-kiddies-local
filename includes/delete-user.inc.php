<?php
    require_once '../utilities/connection.php';
    require_once './functions.inc.php';

    if(isset($_POST['delete_student'])) {
        $user_id = mysqli_real_escape_string($conn, $_POST['delete_student']);

        //if user id exists, then retrieve data
        $userIdExists = userIdExistence($conn, $user_id);
        $user_id = $userIdExists["user_id"];
        $full_name = $userIdExists["full_name"];
        $birthday = $userIdExists["birthday"];
        $role = $userIdExists["role"];
        $email = $userIdExists["email"];
        $date = $userIdExists["date"];
        // $deleted_date = $userIdExists["update_date"];
        $employment_status = $userIdExists["employment_status"];
        $salary = $userIdExists["salary"];

        $sql = "INSERT INTO deleted_users (user_id, full_name, birthday, role, email, date, employment_status, salary) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../utilities/signup.php?error=stmtfailed");
            exit();
        }

        //hashing the password
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        // $birthday = $birthyear . '-' . $birthmonth . '-' . $birth_day;
        mysqli_stmt_bind_param($stmt, "issssssi", $user_id, $full_name, $birthday, $role, $email, $date, $employment_status, $salary);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // header("Location: ../utilities/signup.php?error=none");
        // exit();

        $query = "DELETE FROM users WHERE user_id='$user_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            session_start();
            $_SESSION["fullnameDeleted"] = $userIdExists["full_name"];
            if($_SESSION["file_name"] === "index") {
                header("Location: ../index.php?error=none");
            } else if($_SESSION["file_name"] === "employees") {
                header("Location: ../components/employees.php?error=none");
            }
            // header("Location: ../index.php?error=none");
            exit();
        } else {
            if($_SESSION["file_name"] === "index") {
                header("Location: ../index.php?error=somethingwrong");
            } else if($_SESSION["file_name"] === "employees") {
                header("Location: ../components/employees.php?error=somethingwrong");
            }
            // header("Location: ../index.php?error=somethingwrong");
            exit();
        }
    }