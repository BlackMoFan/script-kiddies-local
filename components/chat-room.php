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
            <!-- <h1>Chat room</h1> -->

            <!-- <div class="date">
                <input type="date">
            </div> -->

            <!---------- START OF INSIGHTS (TOP PART) -------------->
            <section class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">
                        forum
                    </span>
                    <div class="middle">
                        <!-- <div class="left"> -->
                            <!-- <h3>Script Kiddies</h3>
                            <h1>An Employee Management System</h1> -->
                            <div class="chatBox">
                                <div class="chatBoxHeader">
                                    <!-- <span class="header-icon material-symbols-sharp">chat_bubble</span> -->
                                    Script Kiddies
                                </div>
                                <div class="messageBox">
                                    <?php 
                                        $chatMessage = mysqli_query($conn, "SELECT * FROM chat_messages ORDER BY date ASC;");
                                        while($chat = mysqli_fetch_array($chatMessage)){
                                            $employeeRecordQuery = mysqli_query($conn, "SELECT * FROM users WHERE user_id={$chat["user_id"]}");
                                            $employeeRecord = mysqli_fetch_array($employeeRecordQuery);
                                            if($chat["user_id"] != $_SESSION["userid"]) {
                                    ?>
                                            <div class="msg left-msg">
                                                <div class="msg-img" style="background-image: url('../assets/images/<?= $employeeRecord["gender"]; ?>.jpg');"></div>
                                                <div class="msg-bubble">
                                                    <div class="msg-info">
                                                        <div class="msg-info-name"><?= $employeeRecord["full_name"]; ?></div>
                                                        <div class="msg-info-time"><?= date('M d, h:i A', strtotime($chat["date"])); ?></div>
                                                    </div>
                                                    <div class="msg-text">
                                                    <!-- Hi, welcome to SimpleChat! Go ahead and send me a message. 😄 -->
                                                    <?= $chat["message"]; ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                            } else {
                                    ?>
                                            <div class="msg right-msg">
                                                <div class="msg-img" style="background-image: url('../assets/images/<?= $employeeRecord["gender"]; ?>.jpg');"></div>
                                                    <div class="msg-bubble">
                                                        <div class="msg-info">
                                                            <div class="msg-info-name">
                                                                <?= $employeeRecord["full_name"]; ?>
                                                                <!-- Admin -->
                                                            </div>
                                                            <div class="msg-info-time">
                                                                <?= date('M d, h:i A', strtotime($chat["date"])); ?>
                                                                <!-- 12:46 -->
                                                            </div>
                                                        </div>
                                                        <div class="msg-text">
                                                        <?= $chat["message"]; ?>
                                                        <!-- Nice -->
                                                        </div>
                                                    </div>
                                            </div>
                                    <?php
                                            }
                                        }
                                    ?>  
                                </div>
                                <!-- <div class="inputBox"> -->
                                <form class="inputBox" action="../includes/post-message.inc.php" method="POST">
                                    <input type="hidden" value="<?php echo $_SESSION["userid"] ?>" name="user_id">
                                    <input type="text" class="chat-message-area" placeholder="Enter your message..." name="chat-message" autocomplete="off">
                                    <input type="submit" class="chat-send-button" name="post_message" value="Send">
                                    <!-- <span class="send-icon material-symbols-sharp">send</span> -->
                                </form>
                                <!-- </div> -->
                            </div>
                        <!-- </div> -->
                        <!-- <div class="progress">
                            <svg>
                                <circle cx='38' cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div> -->
                    </div>
                    <div id="returnedResult">
                        <?php
                            if(isset($_GET["error"])) {
                                if($_GET["error"] == "stmtfailed") {
                                    echo "Something went wrong, try again!";
                                } 
                                // else if($_GET["error"] == "invalidemail") {
                                //     echo "Choose a proper email!";
                                // } else if($_GET["error"] == "passwordsdontmatch") {
                                //     echo "Passwords doesn't match!";
                                // } else if($_GET["error"] == "usernametaken") {
                                //     echo "Username already taken";
                                // } else if($_GET["error"] == "invalidsalary") {
                                //     echo "Please enter a valid salary input without commas and with at least 1 decimal point";
                                // } else if($_GET["error"] == "invalidemploymentstatus") {
                                //     echo "Employment status can only be: Employed, On leave, or Resigned";
                                // } else if($_GET["error"] == "invalidsex") {
                                //     echo "Please enter proper sex!";
                                // } else if($_GET["error"] == "none") {
                                //     echo "You have signed up!";
                                // }
                            }
                        ?>
                    </div>
                    <!-- <small class="text-muted">
                        Last 24 hours
                    </small> -->
                </div>
                <!-- TOTAL EMPLOYEES -->
                <!-------------------- END OF TOTAL SALES ------------------------->
                <!-- <div class="expenses">
                    <span class="material-icons-sharp">
                        groups_3
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Script Kiddies</h3>
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
    include_once '../utilities/footer-signup.php';
?>