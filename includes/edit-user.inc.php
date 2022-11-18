<?php
// session_start();
    include_once '../utilities/header-components.php';

    // if(!isset($_SESSION["userid"])) {
    //     header("Location: ../utilities/login.php");
    //     die;
    // }

    //get table data to be displayed
    $result = mysqli_query($conn, "SELECT * FROM users ORDER BY date DESC;");
    $rowCount = mysqli_num_rows($result);

    //get info about employment status column
    $employmentStatus = mysqli_query($conn, "SELECT employment_status FROM users;");
    $arrayLength = mysqli_num_rows($employmentStatus);
    $employed = 0;
    $onleave = 0;
    $resigned = 0;
    while($ESColumn = mysqli_fetch_array($employmentStatus)){
        // for($i = 0; $i < $arrayLength; $i++){
        if($ESColumn["employment_status"] === "Employed"){
            $employed++;
        } else if($ESColumn["employment_status"] === "On leave"){
            $onleave++;
        } else if($ESColumn["employment_status"] === "Resigned"){
            $resigned++;
        } else {
            continue;
        }
        // }
    }

    //get info about user name to know if there is user of name Admin
    $ifAdminExists = mysqli_query($conn, "SELECT user_name FROM users;");
    $arrayLength = mysqli_num_rows($ifAdminExists);
    $exists = false;
    while($usernameColumn = mysqli_fetch_array($ifAdminExists)){
        // for($i = 0; $i < $arrayLength; $i++){
        if($usernameColumn["user_name"] === "Admin"){
            $exists = true;
        } else {
            continue;
        }
        // }
    }
