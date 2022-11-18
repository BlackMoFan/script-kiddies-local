<?php
session_start();
    include("./utilities/connection.php");
    // require_once './create-table.php';
    include("./utilities/functions.php");

    require_once './includes/functions.inc.php';

    if(!isset($_SESSION["userid"])) {
        header("Location: ./utilities/login.php");
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Script Kiddies | EMS</title>

    <!-- Website icon -->
    <link href="./assets/icons/employee-2.png" rel="icon" type="image/x-icon" />

    <!-- Material icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />

    <!-- Personal stylesheet -->
    <link href="./css/style.css" rel="stylesheet" type="text/css" />

    <!-- <script src="./js/recent-add.js" defer></script> -->
    <script src="./js/index.js" defer></script>
</head>
<body>
    <section class="container">

        <!------------- START OF ASIDE ----------------->
        <aside>
            <!------------ TOP - LOGO & GROUP NAME ------------------>
            <section class="top">
                <div class="logo">
                    <img src="./assets/images/tux.png">
                    <h2>Script<span class="danger">Kiddies</span></h2>
                </div>
                <div class="close" id="close-button">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </section>
            <section class="sidebar">
            <?php
                if(isset($_SESSION["userid"])) {
                    echo '<!-- Home -->';
                    echo '<!-- <a href="./index.html" class="sidebar-nav">';
                    echo '    <span class="material-icons-sharp">';
                    echo '        home';
                    echo '    </span>';
                    echo '    <h3>Home</h3>';
                    echo '</a> -->';
                    echo '<!-- Main overview of the company -->';
                    if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "index") {
                        echo '<a href="#" class="active sidebar-nav">';
                    } else {
                        echo '<a href="../index.php" class="active sidebar-nav">';
                    }
                    echo '    <span class="material-icons-sharp">';
                    echo '        dashboard';
                    echo '    </span>';
                    echo '    <h3>Dashboard</h3>';
                    echo '</a>';
                    echo '<!-- List of employees with their details -->';
                    // if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "employees") {
                    //     echo '<a href="#" class="active sidebar-nav">';
                    // } if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "index") {
                    //     echo '<a href="./components/employees.php" class="sidebar-nav">';
                    // } else {
                    //     echo '<a href="../components/employees.php" class="sidebar-nav">';
                    // }
                    echo '<a href="./components/employees.php" class="sidebar-nav">';
                    echo '    <span class="material-icons-sharp">';
                    echo '        groups';
                    echo '    </span>';
                    echo '    <h3>Employees</h3>';
                    echo '</a>';
                    // if($_SESSION["username"] === "Admin"){
                    //     echo '<!-- Messaging -->';
                    //     echo '<a href="#" class="sidebar-nav">';
                    //     echo '   <span class="material-icons-sharp">';
                    //     echo '        mail_outline';
                    //     echo '    </span>';
                    //     echo '    <h3>Messages</h3>';
                    //     echo '    <span class="message-count">20</span>';
                    //     echo '</a>';
                    // }
                    echo '<!-- Chat room -->';
                    echo '<a href="./components/chat-room.php" class="sidebar-nav">';
                    // echo '<a href="about.php" class="sidebar-nav">';
                    echo '    <span class="material-icons-sharp">';
                    echo '        forum';
                    echo '    </span>';
                    echo '    <h3>Chat</h3>';
                    echo '</a>';
                    echo '<!-- About -->';
                    // if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "about") {
                    //     echo '<a href="./components/about.php" class="active sidebar-nav">';
                    // } else {
                    //     echo '<a href="./components/about.php" class="sidebar-nav">';
                    // }
                    echo '<a href="./components/about.php" class="sidebar-nav">';
                    echo '    <span class="material-icons-sharp">';
                    echo '        help_outline';
                    echo '    </span>';
                    echo '    <h3>About</h3>';
                    echo '</a>';
                    if($_SESSION["username"] === "Admin"){
                        echo '<!-- Administrative settings (available to the admin account only) -->';
                        echo '<!-- This is where CRUD is done -->';
                        // if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "signup") {
                        //     echo '<a href="./utilities/signup.php" class="active sidebar-nav">';
                        // } else {
                        //     echo '<a href="./utilities/signup.php" class="sidebar-nav">';
                        // }
                        echo '<a href="./utilities/signup.php" class="sidebar-nav">';
                        echo '   <span class="material-icons-sharp">';
                        echo '       person_add';
                        echo '    </span>';
                        echo '    <h3>Add Employee</h3>';
                        echo '</a>';
                        echo '<!-- This is where deleted accounts go -->';
                        if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "deleted-accounts") {
                            echo '<a href="./components/deleted-accounts.php" class="active sidebar-nav">';
                        } else {
                            echo '<a href="./components/deleted-accounts.php" class="sidebar-nav">';
                        }
                        // echo '<a href="./components/deleted-accounts.php" class="sidebar-nav">';
                        echo '   <span class="material-icons-sharp">';
                        echo '       group_remove';
                        echo '    </span>';
                        echo '    <h3>Deleted Accounts</h3>';
                        echo '</a>';
                    }
                    echo '<!-- Log out -->';
                    echo '<!--<a href="./login.html">-->';
                    echo '<a href="./utilities/logout.php" class="sidebar-nav">';
                    echo '   <span class="material-icons-sharp">';
                    echo '        logout';
                    echo '    </span>';
                    echo '    <h3>Logout</h3>';
                    echo '</a>';
                }
            ?>
            </section>
        </aside>
        <!----------------------- END OF ASIDE ----------------------->

        <!---------- START OF MAIN CONTENT (CENTER CONTENT) -------------->
        <main>