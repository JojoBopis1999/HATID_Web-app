<?php
    session_start();
    include('dbcon.php');

    //Adding new route
    if(isset($_POST['new_bus_route'])){
        try {
            $route_name = $_POST['route_name'];
            $postData = ['route_name'=>$route_name];
            $ref_table = "routes";
            $postRef_result = $database->getReference($ref_table)->push($postData);

            if($postRef_result){
                $_SESSION['status'] = "Route added successfully.";
                header('Location:http://localhost/Shuttle_Bus_System/admin/routes.php');
            }else{
                $_SESSION['failed'] = "Route not added.";
                header('Location:http://localhost/Shuttle_Bus_System/admin/routes.php');
            }
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Error: ".$th->getMessage();
                header('Location:http://localhost/Shuttle_Bus_System/admin/routes.php');
        }
    }

    //Adding new stop
    if(isset($_POST['new_bus_Stop'])){
        $stop_name = $_POST['stop_name'];
        $route_id = $_POST['route_ID'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $stop_order = $_POST['stop_order'];

        $postData =['stop_name'=>$stop_name,
                    'route_id'=>$route_id,
                    'latitude'=>$latitude,
                    'longitude'=>$longitude];

        $ref_table = "bus_stop";

        $postRef_result = $database->getReference($ref_table)->push($postData);

        if($postRef_result){
            $_SESSION['status'] = "Stop added successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/bus_stops.php');
        }else{
            $_SESSION['failed'] = "Stop not added.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/bus_stops.php');
        }
    }

    //Editing route name
    if(isset($_POST['edit_bus_route'])){
        $route_id = $_POST['route_id'];
        $route_name = $_POST['route_name'];
        $update_route = [ 'route_name' => $route_name];

        $ref_table = 'routes/'.$route_id;
        $update_route_result = $database->getReference($ref_table)->update($update_route);

        if($update_route_result){
            $_SESSION['status'] = "Route updated successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/routes.php');
        }else{
            $_SESSION['failed'] = "Route not updated.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/routes.php');
        }
    }
    
    //Deleting a route
    if(isset($_POST['remove_routes'])){
        $route_id = $_POST['route_id'];
        $ref_table = 'routes/'.$route_id;
        $remove_route_result = $database->getReference($ref_table)->remove();

        if($remove_route_result){
            $_SESSION['status'] = "Route remove successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/routes.php');
        }else{
            $_SESSION['failed'] = "Route not removed.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/routes.php');
        }
    }

    //Editing a bus stop
    if(isset($_POST['edit_stop'])){
        $stop_id = $_POST['stop_id'];
        $stop_name = $_POST['stop_name'];
        $route_id = $_POST['route_ID'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $stop_order = $_POST['stop_order'];

        $update_stop = [ 'stop_name' => $stop_name,
                        'route_id' => $route_id,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'stop_order' => $stop_order];

        $ref_table = 'bus_stop/'.$stop_id;
        $update_stop_result = $database->getReference($ref_table)->update($update_stop);

        if($update_stop_result){
            $_SESSION['status'] = "Stop updated successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/bus_stops.php');
        }else{
            $_SESSION['failed'] = "Stop not updated.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/bus_stops.php');
        }
    }

    //Deleting a bus stop
    if(isset($_POST['remove_stops'])){
        $stop_id = $_POST['stop_id'];

        $ref_table = 'bus_stop/'.$stop_id;
        $remove_stop_result = $database->getReference($ref_table)->remove();

        if($remove_stop_result){
            $_SESSION['status'] = "Stop remove successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/bus_stops.php');
        }else{
            $_SESSION['failed'] = "Stop not removed.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/bus_stops.php');
        }
    }
?>