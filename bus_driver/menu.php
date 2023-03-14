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
    $bus_location_id = $_SESSION['bus_location_id'] ?? "";
    $trip_id = $_SESSION['trip_id'] ?? "";
    $bus_id = $_SESSION['bus_id'] ?? "";
    json_encode($bus_location_id);
    $tabName = 'Menu';
    include '../bus_driver/includes/header.php';
    include '../bus_driver/includes/sidebar.php';
    include '../bus_driver/includes/turn_on_location.php';
    include '../bus_driver/includes/turn_off_location.php';
    include '../bus_driver/includes/alert_failed.php';
    include '../bus_driver/includes/alert_success.php';
?>
    <div class="container">
        <div class="card rounded-0 my-5">
            <h5 class="card-header">Location Status: 
                <button type="button" class="btn btn-primary" id="startTracking" <?php if ($bus_location_id == "") { echo "disabled"; } ?>>ON</button>
                <button class="btn btn-danger" type="button" id="stopTracking" <?php if ($bus_location_id == "") { echo "disabled"; } ?>>OFF</button>
            </h5>
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" data-bs-toggle="modal" data-bs-target="#turn_on_location" name="btnradio" id="btnradio1"
                         autocomplete="off" <?php if ($bus_location_id != "") { echo "disabled"; } ?>>
                        <label class="btn btn-outline-primary" for="btnradio1">Set Bus en Route</label>

                        <input type="radio" class="btn-check" data-bs-toggle="modal" data-bs-target="#turn_off_location" name="btnradio" id="btnradio2" 
                         autocomplete="off" <?php if ($bus_location_id == "") { echo "disabled"; } ?>>
                        <label class="btn btn-outline-danger" for="btnradio2">Sign Off</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="location_id" value="<?php echo $bus_location_id; ?>">
    <script type="module" src="../bus_driver/assets/js/bus_location.js"> </script>
<?php 
    include '../bus_driver/includes/footer.php';
    }
?>