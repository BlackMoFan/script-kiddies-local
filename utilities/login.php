<?php
// session_start();

    // include("connection.php");
    // include("./includes/functions.inc.php");
    // include("functions.php");

    // if($_SERVER['REQUEST_METHOD'] == "POST"){
    //     //something was posted
    //     $user_name = $_POST['user_name'];
    //     $password = $_POST['password'];

    //     if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
    //         //read from db
    //         $query = "select * from users where user_name = '$user_name' limit 1";
        
    //         $result = mysqli_query($conn, $query);

    //         if($result){
    //             if($result && mysqli_num_rows($result) > 0)
    //             {
    //                 $user_data = mysqli_fetch_assoc($result);
                    
    //                 if($user_data['password'] === $password){
    //                     $_SESSION['user_id'] = $user_data['user_id'];
    //                     header("Location: index.php");
    //                     die;
    //                 }
    //             }
    //         }
    //         // echo "wrong username or password!";
    //     }else {
    //         echo "wrong username or password!";
    //     }
    // }
?>

<?php
    include_once 'header-placeholder.php';
?>
            <h1>Employee Management System</h1>

            <!-- <div class="date">
                <input type="date">
            </div> -->

            <!---------- START OF INSIGHTS (TOP PART) -------------->
            <section class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">
                        login
                    </span>
                    <div class="middle">
                        <div class="left">
                            <!-- <h3>Script Kiddies</h3> -->
                            <h1>Login</h1>
                            <form action="../includes/login.inc.php" method="POST" id="login-form">
                                <div class="input-group">
                                    <input type="text" name="uid" placeholder="johndoe" id="uid">
                                    <label for="uid">
                                        <span class="icon material-symbols-sharp">person</span>
                                        Username
                                    </label>
                                </div>
                                <div class="input-group">
                                    <div class="password-field">
                                        <input class="showpass" type="password" name="password" id="password">
                                        <span class="toggler material-symbols-sharp">visibility</span>
                                        <label for="password">
                                            <span class="icon material-symbols-sharp">key</span>
                                            Password
                                        </label>
                                    </div>
                                </div>
                                <!-- <input type="text" name="uid" placeholder="Username or Email" > -->
                                <!-- <input type="password" name="password" placeholder="Password"> -->
                                
                                <!-- <a href="./index.html"><button id="submit-btn">Submit</button></a> -->
                                <input type="submit" value="Login" name="submit">

                                <!-- RESULT IF THERE ARE ERRORS-->
                                <div id="returnedResult">
                                    <?php
                                        if(isset($_GET["error"])) {
                                            if($_GET["error"] == "emptyinput") {
                                                echo "Fill in all fields!";
                                            } else if($_GET["error"] == "wronglogin") {
                                                echo "Incorrect login information!";
                                            }
                                        }
                                    ?>
                                </div>
                            </form>
                            <!-- <div id="or">or</div> -->
                            <!-- <a href="signup.php" class="clickTo">Sign up</a> -->
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
                <div class="expenses">
                    <span class="material-icons-sharp">
                        groups_3
                    </span>
                    <div class="middle">
                        <div class="left">
                            <!-- <h3>Script Kiddies</h3> -->
                            <h1>The team</h1>
                            <p><strong>Product Manager:</strong>  Jazmin Cortez</p>
                            <p><strong>Team Lead:</strong>  Hannah Santocildes</p>
                            <p><strong>Documenter:</strong>  Kenji Sondia</p>
                            <p><strong>Business Analyst:</strong>  Mayenel Quintillia</p>
                            <p><strong>Developers:</strong>  Danny Damgo & Rod Moreno</p>
                        </div>
                        <div class="progress">
                            <!-- <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg> -->
                            <!-- <div class="number">
                                <p>81%</p>
                            </div> -->
                            <!-- <span class="material-icons-sharp">
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
                            </span> -->
                        </div>
                    </div>
                    <div id="login-info">
                        <!-- <span class="material-symbols-sharp">rocket_launch</span> -->
                        <strong>Script Kiddies Employee Management
                        System (EMS)</strong> is an information management
                        software that stores and manages personal and
                        work-related information of employees of a
                        company or an organization. <br />
                        This employee management system is intended for the
                        utilization of employees, staffs and managers of a
                        company. It gives better employee database
                        management, employee payroll, and employee
                        analytics.
                    </div>
                    <a id="manual-btn" href="../assets/examples/SCRIPTKIDDIES-USER-MANUAL.pdf">
                        <span class="material-symbols-sharp">library_books</span>
                        Manual
                    <a>
                    <small class="text-muted">
                        blackmofan &copy 2022. All Rights Reserved.
                    </small>
                </div>
                <!-- TOTAL EXPENSES -->
                <!-------------------- END OF EXPENSES ------------------------->
            </section>
            <!------------- END OF INSIGHTS ------------->
            <!----------- END OF RECENTLY ADDED -------------------->

<?php
    include_once 'footer.php';
?>