<?php

//check if any field is empty
function emptyInputSignup($full_name, $user_name, $default_role, $employment_status, $email, $password, $passwordRepeat) {
    $result;
    if(empty($full_name) || empty($user_name) || empty($default_role) || empty($employment_status) || empty($email) || empty($password) || empty($passwordRepeat)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

//check if the username entered is not following the required format
function invalidUid($user_name) {
    $result;
    //built-in function preg_match to match a pattern
    if(!preg_match("/^[a-zA-Z0-9]*$/", $user_name)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

//check if sex input is not valid
function invalidGender($gender) {
    $result;
    if($gender === "Male" || $gender === "Female") {
        $result = false;
    }else {
        $result = true;
    }
    return $result;
}

//check if the input is not an email
function invalidEmail($email) {
    $result;
    //built-in function to check if email is valid
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

//check if password and password repeat are not a match
function pwdMatch($password, $passwordRepeat) {
    $result;
    if($password !== $passwordRepeat) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

//check if the username already exists in the db
function uidExists($conn, $user_name, $email) {
    //create sql query
    $sql = "SELECT * FROM users WHERE user_name = ? OR email = ?;";
    //declare php statement for secure storing of user data
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../utilities/signup.php?error=stmtfailed");
        exit();
    }
    //bind the variables to the statement
    mysqli_stmt_bind_param($stmt, "ss", $user_name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//check if employment_status is valid
function ESValid($employment_status) {
    $result;
    if($employment_status === "Employed" || $employment_status === "On leave" || $employment_status === "Resigned") {
        $result = false;
    } else {
        $result = true;
    }
    return $result;
}

//check if salary is valid
function invalidSalary($salary) {
    $result;
    if(!is_float($salary)){
        $result = false;
    }else {
        $result = true;
    }
    return $result;
}

//insert the user data to the database if no error occurred.
function createUser($conn, $user_id, $full_name, $gender, $user_name, $birthday, $default_role, $salary, $email, $password, $employment_status) {
    $sql = "INSERT INTO users (user_id, full_name, gender, user_name, birthday, role, email, password, date, employment_status, salary) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../utilities/signup.php?error=stmtfailed");
        exit();
    }

    //hashing the password
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    // $birthday = $birthyear . '-' . $birthmonth . '-' . $birth_day;
    mysqli_stmt_bind_param($stmt, "issssssssi", $user_id, $full_name, $gender, $user_name, $birthday, $default_role, $email, $hashedPwd, $employment_status, $salary);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: ../utilities/signup.php?error=none");
    exit();
}

function emptyInputLogin($user_name, $password) {
    $result;
    if(empty($user_name) || empty($password)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function logUser($conn, $username, $password) {
    $uidExists = uidExists($conn, $username, $username);

    // if username or email does not exist
    if($uidExists === false) {
        header("Location: ../utilities/login.php?error=wronglogin");
        exit();
    }

    //check hashed password
    $pwdHashed = $uidExists["password"];
    //unhash the hashed password
    $checkPwd = password_verify($password, $pwdHashed);

    // if not match
    if($checkPwd === false) {
        //send back to login page with error of wronglogin
        header("Location: ../utilities/login.php?error=wronglogin");
        exit();
    } else if($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["user_id"];
        $_SESSION["username"] = $uidExists["user_name"];
        $_SESSION["fullname"] = $uidExists["full_name"];
        $_SESSION["gender"] = $uidExists["gender"];
        header("Location: ../index.php");
        exit();
    }
}

//check if any field is empty in edit.inc.php
function emptyInputEdit($new_full_name, $user_id, $new_user_name, $new_role, $new_employment_status, $new_email, $current_password) {
    $result;
    if(empty($new_full_name) || empty($new_user_name) || empty($new_role) || empty($new_employment_status) || empty($new_email)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

//check if the user id exists in the db
function userIdExistence($conn, $user_id) {
    //create sql query
    $sql = "SELECT * FROM users WHERE user_id = ?;";
    //declare php statement for secure storing of user data
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./index.php?&error=stmtfailed");
        exit();
    }
    //bind the variables to the statement
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//check if the user id exists in the db
function userIdExists($conn, $new_user_name, $user_id) {
    //create sql query
    $sql = "SELECT * FROM users WHERE user_name = ?;";
    //declare php statement for secure storing of user data
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./edit-user.inc.php?user_id=$user_id&error=stmtfailed");
        exit();
    }
    //bind the variables to the statement
    mysqli_stmt_bind_param($stmt, "s", $new_user_name);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($rows = mysqli_fetch_assoc($resultData)) {
        return $rows;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function emptyCurrentPassword($current_password) {
    $result;
    if(empty($current_password)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function wrongPassword($conn, $user_id, $new_user_name, $current_password) {
    $result;
    $uidExists = userIdExists($conn, $new_user_name, $user_id);

    // if username already exists
    if($uidExists === true) {
        header("Location: ./edit-user.inc.php?user_id=$user_id&error=usernametaken");
        exit();
    }

    $employee_account = userIdExistence($conn, $user_id);

    //check hashed password
    $pwdHashed = $employee_account["password"];
    //unhash the hashed password
    $checkPwd = password_verify($current_password, $pwdHashed);
    if($checkPwd === true) {
        $result = false;
    } else {
        $result = true;
    }
    return $result;
}

function updateUser($conn, $user_id, $new_full_name, $new_gender, $new_user_name, $new_birthday, $new_role, $salary, $new_employment_status, $new_email, $new_password) {
    if(!empty($new_password)) {
        // $query = "UPDATE users SET full_name='$new_full_name', user_name='$new_user_name', role='$new_role', email='$new_email', password='$new_password', date=NOW(), employment_status='$new_employment_status' WHERE user_id='$user_id';";
        //hashing the password
        $hashedPwd = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET full_name='$new_full_name', gender='$new_gender', user_name='$new_user_name', birthday='$new_birthday', role='$new_role', email='$new_email', password='$hashedPwd', employment_status='$new_employment_status', salary='$salary' WHERE user_id='$user_id';";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=none");
            exit();
        } else {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=stmtfailed");
            exit();
        }
        // $sql = "UPDATE SET users full_name=?, user_name=?, role=?, email=?, password=?, employment_status=? WHERE user_id=?;";
        // $stmt = mysqli_stmt_init($conn);
        // if(!mysqli_stmt_prepare($stmt, $sql)) {
        //     header("Location: ./edit-user.inc.php?user_id=$user_id&error=stmtfailed");
        //     exit();
        // }

        // //hashing the password
        // $hashedPwd = password_hash($new_password, PASSWORD_DEFAULT);

        // mysqli_stmt_bind_param($stmt, "ssssssi", $new_full_name, $new_user_name, $new_role, $email, $hashedPwd, $employment_status, $user_id);
        // mysqli_stmt_execute($stmt);
        // mysqli_stmt_close($stmt);

        // header("Location: ./edit-user.inc.php?user_id=$user_id&error=none");
        // exit();
    } else {
        $query = "UPDATE users SET full_name='$new_full_name', gender='$new_gender', user_name='$new_user_name', birthday='$new_birthday', role='$new_role', email='$new_email', employment_status='$new_employment_status', salary='$salary' WHERE user_id='$user_id';";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=none");
            exit();
        } else {
            header("Location: ./edit-user.inc.php?user_id=$user_id&error=stmtfailed");
            exit();
        }
        // $sql = "UPDATE SET users full_name=?, user_name=?, role=?, email=?, employment_status=? WHERE user_id=?;";
        // $stmt = mysqli_stmt_init($conn);
        // if(!mysqli_stmt_prepare($stmt, $sql)) {
        //     header("Location: ./edit-user.inc.php?user_id=$user_id&error=stmtfailed");
        //     exit();
        // }
        // mysqli_stmt_bind_param($stmt, "sssssi", $new_full_name, $new_user_name, $new_role, $email, $hashedPwd, $employment_status, $user_id);
        // mysqli_stmt_execute($stmt);
        // mysqli_stmt_close($stmt);

        // header("Location: ./edit-user.inc.php?user_id=$user_id&error=none");
        // exit();
    }
}

//check if the user name exists in the db
function userNameExistence($conn, $new_user_name, $user_id) {
    //create sql query
    $sql = "SELECT * FROM users WHERE user_name = ?;";
    //declare php statement for secure storing of user data
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ./index.php?&error=stmtfailed");
        exit();
    }
    //bind the variables to the statement
    mysqli_stmt_bind_param($stmt, "s", $new_user_name);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        $presentData = (userIdExistence($conn, $user_id));
        if(basename($_SERVER["SCRIPT_FILENAME"], '.php') !== "edit-user.inc") {
            $result = false;
            return $result;
        }
        if($presentData["user_name"] === $new_user_name) {
            $result = false;
            return $result;
        }
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

//check if the user name exists for Admin account creation
function adminExists($conn, $user_name) {
    //create sql query
    $sql = "SELECT * FROM users WHERE user_name = ?;";
    //declare php statement for secure storing of user data
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../utilities/login.php?error=stmtfailed");
        exit();
    }
    //bind the variables to the statement
    mysqli_stmt_bind_param($stmt, "s", $user_name);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($rows = mysqli_fetch_assoc($resultData)) {
        return $rows;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function invalidBirthday($birthday) {
    $result;
    // if(checkdate(strtoint($birthday, 5, 2), strtoint($birthday, 8, 2), strtoint($birthday, 0, 4))) {
    if(validateDate($birthday, $format = 'Y-m-d')) {
        $result = false;
    }else {
        $result = true;
    }
    return $result;
}