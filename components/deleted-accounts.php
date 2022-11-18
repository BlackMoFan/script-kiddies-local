<?php
    include_once '../utilities/header-components.php';

    // if(!isset($_SESSION["userid"])) {
    //     header("Location: ../utilities/login.php");
    //     die;
    // }

    //get table data to be displayed
    $result = mysqli_query($conn, "SELECT * FROM deleted_users ORDER BY date DESC;");
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

    $salaryTotal;
    $resignedSalary;
    $employeesData = mysqli_query($conn, "SELECT * FROM users;");
    while($employee = mysqli_fetch_array($employeesData)){
        if($employee["employment_status"] !== "Resigned") {
            $salaryTotal += $employee["salary"];
        } else {
            $resignedSalary += $employee["salary"];
        }
    }
?>
            <!-- <h1>Employees</h1> -->

            <!-- <div class="date">
                <input type="date">
            </div> -->

            <!---------- START OF INSIGHTS (TOP PART) -------------->
            <section class="insights">
                <!-- <div class="sales">
                    <span class="material-icons-sharp">
                        analytics
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Employees</h3>
                            <h1>69</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">
                        Last 24 Hours
                    </small>
                </div> -->
                <!-- TOTAL EMPLOYEES -->
                <!-------------------- END OF TOTAL SALES ------------------------->
                <!-- <div class="expenses">
                    <span class="material-icons-sharp">
                        bar_chart
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Expenses</h3>
                            <h1>₱9,999</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>69%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">
                        Last 24 Hours
                    </small>
                </div> -->
                <!-- TOTAL EXPENSES -->
                <!-------------------- END OF EXPENSES ------------------------->
                <!-- <div class="income">
                    <span class="material-icons-sharp">
                        stacked_line_chart
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Income</h3>
                            <h1>₱9,999.99</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>95%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">
                        Last 24 Hours
                    </small>
                </div> -->
                <!-- TOTAL INCOME -->
                <!-------------------- END OF INCOME ------------------------->
            </section>
            <!------------- END OF INSIGHTS ------------->
            <div id="returnedResultDelete">
                <?php
                    if(isset($_GET["error"])) {
                        if($_GET["error"] == "somethingwrong") {
                            echo "Something went wrong, try again!";
                        } else if($_GET["error"] == "none") {
                            echo "Successfully deleted user " . $_SESSION["fullnameDeleted"];
                        }
                    }
                ?>
            </div>

            <!-------------- RECENTLY ADDED EMPLOYEES --------------------->
            <section class="recent-added" id="employees-recent-added">
                <!-- <h2>Recently Added</h2> -->
                <h2>List of Deleted Employee Accounts</h2>
                <?php
                    if(mysqli_num_rows($result) > 0) {
                ?>
                <table id="employees-file-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Salary</th>
                            <th>Email</th>
                            <th>Birthday</th>
                            <th>Date of Employment</th> <!--- Date of employment ----->
                            <th>Date deleted</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $i=0;
                            // foreach($users as $index => $user) {
                            while($row = mysqli_fetch_array($result)) {
                                if($row['user_name'] === "Admin"){
                                    continue;
                                }
                        ?>
                            <tr>
                            <td><?php echo $i + 1; ?></td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td><?php 
                                    if($_SESSION["username"] == "Admin") {
                                        echo '₱' . $row['salary']; 
                                    } else {
                                        if($_SESSION["userid"] == $row["user_id"]) {
                                            echo '₱' . $row['salary'];
                                        } else {
                                            echo '?';
                                        }
                                    }
                                    ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <!-- BIRTHDAY -->
                                <td><?php echo $row['birthday']; ?></td>
                                <!-- THE M in date() function for abbreviated month name -->
                                <td><?php echo date('M d, Y', strtotime($row['date'])); ?></td>
                                <td><?php echo date('M d, Y', strtotime($row['update_date'])); ?></td>
                                <td class="<?php 
                                            if($row["employment_status"] === "Employed") {
                                                echo "success";
                                            } else if($row["employment_status"] === "On leave") {
                                                echo "warning";
                                            } else if($row["employment_status"] === "Resigned") {
                                                echo "danger";
                                            }
                                            ?>"><?php echo $row['employment_status']; ?></td>
                            
                                <!-- <td class="primary">Details</td> -->
                            </tr>
                        <?php
                            $i++;
                            }
                            // mysql_close($conn);
                        ?>
                        <!--
                        <tr>
                            <td>2</td>
                            <td>Rod Lester A. Moreno</td>
                            <td>Full-Stack Developer</td>
                            <td>03-20-2022</td>
                            <td class="success">Employed</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Rod Lester A. Moreno</td>
                            <td>Full-Stack Developer</td>
                            <td>03-20-2022</td>
                            <td class="warning">On leave</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Rod Lester A. Moreno</td>
                            <td>Full-Stack Developer</td>
                            <td>03-20-2022</td>
                            <td class="success">Employed</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Rod Lester A. Moreno</td>
                            <td>Full-Stack Developer</td>
                            <td>03-20-2022</td>
                            <td class="danger">Resigned</td>
                            <td class="primary">Details</td>
                        </tr> -->
                    </tbody>
                </table>
                <?php
                    }
                    else {
                        echo "No result found";
                    }
                ?>
                </table>
                <!-- <a href="#">Show All</a> -->
            </section>
            <!----------- END OF RECENTLY ADDED -------------------->
<?php
    include_once '../utilities/footer-placeholder.php';
?>