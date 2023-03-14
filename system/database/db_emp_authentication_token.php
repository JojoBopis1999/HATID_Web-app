<?php
    session_start();
    include('dbcon.php');
    try {
        if(isset($_SESSION['verified_employee_uid'])){
            $employeeID = $_SESSION['verified_employee_uid'];
            $idTokenString = $_SESSION['idTokenString'];
            try {
                $verifiedIdToken = $auth->verifyIdToken($idTokenString, $checkIfRevoked = true);
                //$verifiedIdToken = $auth->verifyIdToken($idTokenString);
                //the token is still good
            } catch (Kreait\Firebase\Exception\Auth\FailedToVerifyToken $e) {
                //the token id is expired after one hour
                unset($_SESSION['verified_employee_uid']);
                $auth->revokeRefreshTokens($uid);
    
                $_SESSION['failed'] = "Session/Token ID has expired, please sign in again.";
                header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
                exit();
            }
        }
    } catch (\Throwable $th) {
        $_SESSION['failed'] = "Error Message: ".$th->getMessage();
        header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
        exit();
    }
?>