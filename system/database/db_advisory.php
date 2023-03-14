<?php
    session_start();
    include('dbcon.php');

    date_default_timezone_set('Asia/Manila');
    $datetime = date('Y-m-d h:i:s a');

    if(isset($_POST['create_advisory'])){
        $subject = $_POST['subject'];
        $message = nl2br($_POST['message']);

        try {
            $insertPost = [ 
                'subject' => $subject,
                'message' => $message,
                'timestamp' => $datetime];
            $advisoryTable = "board_advisory";
            $database->getReference($advisoryTable)->push($insertPost);

            $_SESSION['status'] = "New post has been uploaded successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/sender_advisory.php');
            exit();
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Post is not uploaded | Error Message".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/sender_advisory.php');
            exit();
        }
    }

    if(isset($_POST['update_advisory'])){
        $adv_id = $_POST['adv_id'];
        $subject = $_POST['subject'];
        $message = nl2br($_POST['message']);
        try {
            $updatePost = [ 'subject' => $subject, 'message' => $message, 'timestamp' => $datetime];
            $advisoryTable = 'board_advisory/'.$adv_id;
            $database->getReference($advisoryTable)->update($updatePost);

            $_SESSION['status'] = "Post has been edited successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/sender_advisory.php');
            exit();
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Post is not edited | Error Message".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/sender_advisory.php');
            exit();
        }
    }

    if(isset($_POST['remove_advisory'])){
        $adv_id = $_POST['adv_id'];
        try {
            $ref_table = 'board_advisory/'.$adv_id;
            $database->getReference($ref_table)->remove();
            
            $_SESSION['status'] = "Post remove successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/sender_advisory.php');
            exit();
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Error Message: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/sender_advisory.php');
            exit();
        }
    }
?>