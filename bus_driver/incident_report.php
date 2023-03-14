<?php 
    include '../system/database/db_emp_authentication_token.php';
    //session_start();
    $employeeID = $_SESSION['verified_employee_uid'];   
    $idTokenString = $_SESSION['idTokenString'];
    if(!isset($employeeID) || !isset($idTokenString)){
        $_SESSION['failed'] = "UNAUTHORIZED ACCESS!!";
        header('Location:http://localhost/Shuttle_Bus_System/bus_driver/index.php');
        exit();
    }else{
    $tabName = "Incident Report Form";
    include '../bus_driver/includes/header.php';
    include '../bus_driver/includes/alert_failed.php';
    include '../bus_driver/includes/alert_success.php';
    include '../bus_driver/includes/sidebar.php';
?>
    <div class="container-fluid my-2">
        <div class="card rounded-0">
            <div class="card-body">
                <h5 class="card-title fw-semibold text-center">Incident Report Form</h5>
                <form action="../system/database/db_incident_report.php" method="post">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Date & Time of Incident</label>
                        <input type="datetime-local" name="datetime_incident" class="form-control" id="formGroupExampleInput" required>
                    </div>

                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Exact Location</label>
                        <input type="text" class="form-control" name="exact_location" id="formGroupExampleInput" required>
                    </div>

                    <p class="fw-semibold">Incident Details</p>

                    <div class="form-group mb-3">
                        <label for="my-select">Incident Priority</label>
                        <select id="my-select" name="incident_priority" class="form-control" name="status" required>
                            <option value="" disabled="" selected="">Select</option>
                            <option value="Urgent">Urgent</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="my-select">Incident Type</label>
                        <select id="my-select" name="incident_type" class="form-control" name="status" required>
                            <option value="" disabled="" selected="">Select</option>
                            <option value="Hazard">Hazard</option>
                            <option value="Near-Miss">Near-Miss</option>
                            <option value="Slip &amp; Fall">Slip &amp; Fall</option>
                            <option value="Accident">Accident</option>
                            <option value="Injury">Injury</option>
                            <option value="Theft">Theft</option>
                            <option value="Fire">Fire</option>
                            <option value="Property Damage">Property Damage</option>
                            <option value="Fatality">Fatality </option>
                            <option value="Illness">Illness</option>
                            <option value="Other">Other</option>
                            <option value="Reportable / Notifiable">Reportable / Notifiable</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">   
                        <label for="in_desc" class="form-label">Please describe the incident</label>     
                        <textarea class="form-control" name="incident_desc" placeholder="Type message here..." rows="5"  required></textarea>
                    </div>

                    <p class="fw-semibold">Medical Details</p>
                    
                    <div class="form-group mb-3">
                        <label class="form-label">Is immediate medical attention required?</label>   
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="medical_attentionYN" value="Yes" id="btnradio1" autocomplete="off" required>
                            <label class="btn btn-outline-danger" for="btnradio1">Yes</label>
                        
                            <input type="radio" class="btn-check" name="medical_attentionYN" value="No" id="btnradio2" autocomplete="off" required>
                            <label class="btn btn-outline-primary" for="btnradio2">No</label>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="my-select">What kind of medical attention was administered?</label>
                        <select id="my-select" name="med_administered" class="form-control" name="medical_attention" required>
                            <option value="" disabled="" selected="">Select</option>
                            <option value="First Aid">First Aid</option>
                            <option value="Doctor Consulted">Doctor Consulted</option>
                            <option value="Hospital">Hospital</option>
                            <option value="Ambulance">Ambulance</option>
                            <option value="Medical Attention Declined">Medical Attention Declined</option>
                            <option value="None">None</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <button class="btn btn-primary" type="submit" name="report_btn">Submit Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include '../bus_driver/includes/footer.php';
    }?>