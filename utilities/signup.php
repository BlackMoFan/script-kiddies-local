<?php
// session_start();
    include_once './header-components.php';

    // if(!isset($_SESSION["userid"])) {
    //     header("Location: login.php");
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
                        person_add
                    </span>
                    <div class="middle">
                        <div class="left">
                            <!-- <h3>Script Kiddies</h3> -->
                            <h1>Add employee information</h1>
                            <form action="../includes/signup.inc.php" method="POST" id="login-form">
                                <!-- RESULT IF THERE ARE ERRORS-->

                                <div class="input-group">
                                    <input type="text" name="full_name" placeholder="John Doe" id="fullname">
                                    <label for="fullname">
                                        <span class="icon material-symbols-sharp">person</span>
                                        Full name
                                    </label>
                                </div>
                                <div class="input-group">
                                    <input type="text" name="gender" placeholder="Male/Female" id="sex">
                                    <label for="sex">
                                        <span class="icon material-symbols-sharp">transgender</span>
                                        Sex
                                    </label>
                                </div>
                                <div class="input-group">
                                    <input type="text" name="user_name" placeholder="johndoe" id="username">
                                    <label for="username">
                                        <span class="icon material-symbols-sharp">text_fields</span>
                                        Username
                                    </label>
                                </div>
                                <div class="input-group">
                                    <input type="date" name="birthday" id="birthday">
                                    <label for="birthday">
                                        <span class="icon material-symbols-sharp">calendar_month</span>
                                        Birthday
                                    </label>
                                </div>
                                <div class="input-group">
                                    <input type="text" name="role" placeholder="Full-Stack Developer" id="role">
                                    <label for="role">
                                        <span class="icon material-symbols-sharp">badge</span>
                                        Role
                                    </label>
                                </div>
                                <div class="input-group">
                                    <input type="number" name="salary" placeholder="120000.0" id="salary">
                                    <label for="salary">
                                    <span class="icon material-symbols-sharp">paid</span>
                                        Salary
                                    </label>
                                </div>
                                <div class="input-group">
                                    <input type="text" name="employment_status" placeholder="Employed/On leave/Resigned" id="employment_status">
                                    <label for="employment_status">
                                    <span class="icon material-symbols-sharp">verified_user</span>
                                        Employment status
                                    </label>
                                </div>
                                <div class="input-group">
                                    <input type="email" name="email" placeholder="email@domain.com" id="email">
                                    <label for="email">
                                    <span class="icon material-symbols-sharp">email</span>
                                        Email
                                    </label>
                                </div>
                                <div class="input-group">
                                    <div class="password-field">
                                        <input class="showpass" type="password" name="password" id="password">
                                        <span class="toggler material-symbols-sharp">visibility</span>
                                    </div>
                                    <label for="password">
                                    <span class="icon material-symbols-sharp">lock</span>
                                        Password
                                    </label>
                                </div>
                                <div class="input-group">
                                    <div class="password-field">
                                        <input class="showpass" type="password" name="passwordRepeat" id="passwordRepeat">
                                        <span class="toggler material-symbols-sharp">visibility</span>
                                    </div>
                                    <label for="passwordRepeat">
                                    <span class="icon material-symbols-sharp">lock</span>
                                        Repeat password
                                    </label>
                                </div>
                                
                                <!-- <input type="text" name="full_name" placeholder="Full name" > -->
                                <!-- <input type="text" name="gender" placeholder="Sex (Male/Female)" > -->
                                <!-- <input type="text" name="user_name" placeholder="Username" > -->
                                <!-- <input type="text" name="role" placeholder="Role" > -->
                                <!-- <input type="text" name="salary" placeholder="Salary" > -->
                                <!-- <input type="text" name="employment_status" placeholder="Employment status" > -->
                                <!-- <input type="text" name="email" placeholder="Email"> -->
                                <!-- <input type="password" name="password" placeholder="Password"> -->
                                <!-- <input type="password" name="passwordRepeat" placeholder="Repeat password"> -->
                                <!-- <a href="./index.html"><button id="submit-btn">Submit</button></a> -->
                                <input type="submit" value="Add to organization" name="submit">
                                <div id="returnedResult">
                                    <?php
                                        if(isset($_GET["error"])) {
                                            if($_GET["error"] == "emptyinput") {
                                                echo "Fill in all fields!";
                                            } else if($_GET["error"] == "invaliduid") {
                                                echo "Choose a proper username!";
                                            } else if($_GET["error"] == "invalidemail") {
                                                echo "Choose a proper email!";
                                            } else if($_GET["error"] == "invalidbirthday") {
                                                echo "Please input a valid date!";
                                            } else if($_GET["error"] == "passwordsdontmatch") {
                                                echo "Passwords doesn't match!";
                                            } else if($_GET["error"] == "stmtfailed") {
                                                echo "Something went wrong, try again!";
                                            } else if($_GET["error"] == "usernametaken") {
                                                echo "Username already taken";
                                            } else if($_GET["error"] == "invalidsalary") {
                                                echo "Please enter a valid salary input without commas and with at least 1 decimal point";
                                            } else if($_GET["error"] == "invalidemploymentstatus") {
                                                echo "Employment status can only be: Employed, On leave, or Resigned";
                                            } else if($_GET["error"] == "invalidsex") {
                                                echo "Please enter proper sex!";
                                            } else if($_GET["error"] == "none") {
                                                echo "You have signed up!";
                                            }
                                        }
                                    ?>
                                </div>

                                
                            </form>
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
                            <p><strong>Product Manager:</strong>  Jazmin Cortez</p>
                            <p><strong>Team Lead:</strong>  Hannah Santocildes</p>
                            <p><strong>Documenter:</strong>  Kenji Sondia</p>
                            <p><strong>Business Analyst:</strong>  Mayenel Quintillia</p>
                            <p><strong>Developers:</strong>  Danny Damgo & Rod Moreno</p>
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
    include_once 'footer-signup.php';
?>