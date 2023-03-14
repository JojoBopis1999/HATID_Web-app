<?php
    session_start();
    include('dbcon.php');

    if(isset($_POST['reset_btn'])){
        if($_POST['new_password'] && !empty($_POST['new_password'])){
            if($_POST['confirm_password'] && !empty($_POST['confirm_password'])){
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
                if($new_password == $confirm_password){
                    try {
                        $uid = $_POST['employee_id'];
                        $updatedUser = $auth->changeUserPassword($uid, $new_password);

                        $_SESSION['status'] = "Set Password successfully!";
                        header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php'); 
                        exit();
                    } catch (\Throwable $th) {
                        $_SESSION['failed'] = "Error Message: ".$th->getMessage();
                        header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php'); 
                        exit();
                    }
                }else{
                    $_SESSION['failed'] = "New Password and Confirm Password isn't match!";
                    header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php'); 
                    exit();
                }
            }else{
                $_SESSION['failed'] = "Please set the confirm password.";
                header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php'); 
                exit();
            }
        }else{
            $_SESSION['failed'] = "Please set a new password.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php'); 
            exit();
        }
    }
?>