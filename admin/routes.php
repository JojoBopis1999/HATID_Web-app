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
    $tabName = "Routes";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include '../admin/assets/includes/navbar.php';
    include '../admin/assets/includes/route_deletion.php';
    include '../admin/assets/includes/new_route.php';
    include '../admin/assets/includes/alert_success.php';
    include '../admin/assets/includes/alert_failed.php';
?>
    
    <div class="container">
        <div class="row d-flex d-flex-column mx-2 justify-content-evenly">
            <div class="flex-fill bg-dark p-3 card o-hidden border-0 rounded-0 shadow-lg">
                <div class="d-flex justify-content-between">
                    <p class="text-light h3 fw-bolder me-2 my-2">Routes</p>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_route">
                        <i class="bi bi-plus-lg"></i>  New Route</button>
                    </div>
                </div>
                
                <table class="table mt-2 table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Route ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                                <!--Displaying List of Routes-->
                                <?php 
                                    include '../system/database/dbcon.php';
                                    include '../admin/assets/includes/edit_route.php';
                                    $ref_table = "routes";

                                    $fetch_data = $database->getReference($ref_table)->getValue();
                                    if($fetch_data > 0){
                                        foreach($fetch_data as $key => $row){   
                                ?>
                                    <tr>
                                        <th><?= $key ?></th>
                                        <td><?= $row['route_name']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-secondary mx-1 edit" data-bs-toggle="modal" data-bs-target="#edit_route" data-bs-whatever="<?= $key ?>,<?= $row['route_name']; ?>"><i class="bi bi-pencil"></i></button>
                                            <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#remove_route" data-bs-whatever="<?php echo $key; ?>"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
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
                                <script>
                                    var exampleModal = document.getElementById('edit_route')
                                    exampleModal.addEventListener('show.bs.modal', function (event) {
                                        // Button that triggered the modal
                                        var button = event.relatedTarget

                                        var recipient = button.getAttribute('data-bs-whatever')

                                        var routes = recipient.split(",");
                                        
                                        let route_id = routes[0];
                                        let route_name = routes[1];

                                        document.getElementById("route-Id").value = route_id;
                                        var modalBodyInput = exampleModal.querySelector('.route-name')

                                        modalBodyInput.value = route_name
                                    })

                                    var removeModal = document.getElementById('remove_route')
                                    removeModal.addEventListener('show.bs.modal', function (event) {

                                        var button = event.relatedTarget

                                        var recipient = button.getAttribute('data-bs-whatever')

                                        document.getElementById("route_Id").value = recipient;

                                    })
                                </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



<?php include '../admin/assets/includes/footer.php'; 
    }?>