<?php
    session_start();
    include('dbcon.php');

    date_default_timezone_set('Asia/Manila');
    $datetime_submitted = date('Y-m-d h:i:s a');

    if(isset($_POST['report_btn'])){
        $datetime_incident = $_POST['datetime_incident'];
        $exact_location = $_POST['exact_location'];
        $incident_priority = $_POST['incident_priority'];
        $incident_type = $_POST['incident_type'];
        $incident_desc = nl2br($_POST['incident_desc']);
        $medical_attentionYN = $_POST['medical_attentionYN'];
        $med_administered = $_POST['med_administered'];

        try {
            $incident_details = [ 
                'datetime_incident' => $datetime_incident,
                'exact_location' => $exact_location,
                'incident_priority' => $incident_priority,
                'incident_type' => $incident_type,
                'incident_desc' => $incident_desc,
                'medical_attentionYN' => $medical_attentionYN,
                'med_administered' => $med_administered,
                'datetime_submitted'=> $datetime_submitted];

            $incident_log_table = "incident_logs";
            $database->getReference($incident_log_table)->push($incident_details);

            $_SESSION['status'] = "Incident report has been submitted.";
            header('Location:http://localhost/Shuttle_Bus_System/bus_driver/menu.php');
            exit();
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Incident report isn't submitted | Error Message".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/bus_driver/menu.php');
            exit();
        }
    }
?>