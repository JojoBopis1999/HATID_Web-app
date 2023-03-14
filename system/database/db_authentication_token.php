<?php
    session_start();
    include('dbcon.php');
    date_default_timezone_set('Asia/Manila');
    $datetime = date('Y/m/d h:i:s a');
    try {
        if(isset($_SESSION['verified_admin_uid'])){
            $uid = $_SESSION['verified_admin_uid'];
            $idTokenString = $_SESSION['idTokenString'];
            try {
                $verifiedIdToken = $auth->verifyIdToken($idTokenString, $checkIfRevoked = true);
                //$verifiedIdToken = $auth->verifyIdToken($idTokenString);
                //the token is still good
            } catch (Kreait\Firebase\Exception\Auth\FailedToVerifyToken $e) {
                //the token id is expired after one hour
                $audit_table = "audit_logs";
                $audit_details = ['account_id' => $_SESSION['verified_admin_uid'],
                                'action' => "ACCESS",
                                'date' => $datetime,
                                'description' => "Expired token, force sign out to Admin account."];
                $database->getReference($audit_table)->push($audit_details);

                unset($_SESSION['verified_admin_uid']);
                unset($_SESSION['idTokenString']);
    
                $auth->revokeRefreshTokens($uid);
    
                $_SESSION['failed'] = "Session/Token ID has expired, please sign in again.";
                header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
                exit();
            }
        }
    } catch (\Throwable $th) {
        $_SESSION['failed'] = "Error Message: ".$th->getMessage();
        header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
        exit();
    }
?>