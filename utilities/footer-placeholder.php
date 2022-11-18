</main>
        <!-------------- END OF MAIN CONTENT --------------------->

        <!------- START OF RIGHT CONTENT (ANNOUNCEMENTS, OTHER DETAILS) -------->
        <section class="right">
            <!-- START OF TOP -->
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <!-- theme toggle (light or dark)-->
                <div id="theme-toggler">
                    <!-- light mode -->
                    <span class="material-icons-sharp" id="sun">
                        light_mode
                    </span>
                    <!-- dark mode -->
                    <span class="material-icons-sharp" id="moon">
                        dark_mode
                    </span>
                </div>
                
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>
                             <?php
                                echo $_SESSION["fullname"]; 
                                ?>
                            </b></p>
                        <small class="text-muted">
                            <?php
                                if($_SESSION["username"] === "Admin"){
                                    echo "Admin";
                                }
                                else{
                                    echo "Employee";
                                }
                            ?>
                            <!-- Admin -->
                        </small>
                    </div>
                    <div class="profile-photo">
                        <img src="../assets/images/<?php echo $_SESSION["gender"];?>.jpg">
                    </div>
                </div>
                </div>
                <!-- END OF TOP -->
                <?php

                if(basename($_SERVER["SCRIPT_FILENAME"], '.php') !== "employees" || basename($_SERVER["SCRIPT_FILENAME"], '.php') !== "edit-user.inc") {
                echo '<!-- START OF RECENT UPDATES -->';
                echo '<div class="recent-updates">';
                echo '<h2>Recently added</h2>';
                
                    //get table data to be displayed
                    $result = mysqli_query($conn, "SELECT * FROM users ORDER BY date DESC;");
                    if(mysqli_num_rows($result) > 0) {
                
                        echo '<div class="updates">';
                    
                    
                        while($row = mysqli_fetch_array($result)) {
                            if($row['user_name'] === "Admin"){
                                continue;
                            }
                    
                echo '        <div class="update">';
                echo '            <div class="profile-photo">';
                echo '                <img src="../assets/images/';
                                if($row["gender"] === "Male") {
                                    echo "Male";
                                } else {
                                    echo "Female";
                                }
                                // echo $row["gender"];
                echo '.jpg">';
                echo '            </div>';
                echo '            <div class="message">';
                echo '                <p><b>';
                                    echo $row["full_name"];
                echo '                    <!-- Rod Moreno -->';
                echo '                </b> recently assigned a role of ';
                                    echo $row["role"];
                echo '                    .</p>';
                echo '                <small class="text-muted">';
                                 
                                // date_default_timezone_set("Philippines/Manila");
                                echo date('M d, Y h:i:sa', strtotime($row["date"])); 
                echo '                </small>';
                echo '            </div>';
                echo '        </div>';
                    
                        
                        }
                        } else {
                            echo "No result found";
                        }
                    
                echo '    <!-- <div class="update">';
                echo '        <div class="profile-photo">';
                echo '            <img src="../assets/images/portrait.jpg">';
                echo '        </div>';
                echo '        <div class="message">';
                echo '            <p><b>Rod Moreno</b> recently got employed.</p>';
                echo '            <small class="text-muted">3 minutes ago</small>';
                echo '        </div>';
                echo '    </div>';
                echo '    <div class="update">';
                echo '        <div class="profile-photo">';
                echo '            <img src="../assets/images/portrait.jpg">';
                echo '        </div>';
                echo '        <div class="message">';
                echo '            <p><b>Rod Moreno</b> just resigned.</p>';
                echo '            <small class="text-muted">4 minutes ago</small>';
                echo '        </div>';
                echo '    </div> -->';
                echo '</div>';
                echo '</div>';
                echo '<!-- END OF RECENT UPDATES -->';
                echo '<!-- START OF ANALYTICS -->';
                echo '<div class="analytics">';
                echo '<h2>Analytics</h2>';
                echo '<!-- CURRENTLY EMPLOYED -->';
                echo '<div class="item online">';
                echo '    <div class="icon">';
                echo '        <span class="material-icons-sharp">';
                echo '            person';
                echo '        </span>';
                echo '    </div>';
                echo '    <div class="right">';
                echo '        <div class="info">';
                echo '            <h3>CURRENTLY EMPLOYED</h3>';
                echo '            <small class="text-muted">Last 7 days</small>';
                echo '        </div>';
                echo '        <!--<h5 class="success">+23%</h5>-->';
                echo '        <h3>';
                           
                                // if($exists === true) {
                                    echo $employed - 1;
                                // } else {
                                    // echo $employed;
                                // }
                               
                            
                echo '            <!-- 69 -->';
                echo '        </h3>';
                echo '    </div>';
                echo '</div>';
                echo '<!-- ON LEAVE -->';
                echo '<div class="item offline">';
                echo '    <div class="icon">';
                echo '        <span class="material-icons-sharp">';
                echo '            person_off';
                echo '        </span>';
                echo '    </div>';
                echo '    <div class="right">';
                echo '        <div class="info">';
                echo '            <h3>On leave</h3>';
                echo '            <small class="text-muted">Last 7 days</small>';
                echo '        </div>';
                echo '        <!--<h5 class="warning">+5%</h5>-->';
                echo '        <h3>';
                            
                                echo $onleave;
                            
                echo '            <!-- 3 -->';
                echo '        </h3>';
                echo '    </div>';
                echo '</div>';
                echo '<!-- Resigned -->';
                echo '<div class="item customers">';
                echo '    <div class="icon">';
                echo '        <span class="material-icons-sharp">';
                echo '            person_remove';
                echo '        </span>';
                echo '    </div>';
                echo '    <div class="right">';
                echo '        <div class="info">';
                echo '            <h3>Resigned/Retired/Fired</h3>';
                echo '            <small class="text-muted">Last 7 days</small>';
                echo '        </div>';
                echo '        <!--<h5 class="danger">+2%</h5>-->';
                echo '        <h3>';
                            
                                echo $resigned;
                            
                echo '            <!-- 1 -->';
                echo '        </h3>';
                echo '    </div>';
                echo '</div>';
                echo '<!-- RESULT IF THERE ARE ERRORS-->';
                echo '<div id="returnedResultES">';
                    
                        if(isset($_GET["error"])) {
                            if($_GET["error"] == "somethingwrongerror") {
                                echo "Something went wrong, try again!";
                            }
                        }
                    
                echo '</div>';
                echo '<!-- <div class="item add-category">';
                echo '    <div>';
                echo '        <span class="material-icons-sharp">';
                echo '            add';
                echo '        </span>';
                echo '        <h3>Add Featured</h3>';
                echo '    </div>';
                echo '</div> -->';
                echo '</div>';
                echo '<!-- END OF ANALYTICS -->';
                }
            ?>
        </section>
    </section>
    
</body>
</html>