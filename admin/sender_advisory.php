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
    $tabName = "Board Advisory";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include '../admin/assets/includes/navbar.php';
    include '../admin/assets/includes/alert_success.php';
    include '../admin/assets/includes/alert_failed.php';
    include '../admin/assets/includes/new_advisory.php';
    include '../admin/assets/includes/edit_advisory.php';
    include '../admin/assets/includes/remove_advisory.php';?>

    <div class="container">
        <div class="row d-flex d-flex-column justify-content-evenly mt-2">
            <div class="col flex-fill bg-dark p-3 card o-hidden rounded-0 shadow-lg mx-2">
                <div class="d-flex justify-content-between">
                    <p class="lead text-light fw-bolder me-2 my-2">Announcements</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_advisory">
                    <i class="bi bi-plus-lg"></i>  Create announcements
                    </button>
                </div>
                
                <?php
                    include '../system/database/dbcon.php';
                    include '../admin/assets/includes/edit_route.php';
                    $ref_table = "board_advisory";

                    $fetch_data = $database->getReference($ref_table)->getValue();
                    if($fetch_data > 0){
                        foreach($fetch_data as $key => $row){   
                ?>
                    <div class="card rounded-0 my-2 bg-dark" style="max-width: 100%;">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <p class="fw-semibold text-light">Announcement ID <?= $key ?> Created at <?= $row['timestamp'] ?></p>
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-secondary me-1" data-bs-toggle="modal" data-bs-target="#edit_advisory" data-bs-whatever="<?= $key ?>|<?= $row['subject'] ?>|<?= $row['message']; ?>">
                                        <i class="bi bi-pencil"></i></button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#remove_advisory" data-bs-whatever="<?= $key ?>">
                                        <i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold text-light"><?= $row['subject'] ?></h5>
                            <p class="card-text text-light"><?= $row['message'] ?></p>
                        </div>
                    </div> 
                <?php
                        }
                    }else{
                ?>
                    <div class="card rounded-0 my-2" style="max-width: 100%;">
                        <div class="card-header">
                                <p class="fw-semibold">There are no posted announcements right now</p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">You can post an announcements by clicking the "Create Announcements" button on the to right corner.</p>
                        </div>
                    </div> 
                <?php
                    }
                ?>

                <script>
                    var exampleModal = document.getElementById('edit_advisory')
                    exampleModal.addEventListener('show.bs.modal', function (event) {
                        // Button that triggered the modal
                        var button = event.relatedTarget

                        var recipient = button.getAttribute('data-bs-whatever')

                        var adv = recipient.split("|");
                        
                        let adv_id = adv[0];
                        let subject = adv[1];
                        let message = adv[2].split("<br />");

                        //Announcement ID
                        document.getElementById("adv_ID").value = adv_id;

                        //Subject
                        var modalBodyInput = exampleModal.querySelector('.subject-form')
                        modalBodyInput.value = subject;

                        //Message
                        var modalBodyInput = exampleModal.querySelector('.message_advisory')
                        modalBodyInput.value = message;
                        
                    })

                    var removeModal = document.getElementById('remove_advisory')
                    removeModal.addEventListener('show.bs.modal', function (event) {

                        var button = event.relatedTarget

                        var recipient = button.getAttribute('data-bs-whatever')

                        document.getElementById("adv_Id").value = recipient;

                    })
                </script>
            </div>
        </div>
    </div>
<?php include '../admin/assets/includes/footer.php'; }?>