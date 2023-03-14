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
    $tabName = "Stops";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include '../admin/assets/includes/navbar.php';
    include '../admin/assets/includes/bus_stops_deletion.php';
    include '../admin/assets/includes/edit_stop.php';
    include '../admin/assets/includes/new_bus_stop.php';
    include '../admin/assets/includes/remove_stop.php';
    include '../admin/assets/includes/alert_success.php';
    include '../admin/assets/includes/alert_failed.php';
    include '../admin/assets/includes/stop_location_modal.php';
?>

    <div class="container-fluid">
        <div class="bg-dark p-3 card o-hidden border-0 rounded-0 shadow-lg ms-2 mb-3">
            <div class="d-flex justify-content-between">
                <p class="h5 text-light fw-bolder me-2 my-2">Bus Stops</p>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_stop">
                    <i class="bi bi-plus-lg"></i>  New Stop</button>
                </div>
            </div>
            
            <table class="table mt-2 myTable table-dark">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">Route</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <!--Displaying Lists of Bus Stop-->
                    <?php include '../system/database/dbcon.php';
                        $ref_table = "bus_stop";
                        $fetch_data = $database->getReference($ref_table)->getValue();
                        if($fetch_data > 0){
                            foreach($fetch_data as $key => $row){
                    ?>
                    <tr>
                        <td><?= $row['stop_name']; ?></td>
                        <td><?= $row['latitude']; ?></td>
                        <td><?= $row['longitude']; ?></td>
                        <td><?php 
                                $reference_route = 'routes/'.$row['route_id'];
                                $reference_name = $database->getReference($reference_route)->getValue();
                                if($reference_name > 0){
                                    foreach($reference_name as $keyID => $name){
                                        echo $name;
                                    }
                                }else{
                                    echo 'Route Name not found.';
                                }
                            ?>
                        </td>
                        <td>
                            <button class="btn btn-success mx-1" type="submit" data-bs-toggle="modal" data-bs-target="#stop_location" data-bs-whatever="<?= $row['latitude']; ?>,<?= $row['longitude']; ?>"><i class="bi bi-geo-alt"></i></button>
                            <button class="btn btn-secondary mx-1" type="button" data-bs-toggle="modal" data-bs-target="#edit_stop" 
                            data-bs-whatever="<?= $key; ?>,<?= $row['stop_name']; ?>,<?= $row['latitude']; ?>,<?= $row['longitude']; ?>,<?= $row['route_id']; ?>,<?= $row['stop_order']; ?>"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-danger mx-1" type="button" data-bs-toggle="modal" data-bs-target="#remove_stop" data-bs-whatever="<?= $key; ?>"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                            <?php
                                    }
                                }else{
                            ?>
                                    <tr>
                                        <td colspan="6">No Records Found</td>
                                    </tr>
                            <?php
                                }
                            ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var exampleModal = document.getElementById('edit_stop')
        exampleModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-whatever')

            var stops = recipient.split(",");
            let stop_id = stops[0];
            let stop_name = stops[1];
            let latitude = stops[2];
            let longitude = stops[3];
            let route_name = stops[4];
            let stop_order = stops[5]
            // Update the modal's content.
            document.getElementById("stop-id").value = stop_id;

            var bus_stop = exampleModal.querySelector('.stop-name')
            bus_stop.value = stop_name
            var route_stop = exampleModal.querySelector('.route')
            route_stop.value = route_name
            var longitude_stop = exampleModal.querySelector('.longitude')
            longitude_stop.value = longitude
            var latitude_stop = exampleModal.querySelector('.latitude')
            latitude_stop.value = latitude
            var stopOrder = exampleModal.querySelector('.stop-order')
            stopOrder.value = stop_order
        })

        var removeStop = document.getElementById('remove_stop')
        removeStop.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-whatever')
            document.getElementById("stop_Id").value = recipient;
        })

        var mapModal = document.getElementById('stop_location')
        mapModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-whatever')

            var stops = recipient.split(",");
            let latitude = stops[0];
            let longitude = stops[1];

            let map_screen = document.getElementById("maps");
            let map_src = "https://www.google.com/maps/embed/v1/place?key=AIzaSyD7nX5Dtfv6jz8AyRUoaZhtcN5NsbWyraM&q=" + stops[0] + "," + stops[1];
            console.log(map_src);
            map_screen.src = map_src;
        })
    </script>
    
<?php
    include '../admin/assets/includes/footer.php';
    }?>