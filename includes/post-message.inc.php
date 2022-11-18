<?php
    require_once '../utilities/connection.php';
    require_once './functions.inc.php';

    if(isset($_POST["post_message"])) {
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $message = mysqli_real_escape_string($conn, $_POST['chat-message']);
        // var_dump($user_id, $message);
        // die;

        $sql = "INSERT INTO chat_messages (user_id, message) VALUES (?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../components/chat-room.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "is", $user_id, $message);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: ../components/chat-room.php?error=none");
        exit();
    }