?>
            <!-- <h1>Employee Management System</h1> -->

            <!-- <div class="date">
                <input type="date">
            </div> -->

            <!---------- START OF INSIGHTS (TOP PART) -------------->
            <section class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">
                        manage_accounts
                    </span>
                    <div class="middle">
                        <div class="left">
                            <!-- <h3>Script Kiddies</h3> -->
                            <h1>Edit employee information</h1>

                            <?php
                                if(isset($_GET["user_id"])) {
                                    $user_id = mysqli_real_escape_string($conn, $_GET["user_id"]);
                                    $query = "SELECT * FROM users WHERE user_id={$user_id}";

                                    $query_run = mysqli_query($conn, $query);

                                    if(mysqli_num_rows($query_run) > 0) {
                                        $employee_data = mysqli_fetch_array($query_run);

                            ?>
                                    <form action="./edit.inc.php" method="POST" id="login-form">
                                        <input type="hidden" name="user_id" value="<?= $employee_data["user_id"]?>">
                                        <div class="input-group">
                                            <input type="text" name="full_name" value="<?= $employee_data["full_name"]?>" placeholder="Full name" id="fullname">
                                            <label for="fullname">
                                                <span class="icon material-symbols-sharp">person</span>
                                                Full name
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="gender" value="<?= $employee_data["gender"]?>" placeholder="Sex (Male/Female)" id="sex">
                                            <label for="sex">
                                                <span class="icon material-symbols-sharp">transgender</span>
                                                Sex
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="user_name" value="<?= $employee_data["user_name"]?>" placeholder="Username" id="username">
                                            <label for="username">
                                                <span class="icon material-symbols-sharp">text_fields</span>
                                                Username
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="date" name="birthday" value="<?= $employee_data["birthday"]?>" id="birthday">
                                            <label for="birthday">
                                                <span class="icon material-symbols-sharp">calendar_month</span>
                                                Birthday
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="role" value="<?= $employee_data["role"]?>" placeholder="Role" id="role">
                                            <label for="role">
                                                <span class="icon material-symbols-sharp">badge</span>
                                                Role
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="number" name="salary" value="<?= $employee_data["salary"]?>" placeholder="Salary" id="salary">
                                            <label for="salary">
                                            <span class="icon material-symbols-sharp">paid</span>
                                                Salary
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="employment_status" value="<?= $employee_data["employment_status"]?>" placeholder="Employed/On leave/Resigned" id="employment_status">
                                            <label for="employment_status">
                                            <span class="icon material-symbols-sharp">verified_user</span>
                                                Employment status
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="email" name="email" value="<?= $employee_data["email"]?>" placeholder="email@domain.com" id="email">
                                            <label for="email">
                                            <span class="icon material-symbols-sharp">email</span>
                                                Email
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <div class="password-field">
                                                <input class="showpass" type="password" name="current-password" placeholder="Current password" required id="current-password">
                                                <span class="toggler material-symbols-sharp">visibility</span>
                                            </div>
                                            <label for="current-password">
                                            <span class="icon material-symbols-sharp">lock</span>
                                                Password
                                            </label>
                                        </div>
                                        <p id="p-note"><span id="note">Note:</span> To change password, provide details below. Otherwise, leave empty.</p>
                                        <div class="input-group">
                                            <div class="password-field">
                                                <input class="showpass" type="password" name="password" placeholder="New password" id="password">
                                                <span class="toggler material-symbols-sharp">visibility</span>
                                            </div>
                                            <label for="password">
                                            <span class="icon material-symbols-sharp">lock</span>
                                                New password
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <div class="password-field">
                                                <input class="showpass" type="password" name="passwordRepeat" placeholder="Repeat password" id="passwordRepeat">
                                                <span class="toggler material-symbols-sharp">visibility</span>
                                            </div>
                                            <label for="passwordRepeat">
                                            <span class="icon material-symbols-sharp">lock</span>
                                                Repeat password
                                            </label>
                                        </div>
                                        
                                        
                                        <!-- <input type="text" name="full_name" value="<?= $employee_data["full_name"]?>" placeholder="Full name" > -->
                                        <!-- <input type="text" name="gender" value="<?= $employee_data["gender"]?>" placeholder="Sex (Male/Female)" > -->
                                        <!-- <input type="text" name="user_name" value="<?= $employee_data["user_name"]?>" placeholder="Username" > -->
                                        <!-- <input type="text" name="role" value="<?= $employee_data["role"]?>" placeholder="Role" > -->
                                        <!-- <input type="number" name="salary" value="<?= $employee_data["salary"]?>" placeholder="Salary"> -->
                                        <!-- <input type="text" name="employment_status" value="<?= $employee_data["employment_status"]?>" placeholder="Employment status" > -->
                                        <!-- <input type="text" name="email" value="<?= $employee_data["email"]?>" placeholder="Email"> -->
                                        <!-- <input type="password" name="current-password" placeholder="Current password" required> -->
                                        <!-- <p><span id="note">Note:</span> To change password, provide details below. Otherwise, leave empty.</p> -->
                                        <!-- <input type="password" name="password" placeholder="New password"> -->
                                        <!-- <input type="password" name="passwordRepeat" placeholder="Repeat password"> -->
                                        <!-- <a href="./index.html"><button id="submit-btn">Submit</button></a> -->
                                        <input type="submit" value="Save updates" name="update_student">
                                    </form>
                            <?php
                                    } else {
                                        header("Location: ./edit-user.inc.php?error=somethingwrong");
                                        exit();
                                    }
                                }
                            ?>
                            <!-- RESULT IF THERE ARE ERRORS-->
                            <div id="returnedResultEdit">
                                <?php
                                    if(isset($_GET["error"])) {
                                        if($_GET["error"] == "emptyinput") {
                                            echo "Fill in all fields!";
                                        } else if($_GET["error"] == "invaliduid") {
                                            echo "Choose a proper username! Only alphanumeric characters are allowed.";
                                        } else if($_GET["error"] == "invalidemail") {
                                            echo "Choose a proper email!";
                                        } else if($_GET["error"] == "passwordsdontmatch") {
                                            echo "Passwords doesn't match!";
                                        } else if($_GET["error"] == "wrongpassword") {
                                            echo "Wrong password entered!";
                                        } else if($_GET["error"] == "stmtfailed") {
                                            echo "Something went wrong, try again!";
                                        } else if($_GET["error"] == "usernametaken") {
                                            echo "Username already taken";
                                        } else if($_GET["error"] == "invalidsalary") {
                                            echo "Please enter a valid salary input without commas and with at least 1 decimal point";
                                        } else if($_GET["error"] == "invalidemploymentstatus") {
                                            echo "Employment status can only be: Employed, On leave, or Resigned";
                                        } else if($_GET["error"] == "emptypassword") {
                                            echo "Please enter your current password!";
                                        } else if($_GET["error"] == "invalidsex") {
                                            echo "Please enter proper sex!";
                                        } else if($_GET["error"] == "none") {
                                            echo "Successfully updated user {$employee_data["full_name"]}!";
                                        }
                                    }
                                ?>
                            </div>

                            <!-- <div id="or">or</div>
                            <a href="login.php" class="clickTo">Login</a> -->
                        </div>
                        <!-- <div>
                            <form>
                                <input type="text" name="username" placeholder="username" >
                                <input type="pasword" name="password" placeholder="password">
                                <button href="#">Submit</button>
                            </form>
                        </div> -->
                        <!-- <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div> -->
                    </div>
                    <!-- <small class="text-muted">
                        Last 24 hours
                    </small> -->
                </div>
                <!-- TOTAL EMPLOYEES -->
                <!-------------------- END OF TOTAL SALES ------------------------->
                <!-- <div class="expenses">
                    <span class="material-icons-sharp">
                        code
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h1>The team</h1>
                            <p>Product Manager: Jazmin Cortez</p>
                            <p>Developer: Rod Moreno</p>
                        </div>
                        <div class="progress">
                            <span class="material-icons-sharp">
                                html
                            </span>
                            <span class="material-icons-sharp">
                                css
                            </span>
                            <span class="material-icons-sharp">
                                javascript
                            </span>
                            <span class="material-icons-sharp">
                                php
                            </span>
                        </div>
                    </div>
                    <small class="text-muted">
                        blackmofan &copy 2022. All Rights Reserved.
                    </small>
                </div> -->
                <!-- TOTAL EXPENSES -->
                <!-------------------- END OF EXPENSES ------------------------->
            </section>
            <!------------- END OF INSIGHTS ------------->
            <!----------- END OF RECENTLY ADDED -------------------->

<?php
    include_once '../utilities/footer-placeholder.php';
?>