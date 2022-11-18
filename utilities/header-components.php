<?php
session_start();
    include("../utilities/connection.php");
    include("../includes/functions.inc.php");
    include("../utilities/functions.php");

    // $user_data = check_login($conn);
    if(!isset($_SESSION["userid"])) {
        header("Location: ../utilities/login.php");
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
    <link href="../assets/icons/employee-2.png" rel="icon" type="image/x-icon" />

    <!-- Material icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,1,0" />

    <!-- Personal stylesheet -->
    <link href="../css/style.css" rel="stylesheet" type="text/css" />

    <!-- <script src="./js/recent-add.js" defer></script> -->
    <script src="../js/index.js" defer></script>
</head>
<body>
    <section class="container">

        <!------------- START OF ASIDE ----------------->
        <aside>
            <!------------ TOP - LOGO & GROUP NAME ------------------>
            <section class="top">
                <div class="logo">
                    <img src="../assets/images/tux.png">
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
                    echo '<!-- <a href="../index.html" class="sidebar-nav">';
                    echo '    <span class="material-icons-sharp">';
                    echo '        home';
                    echo '    </span>';
                    echo '    <h3>Home</h3>';
                    echo '</a> -->';
                    echo '<!-- Main overview of the company -->';
                    if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "index") {
                        echo '<a href="#" class="active sidebar-nav">';
                    } else {
                        echo '<a href="../index.php" class="sidebar-nav">';
                    }
                    echo '    <span class="material-icons-sharp">';
                    echo '        dashboard';
                    echo '    </span>';
                    echo '    <h3>Dashboard</h3>';
                    echo '</a>';
                    echo '<!-- List of employees with their details -->';
                    if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "employees") {
                        echo '<a href="#" class="active sidebar-nav">';
                    } else {
                        echo '<a href="../components/employees.php" class="sidebar-nav">';
                    }
                    // echo '<a href="employees.php" class="active sidebar-nav">';
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
                    echo '<!-- About -->';
                    if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "chat-room") {
                        echo '<a href="#" class="active sidebar-nav">';
                    } else {
                        echo '<a href="../components/chat-room.php" class="sidebar-nav">';
                    }
                    // echo '<a href="about.php" class="sidebar-nav">';
                    echo '    <span class="material-icons-sharp">';
                    echo '        forum';
                    echo '    </span>';
                    echo '    <h3>Chat</h3>';
                    echo '</a>';
                    if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "about") {
                        echo '<a href="#" class="active sidebar-nav">';
                    } else {
                        echo '<a href="../components/about.php" class="sidebar-nav">';
                    }
                    // echo '<a href="about.php" class="sidebar-nav">';
                    echo '    <span class="material-icons-sharp">';
                    echo '        help_outline';
                    echo '    </span>';
                    echo '    <h3>About</h3>';
                    echo '</a>';
                    if($_SESSION["username"] === "Admin"){
                        echo '<!-- Administrative settings (available to the admin account only) -->';
                        echo '<!-- This is where CRUD is done -->';
                        // if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "signup") {
                        //     echo '<a href="#" class="active sidebar-nav">';
                        // } if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "about" || basename($_SERVER["SCRIPT_FILENAME"], '.php') === "employees" || basename($_SERVER["SCRIPT_FILENAME"], '.php') === "edit-user.inc") {
                        //     echo '<a href="../utilities/signup.php" class="sidebar-nav">';
                        // }
                        if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "signup") {
                            echo '<a href="#" class="active sidebar-nav">';
                        } else {
                            echo '<a href="../utilities/signup.php" class="sidebar-nav">';
                        }
                        echo '   <span class="material-icons-sharp">';
                        echo '       person_add';
                        echo '    </span>';
                        echo '    <h3>Add Employee</h3>';
                        echo '</a>';
                        echo '<!-- This is where deleted accounts go -->';
                        if(basename($_SERVER["SCRIPT_FILENAME"], '.php') === "deleted-accounts") {
                            echo '<a href="../components/deleted-accounts.php" class="active sidebar-nav">';
                        } else {
                            echo '<a href="../components/deleted-accounts.php" class="sidebar-nav">';
                        }
                        // echo '<a href="../components/deleted-accounts.php" class="sidebar-nav">';
                        echo '   <span class="material-icons-sharp">';
                        echo '       group_remove';
                        echo '    </span>';
                        echo '    <h3>Deleted Accounts</h3>';
                        echo '</a>';
                    }
                    echo '<!-- Log out -->';
                    echo '<!--<a href="./login.html">-->';
                    echo '<a href="../utilities/logout.php" class="sidebar-nav">';
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