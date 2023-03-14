<?php
    session_start();
    include('dbcon.php');
    date_default_timezone_set('Asia/Manila');
    $datetime = date('Y/m/d h:i:s a');

    if(isset($_POST['signin_employee'])){
        if(empty($_POST['email'])){
            $_SESSION['failed'] = "Invalid Email Address!";
            header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
            exit();
        }
        if(empty($_POST['password'])){
            $_SESSION['failed'] = "Invalid Password!";
            header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
            exit();
        }
        else{
            $email = $_POST['email'];
            $clearTextPassword = $_POST['password'];
            try {
                $user = $auth->getUserByEmail($email);
                try {
                    $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword);
                    $idTokenString = $signInResult->idToken();
                    try {
                        try {
                            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                            $uid = $verifiedIdToken->claims()->get('sub');
                            
                            try{
                                $role_table = "account_roles";
                                $fetch_roles = $database->getReference($role_table)->getValue();
                                if($fetch_roles > 0){
                                    foreach($fetch_roles as $key => $row){
                                        if($row['account_id'] == $uid){
                                            $_SESSION['verified_employee_uid'] = $uid;
                                            $_SESSION['idTokenString'] = $idTokenString;
            
                                            $audit_table = "audit_logs";
                                            $audit_details = ['account_id' => $uid,
                                                                'action' => "SIGN IN",
                                                                'date' => $datetime,
                                                                'description' => "Sign in to Bus Driver account."];
                                            $database->getReference($audit_table)->push($audit_details);
                                            
                                            $_SESSION['status'] = "Sign In successfully.";
                                            header('Location:http://localhost/Shuttle_Bus_System/bus_driver/menu.php');
                                            exit();
                                        }else{
                                            $_SESSION['failed'] = "Unauthorized Access! Bus Driver Employees only.";
                                            header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
                                            exit();
                                        }
                                    }
                                }else{
                                    $_SESSION['failed'] = "Error: ".$th->getMessage();
                                    header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
                                    exit();
                                }
                            }catch(\Throwable $th){
                                $_SESSION['failed'] = "Error: ".$th->getMessage();
                                header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
                                exit();
                            }
                        } catch (\Throwable $th) {
                            $_SESSION['failed'] = "Error: ".$th->getMessage();
                            header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
                            exit();
                        }
                    } catch (\Kreait\Firebase\Exception\Auth\FailedToVerifyToken $e) {
                        $_SESSION['failed'] = $e->getMessage();
                        header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
                        exit();
                    }
                } catch (Exception $e) {
                    $_SESSION['failed'] = "Invalid Password!";
                    header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
                    exit();
                }
            } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                $_SESSION['failed'] = "Invalid Email Address!";
                header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
                exit();
            }
        }
    }
    if(isset($_POST['signout_employee'])){
        unset($_SESSION['verified_employee_uid']);
        $_SESSION['status'] = "Sign Out successfully";
        header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
        exit();
    }
?>