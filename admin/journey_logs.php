<?php 
    include '../system/database/db_authentication_token.php';
    //session_start();
    $uid = $_SESSION['verified_admin_uid'];
    $idTokenString = $_SESSION['idTokenString'];
    if(!isset($uid) && !isset($idTokenString)){
        $_SESSION['failed'] = "UNAUTHORIZED ACCESS!!";
        header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
        exit();
    }else{
    $tabName = "Journey Logs";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include '../admin/assets/includes/navbar.php';
    include '../admin/assets/includes/alert_success.php';
    include '../admin/assets/includes/alert_failed.php';
    include '../admin/assets/includes/print_journey_logs.php';?>

    <div class="container">
        <div class="row my-3">
            <div class="card rounded-0 bg-dark">
                <div class="card-body">
                    <div class="card-header text-center d-flex justify-content-between">
                        <h5 class="card-title pt-2 fw-bold text-light">Journey Logs</h5>
                        <button class="btn btn-primary" type="button" 
                        data-bs-toggle="modal" data-bs-target="#printExcel">Export to Excel</button>
                    </div>
                    
                    <table class="table table-dark">
                        <thead>
                            <th scope="col">Bus Driver: </th>
                            <th scope="col">Bus: </th>
                            <th scope="col">Route: </th>
                            <th scope="col">Trip Start: </th>
                            <th scope="col">Trip End: </th>
                        </thead>
                        <tbody>
                            <?php
                                include '../system/database/dbcon.php';
                                try {
                                    $ref_table = "trip_logs";
                                    $fetch_data = $database->getReference($ref_table)->getValue();
                                    if($fetch_data > 0){
                                        foreach($fetch_data as $key => $row){
                                            ?>
                                            <tr>
                                                <td><?php
                                                        $users = $auth->listUsers();
                                                        foreach($users as $user) {
                                                            if($user->uid ==  $row['employee_uid']){                                                        
                                                                echo $user->displayName;
                                                            }
                                                        }?>
                                                </td>
                                                <td><?php
                                                        $bus_table = "bus";
                                                        $bus_detail = $database->getReference($bus_table)->getValue();
                                                        if ($bus_detail > 0) {
                                                            foreach($bus_detail as $bus_key => $bus_row){
                                                                if($bus_key == $row['bus_id']){
                                                                    echo $bus_row['bus_model']."|".$bus_row['license_plate'];
                                                                }
                                                            }
                                                        }
                                                    ?></td>
                                                <td><?php
                                                        $route_table = "routes";
                                                        $route_detail = $database->getReference($route_table)->getValue();
                                                        if($route_detail > 0){
                                                            foreach ($route_detail as $route_key => $route_row) {
                                                                if($route_key == $row['route_id']){
                                                                    echo $route_row['route_name'];
                                                                }
                                                            }
                                                        }
                                                    ?></td>
                                                <td><?= $row['trip_start'] ?></td>
                                                <td><?= $row['trip_end'] ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                } catch (\Throwable $th) {
                                    ?>
                                    <td colspan="7"><?php echo 'Error Message: '.$th->getMessage(); ?></td>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
<?php include '../admin/assets/includes/footer.php'; }?>