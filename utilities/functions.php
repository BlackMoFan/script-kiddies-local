<?php

function check_login($conn)
{
    if(isset($_SESSION['userid']))
    {
        $id = $_SESSION['userid'];
        $query = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // redirect to login
    header("Location: login.php");
    die;
}

//create ID
function random_num($length){
    $text = "";
    if($length < 5){
        $length = 5;
    }

    $len = rand(4, $length);

    for($i = 0; $i < $len; $i++){
        $text .= rand(0, 9);
    }

    return $text;
}