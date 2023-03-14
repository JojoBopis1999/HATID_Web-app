<?php
    session_start();
    include('dbcon.php');

    if(isset($_POST['new_bus'])){
        $bus_model = $_POST['bus_model'];
        $license_plate = $_POST['license_plate'];
        $condition = $_POST['status'];
        $status = 'available';

        $postData = ['bus_model'=>$bus_model,
                    'license_plate'=>$license_plate,
                    'condition'=>$condition,
                    'status'=>$status];

        $ref_table = "bus";

        $postRef_result = $database->getReference($ref_table)->push($postData);

        if($postRef_result){
            $_SESSION['status'] = "Bus added successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/bus.php');
        }else{
            $_SESSION['failed'] = "Bus not added.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/bus.php');
        }
    }

    if(isset($_POST['edit_bus'])){
        $bus_id = $_POST['bus_id'];
        $bus_model = $_POST['bus_model'];
        $license_plate = $_POST['license_plate'];
        $condition = $_POST['status'];
        $status = $_POST['bus_status'];

        $update_bus = [ 'bus_model' => $bus_model,
                        'license_plate' => $license_plate,
                        'condition' => $condition,
                        'status'=>$status];

        $ref_table = 'bus/'.$bus_id;
        $update_bus_result = $database->getReference($ref_table)->update($update_bus);

        if($update_bus_result){
            $_SESSION['status'] = "Bus updated successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/bus.php');
        }else{
            $_SESSION['failed'] = "Bus not updated.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/bus.php');
        }
    }

        //Deleting a bus
        if(isset($_POST['remove_bus'])){
            $bus_id = $_POST['bus_id'];
            
            $ref_table = 'bus/'.$bus_id;
            $remove_bus_result = $database->getReference($ref_table)->remove();
    
            if($remove_bus_result){
                $_SESSION['status'] = "Bus remove successfully.";
                header('Location:http://localhost/Shuttle_Bus_System/admin/bus.php');
            }else{
                $_SESSION['failed'] = "Bus not removed.";
                header('Location:http://localhost/Shuttle_Bus_System/admin/bus.php');
            }
        }
?>