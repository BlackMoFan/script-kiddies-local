<?php
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
            <!-- <h1>About</h1> -->

            <!-- <div class="date">
                <input type="date">
            </div> -->

            <!---------- START OF INSIGHTS (TOP PART) -------------->
            <section class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">
                        hub
                    </span>
                    <div class="middle">
                        <div class="left">
                            <!-- <h3>Script Kiddies</h3> -->
                            <h1>An Employee Management System</h1>
                            <div id="about-info">
                                <span class="material-symbols-sharp">rocket_launch</span>
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
                        </div>
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
                        code
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
    include_once '../utilities/footer-signup.php';
?>