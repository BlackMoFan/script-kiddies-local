<!-- HEADER FILE -->
<?php
    include_once './utilities/header.php';

    // if(!isset($_SESSION["userid"])) {
    //     header("Location: ./utilities/login.php");
    //     die;
    // }

    //get table data to be displayed
    $result = mysqli_query($conn, "SELECT * FROM users ORDER BY date DESC;");
    $rowCount = mysqli_num_rows($result);

    //get info about employment status column
    $employmentStatus = mysqli_query($conn, "SELECT employment_status FROM users;");
    $employed = 0;
    $onleave = 0;
    $resigned = 0;
    while($ESColumn = mysqli_fetch_array($employmentStatus)){
        if($ESColumn["employment_status"] === "Employed"){
            $employed++;
        } else if($ESColumn["employment_status"] === "On leave"){
            $onleave++;
        } else if($ESColumn["employment_status"] === "Resigned"){
            $resigned++;
        } else {
            continue;
        }
    }

    //get info about user name to know if there is user of name Admin
    // $ifAdminExists = mysqli_query($conn, "SELECT user_name FROM users;");
    // $exists = false;
    // while($usernameColumn = mysqli_fetch_array($ifAdminExists)){
    //     if($usernameColumn["user_name"] === "Admin"){
    //         $exists = true;
    //     } else {
    //         continue;
    //     }
    // }

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
            <h1>Dashboard</h1>

            <!-- <div class="date">
                <input type="date">
            </div> -->

            <!---------- START OF INSIGHTS (TOP PART) -------------->
            <section class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">
                        analytics
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Employees</h3>
                            <h1>
                                <?php
                                    // if($_SESSION["username"] == "Admin") {
                                        echo $rowCount - ($resigned + 1);
                                    // } else {
                                    //     echo $rowCount - $resigned;
                                    // }
                                ?>
                                <!-- 69 -->
                            </h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36' style="--clr:<?php echo (400 - ($rowCount - ($resigned + 1))) ?>;"></circle>
                            </svg>
                            <div class="number">
                                <p>
                                    <?php
                                        // if($_SESSION["username"] == "Admin") {
                                            echo ($rowCount - ($resigned + 1)) . '%';
                                        // } else {
                                        //     echo ($rowCount - $resigned) . '%';
                                        // }
                                    ?>
                                    <!-- 81% -->
                                </p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">
                        Last 24 Hours
                    </small>
                </div>
                <!-- TOTAL EMPLOYEES -->
                <!-------------------- END OF TOTAL SALES ------------------------->
                <div class="expenses">
                    <span class="material-icons-sharp">
                        bar_chart
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Company Expenses</h3>
                            <h1>
                                <?php
                                    echo $salaryTotal + $resignedSalary + 69;
                                ?>
                                <!-- ₱9,999 -->
                            </h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>
                                    <?php
                                        // if($_SESSION["username"] == "Admin"){
                                            echo '100%';
                                        // }
                                    ?>
                                    <!-- 69% -->
                                </p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">
                        Last 24 Hours
                    </small>
                </div>
                <!-- TOTAL EXPENSES -->
                <!-------------------- END OF EXPENSES ------------------------->
                <div class="income">
                    <span class="material-icons-sharp">
                        stacked_line_chart
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Employee Salary</h3>
                            <h1>
                                <!-- ₱9,999.99 -->
                                <?php
                                    // if($_SESSION["username"] == "Admin"){
                                        echo $salaryTotal;
                                    // }
                                ?>
                            </h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36' style="--clr:<?php echo (100 - round((100 - (($resignedSalary / ($salaryTotal + $resignedSalary)) * 100)))) ?>;"></circle>
                            </svg>
                            <div class="number">
                                <p>
                                    <?php
                                        // if($_SESSION["username"] == "Admin") {
                                        echo round((100 - (($resignedSalary / ($salaryTotal + $resignedSalary)) * 100)), 1)  . '%';
                                        // } else {
                                        //     echo ($salaryTotal - $resigned) / 100 . '%';
                                        // }
                                    ?>
                                    <!-- 95% -->
                                </p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">
                        Last 24 Hours
                    </small>
                </div>
                <!-- TOTAL INCOME -->
                <!-------------------- END OF INCOME ------------------------->
            </section>
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
            <!------------- END OF INSIGHTS ------------->

            <!-------------- RECENTLY ADDED EMPLOYEES --------------------->
            <section class="recent-added">
                <!-- <h2>Recently Added</h2> -->
                <h2>List of Employees</h2>
                <?php
                    if(mysqli_num_rows($result) > 0) {
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Salary</th>
                            <th>Email</th>
                            <th>Birthday</th>
                            <th>Date of Employment</th> <!--- Date of employment ----->
                            <th>Status</th>
                            <?php
                                if($_SESSION["username"] === "Admin") {
                                    echo '<th>Action</th>';
                                }
                            ?>
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
                                <td class="<?php 
                                            if($row["employment_status"] === "Employed") {
                                                echo "success";
                                            } else if($row["employment_status"] === "On leave") {
                                                echo "warning";
                                            } else if($row["employment_status"] === "Resigned") {
                                                echo "danger";
                                            }
                                            ?>"><?php echo $row['employment_status']; ?></td>
                                <?php
                                    if($_SESSION["username"] === "Admin") {
                                    echo '<td id="actions">';
                                    echo '    <a href="./includes/edit-user.inc.php?user_id=';
                                                 echo $row["user_id"];
                                    echo '            "><span class="material-icons-sharp" id="edit-icon">edit</span></a>';
                                    echo '    <form action="./includes/delete-user.inc.php" method="POST">';
                                    echo '            <button id="delete-button" type="submit" name="delete_student" value="';
                                                    echo $row["user_id"];
                                    echo '                ">';
                                                   
                                                        // session_start();
                                                        $_SESSION["file_name"] = basename($_SERVER["SCRIPT_FILENAME"], '.php');
                                                    
                                    echo '                <span class="material-icons-sharp" id="delete-icon">delete_outline</span>';
                                    echo '            </button>';
                                    echo '    </form>';
                                    echo '    <!-- <a href="#" class="deleteUser" data-userid="<?= $row["user_id"];?>" data-username="<?= $row["user_name"];?>" data-fullname="<?= $row["full_name"]?>"><span class="material-icons-sharp" id="delete-icon">delete_outline</span>Del</a> -->';
                                    echo '</td>';
                                    }
                                ?>
                                <!-- <td class="primary">Details</td> -->
                            </tr>
                        <?php
                            $i++;
                            }
                            
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
                <!-- <a href="#">Show All</a> -->
            </section>
            <!----------- END OF RECENTLY ADDED -------------------->
        
<!-- FOOTER FILE -->
<?php
    include_once './utilities/footer.php';
?>