<?php
    session_start();
    $tabName = "Bus Location";
    include 'assets/includes/header.php';
    include 'assets/includes/rating_modal.php';
    include 'admin/assets/includes/alert_success.php';
    include 'admin/assets/includes/alert_failed.php';
?>

    <div class="container">
        <div class="d-flex justify-content-center">
            <img src="./attachments/route.png" alt="ROUTE LOGO">
        </div>
        <div class="card mb-5">
            <div class="row g-0">
                <div class="col">
                    <div class="card-body">
                        <div class="h1 fw-bold text-center">
                            <?php
                                include './system/database/dbcon.php';
                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    $ref_table = 'routes';
                                    $getRoute = $database->getReference($ref_table)->getChild($id)->getValue();
                                    if($getRoute > 0){
                                        echo $getRoute['route_name'];
                                    ?>
                        </div>
                        <?php
                            try {
                                $bus_available = "bus_location";
                                $getRoute = $database->getReference($bus_available)->getValue();
                                if($getRoute > 0){
                        ?>
                        <div class="card-title fw-semibold text-center">Bus en Route</div>
                                <?php
                                    foreach($getRoute as $key => $row){
                                        if($row['route_id'] == $id){
                                ?>
                                        <div class="card rounded-0 mb-3">
                                            <div class="row g-0">
                                                <div class="col-md-6">
                                                    <div class="card-body">
                                                        <?php
                                                            $bus_table = "bus";
                                                            $bus_detail = $database->getReference($bus_table)->getValue();
                                                            if ($bus_detail > 0) {
                                                                foreach($bus_detail as $bus_key => $bus_row){
                                                                    if($bus_key == $row['bus_id']){
                                                        ?>
                                                        <p class="card-text fw-semibold">Bus Model: <?= $bus_row['bus_model']; ?></p>
                                                        <p class="card-text fw-semibold">Bus License Plate: <?= $bus_row['license_plate']; ?></p>
                                                        <?php    
                                                                    }
                                                                }
                                                            }else{
                                                        ?>
                                                                <p>Can't display buses on route right now.</p>
                                                        <?php
                                                            }
                                                            $users = $auth->listUsers();
                                                            foreach($users as $user) {
                                                                if($user->uid == $row['employee_uid']){
                                                        ?>
                                                        <p class="card-text fw-semibold">Bus Driver: <?= $user->displayName ?></p>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="card-body">
                                                        <p class="card-text">Designated Stops</p>
                                                            <ul class="list-group rounded-0"  id="bus-stops">
                                                                <?php
                                                                    $bus_stop_table = "bus_stop";
                                                                    try{
                                                                        $fetch_bus_stops = $database->getReference($bus_stop_table)->orderByChild("stop_order")->startAt(0)->getValue();
                                                                        if($fetch_bus_stops > 0){
                                                                            foreach($fetch_bus_stops as $bus_key => $bus_row){
                                                                                if($bus_row['route_id'] == $row['route_id']){
                                                                                    ?>
                                                                                        <li class="list-group-item border border-0"><i class="bi bi-circle-fill" 
                                                                                        <?php $stopName = str_replace("Arrived to: ","",$row['arrived_at']);  
                                                                                        if($stopName == $bus_row['stop_name'])
                                                                                        { ?> style="color:green" <?php } ?>>
                                                                                        </i> <?= $bus_row['stop_name'] ?> </br> <?php if($stopName == $bus_row['stop_name']){ echo $row['arrived_time']; } ?>
                                                                                        </li>
                                                                                    <?php

                                                                                }
                                                                            }
                                                                        }
                                                                    }catch(\Throwable $th){
                                                                        echo "Error: ".$th->getMessage();
                                                                    }
                                                                ?>
                                                            </ul>
                                                            <div class="d-flex justify-content-between">
                                                                <button type="button" class="btn btn-primary" id="refresh-button"><i class="bi bi-arrow-clockwise"></i></button>

                                                                <button type="button" class="btn btn-primary" 
                                                                data-bs-toggle="modal" data-bs-target="#rating_modal"
                                                                data-bs-whatever="<?= $row['route_id']; ?>,<?= $row['bus_id']; ?>,<?= $row['employee_uid']; ?>">
                                                                How's my driving?</button>  
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                        $(document).ready(function() {
                                            $('#refresh-button').click(function() {
                                            $('#bus-stops').load(location.href + ' #bus-stops');
                                            });
                                        });
                                        </script>

                                        <script>
                                            var exampleModal = document.getElementById('rating_modal')
                                            exampleModal.addEventListener('show.bs.modal', function (event) {
                                                // Button that triggered the modal
                                                var button = event.relatedTarget

                                                var recipient = button.getAttribute('data-bs-whatever')

                                                var routes = recipient.split(",");
                                                
                                                let route_id = routes[0];
                                                let bus_id = routes[1];
                                                let employee_uid = routes[2];

                                                document.getElementById("routeID").value = route_id;
                                                document.getElementById("busID").value = bus_id;
                                                document.getElementById("empID").value = employee_uid;
                                            })
                                        </script>

                            <?php
                                        }
                                    }
                                }else{
                            ?>
                                        <div class="card-title fw-semibold text-center">
                                            There are no Buses on route at this moment.
                                        </div>
                                    <?php
                                }
                            } catch (\Throwable $th) {
                                ?>
                                    <p class="lead text-center">An error occur, please try again later :(</p>
                                <?php
                            }
                        ?>
                    </div>                     
                </div>
            </div>
        </div>
    </div>
                <?php
                        }else{
                            echo 'No record found';
                        }
                    }else{
                        echo 'Error';
                    }
                ?>
<?php
    include 'assets/includes/footer.php';
?>