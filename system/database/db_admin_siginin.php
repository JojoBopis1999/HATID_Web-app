<?php
    session_start();
    include('dbcon.php');
    date_default_timezone_set('Asia/Manila');
    $datetime = date('Y/m/d h:i:s a');

    if(isset($_POST['signin_admin'])){
        $email = $_POST['email'];
        $clearTextPassword = $_POST['password'];
        try {
            $user = $auth->getUserByEmail($email);
            try {
                $signInResult = $auth->signInWithEmailAndPassword($email, $clearTextPassword);
                $idTokenString = $signInResult->idToken();
                //$adminUID = 'MPbhEkpQkBUQZvMoEG7QXQOBWS63';
                try {
                    $verifiedIdToken = $auth->verifyIdToken($idTokenString);
                    $uid = $verifiedIdToken->claims()->get('sub');
                    $roles_table = "account_roles";
                    $fetch_roles = $database->getReference($roles_table)->getValue();
                    if($fetch_roles > 0){
                        foreach($fetch_roles as $key => $row){
                            if($uid != $row['account_id']){
                                $_SESSION['verified_admin_uid'] = $uid;
                                $_SESSION['idTokenString'] = $idTokenString;
        
        
                                $audit_table = "audit_logs";
                                $audit_details = ['account_id' => $adminUID,
                                                    'action' => "SIGN IN",
                                                    'date' => $datetime,
                                                    'description' => "Sign in to Admin account."];
                                $database->getReference($audit_table)->push($audit_details);
        
                                $_SESSION['status'] = "Sign In successfully.";
                                header('Location:http://localhost/Shuttle_Bus_System/admin/dashboard.php');
                                exit();
                            }else{
                                $audit_table = "audit_logs";
                                $audit_details = ['account_id' => $uid,
                                                    'action' => "UNAUTHORIZED ACCESS",
                                                    'date' => $datetime,
                                                    'description' => "Unauthorized person tries to access Admin account."];
                                $database->getReference($audit_table)->push($audit_details);
        
                                $_SESSION['failed'] = "UNAUTHORIZED ACCESS!!";
                                header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
                                exit();
                            }
                        }
                    }else{
                        $_SESSION['failed'] = 'Error: '.$e->getMessage();
                        header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
                        exit();
                    }
                } catch (\Kreait\Firebase\Exception\Auth\FailedToVerifyToken $e) {
                    $_SESSION['failed'] = 'Error: '.$e->getMessage();
                    header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
                    exit();
                }
            } catch (Exception $e) {
                $_SESSION['failed'] = $e->getMessage(); 
                header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
                exit();
            }
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            $_SESSION['failed'] = "Invalid Email Address!";
            header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
            exit();
        }
    }

    if(isset($_POST['signout_admin'])){
        try {
            $audit_table = "audit_logs";
            $audit_details = ['account_id' => $_SESSION['verified_admin_uid'],
                                'action' => "ACCESS",
                                'date' => $datetime,
                                'description' => "Sign out to Admin account."];
            $database->getReference($audit_table)->push($audit_details);
            
            unset($_SESSION['verified_admin_uid']);
            unset($_SESSION['idTokenString']);

            $_SESSION['status'] = "Sign Out successfully";
            header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
            exit();
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Error Message: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
            exit();
        }
    }
?>