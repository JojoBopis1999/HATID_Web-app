<?php
    session_start();
    $tabName = "Announcements";
    include 'assets/includes/header.php';
    include 'admin/assets/includes/alert_success.php';
    include 'admin/assets/includes/alert_failed.php';
?>

    <div class="d-flex justify-content-center my-2">
        <img src="attachments/announcement.png" style="width: 370px;" alt="Announcement LOGO">
    </div>
    <div class="container"> 
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php 
                    include 'system/database/dbcon.php';
                    $ref_table = "board_advisory";
                    $fetch_data = $database->getReference($ref_table)->getValue();
                    if($fetch_data > 0){
                        foreach($fetch_data as $key => $row){   
                ?>
                    <div class="card mb-3 rounded-0">
                        <img src="./attachments/advisory content.png" class="card-img-top" alt="HATID LOGO">
                        <div class="card-body "> 
                            <h5 class="fw-bold"><?= $row['subject']; ?></h5>
                            <p class="card-text"><?= $row['message']; ?></p>
                            <p class="card-text"><small><?= $row['timestamp']; ?></small></p>
                        </div>
                    </div>
                <?php
                        }
                    }else{
                ?>
                    <div class="card mb-3 rounded-0">
                        <div class="card-body "> 
                            <p class="card-text">There are no Announcements right now.</p>
                        </div>
                    </div
                <?php
                    }
                ?>
<?php   
    include 'assets/includes/footer.php';
?>