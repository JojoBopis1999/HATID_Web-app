<?php
    session_start();
    include('dbcon.php');
    
    date_default_timezone_set('Asia/Manila');
    $datetime = date('Y-m-d h:i:s a');

    if(isset($_POST['send_feedback'])){
        if($_POST['subject'] != 'selected'){
            $subject = $_POST['subject'];
            $email = $_POST['email'];
            $message = nl2br($_POST['message']);
            try {
                $send_feedback = [  'subject' => $subject,
                                    'email' => $email,
                                    'message' => $message,
                                    'timestamp' => $datetime ];
                $feedback_table = "feedbacks";
                $database->getReference($feedback_table)->push($send_feedback);
    
                $_SESSION['status'] = "Your feedback has been send.";
                header('Location:http://localhost/Shuttle_Bus_System/contact.php');
                exit();
            } catch (\Throwable $th) {
                $_SESSION['failed'] = "Your feedback can't be send. | Error Message".$th->getMessage();
                header('Location:http://localhost/Shuttle_Bus_System/contact.php');
                exit();
            }
        }else{
                $_SESSION['failed'] = "Please choose a subject below email.";
                header('Location:http://localhost/Shuttle_Bus_System/contact.php');
                exit();
        }
    }
?>