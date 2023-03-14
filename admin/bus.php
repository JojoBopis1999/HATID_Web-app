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
    $tabName = "Buses";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include '../admin/assets/includes/navbar.php';
    include '../admin/assets/includes/new_bus.php';
    include '../admin/assets/includes/edit_bus.php';
    include '../admin/assets/includes/alert_success.php';
    include '../admin/assets/includes/alert_failed.php';
    include '../admin/assets/includes/remove_bus.php';?>    

    <div class="container">
        <!-- Table for List of Buses -->
        <div class="row d-flex d-flex-column justify-content-evenly mt-2">
            <div class="col flex-fill bg-dark p-3 card o-hidden border-0 rounded-0 shadow-lg mx-2">
                    <!--Search Box-->
                <div class="d-flex justify-content-between">
                    <p class="lead text-light fw-bolder me-2 my-2">Bus List</p>
                    <!--<form action="#" class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit"><i class="bi bi-search"></i></button>
                    </form>-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_bus">
                    <i class="bi bi-plus-lg"></i>  New Bus
                    </button>
                </div>
                
                <table class="table table-dark mt-2">
                    <thead>
                        <tr>
                            <th scope="col">Bus ID</th>
                            <th scope="col">Bus Model</th>
                            <th scope="col">License Plate</th>
                            <th scope="col">Condition</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--Displaying List of Bus-->
                        <?php 
                                include '../system/database/dbcon.php';
                                $ref_table = "bus";
                                $fetch_data = $database->getReference($ref_table)->getValue();
                                if($fetch_data > 0){
                                    foreach($fetch_data as $key => $row){   ?>
                                        <tr>
                                            <th scope="row"><?= $key ?></th>
                                            <td><?= $row['bus_model']; ?></td>
                                            <td><?= $row['license_plate']; ?></td>
                                            <td><?= $row['condition']; ?></td>
                                            <td><?= $row['status']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-secondary mx-1" data-bs-toggle="modal" data-bs-target="#edit_bus"
                                                data-bs-whatever="<?= $key ?>,<?= $row['bus_model']; ?>,<?= $row['license_plate']; ?>,<?= $row['condition']; ?>,<?= $row['status']; ?>"><i class="bi bi-pencil"></i></button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#remove_bus" data-bs-whatever="<?= $key; ?>">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <script>
                                            var exampleModal = document.getElementById('edit_bus')
                                            exampleModal.addEventListener('show.bs.modal', function (event) {
                                                var button = event.relatedTarget
                                                var recipient = button.getAttribute('data-bs-whatever')
                                                var bus = recipient.split(",");
                                                
                                                let bus_id = bus[0];
                                                let bus_model = bus[1];
                                                let license_plate = bus[2];
                                                let condition = bus[3];
                                                let status = bus[4];

                                                document.getElementById("bus_Id").value = bus_id;
                                                var model_bus = exampleModal.querySelector('.bus-model')
                                                model_bus.value = bus_model
                                                var licensePlate = exampleModal.querySelector('.license-plate')
                                                licensePlate.value = license_plate
                                                var bus_condition = exampleModal.querySelector('.condition')
                                                bus_condition.value = condition
                                                var bus_status = exampleModal.querySelector('.status')
                                                bus_status.value = status;
                                            })

                                            var removeModal = document.getElementById('remove_bus')
                                            removeModal.addEventListener('show.bs.modal', function (event) {
                                                var button = event.relatedTarget
                                                var recipient = button.getAttribute('data-bs-whatever')
                                                document.getElementById("busID").value = recipient;
                                            })
                                        </script>
                                    <?php
                                        }
                                    }else{
                                    ?>
                                        <tr>
                                            <td colspan="3">No Records Found</td>
                                        </tr>

                                        <?php
                                    }
                                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include '../admin/assets/includes/footer.php'; 
    }?>