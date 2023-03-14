<?php
    session_start();
    include('dbcon.php');

    date_default_timezone_set('Asia/Manila');
    $datetime = date('Y-m-d h:i:s a');
    $route_id = "";
    if(isset($_POST['rating_btn'])){
        $route_id = $_POST['route_id'];
        $bus_id = $_POST['bus_id'];
        $employee_uid = $_POST['employee_uid'];
        $efficiency = $_POST['efficiency'];

        try {
            $submit_rating = [  'route_id' => $route_id,
                                'bus_id' => $bus_id,
                                'employee_uid' => $employee_uid,
                                'efficiency' => $efficiency,
                                'datetime' => $datetime ];
            $rating_table = "employee_rating";
            $database->getReference($rating_table)->push($submit_rating);

            $_SESSION['status'] = "Your rating has been send.";
            header('Location:http://localhost/Shuttle_Bus_System/bus_location.php?id='.$route_id);

        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Your rating can't be send. | Error Message".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/index.php');
            exit();
        }
    }
?>