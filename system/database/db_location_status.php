<?php
    session_start();
    include('dbcon.php');

    date_default_timezone_set('Asia/Manila');
    $datetime = date('Y-m-d h:i:s a');

    if(isset($_POST['turn_on_loc'])){
        if (!empty($_POST['route_id']) && $_POST['route_id'] != 'Route') {
            if (!empty($_POST['bus_id']) && $_POST['bus_id'] != 'Bus') {
                try{
                    $route_id = $_POST['route_id'];
                    $bus_id = $_POST['bus_id'];
                    $employee_uid = $_POST['employee_uid'];
                    $arrived_at = "Will be available at any moment...";
                    $arrived_time = "loading";

                    $postData = ['route_id'=>$route_id,
                                'bus_id'=>$bus_id,
                                'employee_uid'=>$employee_uid,
                                'arrived_at' =>$arrived_at,
                                'arrived_time' =>$arrived_time];
        
                    $ref_table = "bus_location";
                    $bus_location_result = $database->getReference($ref_table)->push($postData);
                    $location_id = $bus_location_result->getKey();

                    $bus_table = 'bus/'.$bus_id.'/';
                    $bus_status = ['status' => 'Unavailable'];
                    $database->getReference($bus_table)->update($bus_status);

                    $round_trip = 0;
                    $trip_data = ['route_id'=>$route_id,
                                'bus_id'=>$bus_id,
                                'employee_uid'=>$employee_uid,
                                'trip_start'=>$datetime,
                                'trip_end'=>""];

                    $trip_logs = "trip_logs";
                    $trip_result = $database->getReference($trip_logs)->push($trip_data);
                    $trip_id = $trip_result->getKey();

                    $_SESSION['status'] = "Set Bus and Route successfully.";
                    $_SESSION['bus_location_id'] = $location_id;
                    $_SESSION['trip_id'] = $trip_id;
                    $_SESSION['bus_id'] = $bus_id;
                    header('Location:http://localhost/Shuttle_Bus_System/bus_driver/menu.php'); 
                    exit();
                }catch(\Throwable $th){
                    $_SESSION['failed'] = "Error Message: ".$th->getMessage();
                    header('Location:http://localhost/Shuttle_Bus_System/bus_driver/menu.php');
                    exit();
                }
                $_SESSION['failed'] = "Error Message: ".$th->getMessage();
                header('Location:http://localhost/Shuttle_Bus_System/bus_driver/menu.php');
                exit();
            } else {
                $_SESSION['failed'] = "Error Message: Please Choose a bus";
                header('Location:http://localhost/Shuttle_Bus_System/bus_driver/menu.php');
                exit();
            }            
        } else {
            $_SESSION['failed'] = "Error Message: Please Choose a route";
            header('Location:http://localhost/Shuttle_Bus_System/bus_driver/menu.php');
            exit();
        }
    }

    if(isset($_POST['turn_off_loc'])){
        try {
            $location_id = $_SESSION['bus_location_id'];
            $trip_id = $_SESSION['trip_id'];
            $bus_id = $_SESSION['bus_id'];

            $trip_data = ['trip_end'=>$datetime];
            $trip_table = 'trip_logs/'.$trip_id."/";
            $database->getReference($trip_table)->update($trip_data);

            $bus_table = 'bus/'.$bus_id.'/';
            $bus_status = ['status' => 'Available'];
            $database->getReference($bus_table)->update($bus_status);

            $ref_table = 'bus_location/'.$location_id;
            $database->getReference($ref_table)->remove();
            
            $_SESSION['status'] = "Sign off successfully";
            unset($_SESSION['bus_location_id']);
            header('Location:http://localhost/Shuttle_Bus_System/bus_driver/menu.php'); 
            exit();
        } catch (\Throwable $th) {
            $_SESSION['status'] = "Error Message: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/bus_driver/menu.php');
            exit();
        }
    }
?>