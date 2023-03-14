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
    $tabName = "Website Information";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include '../admin/assets/includes/navbar.php';
    include '../admin/assets/includes/alert_success.php';
    include '../admin/assets/includes/alert_failed.php';?>

    <div class="container">
        <div class="card bg-dark rounded-0">
            <div class="card-header text-light">
                Contact Information
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-dark rounded-0">
                            <div class="card-header text-light">
                                Contact Number
                            </div>
                            <div class="card-body">
                                <form action="../system/database/db_website_info.php" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Contact Number</span>
                                        <input type="text" name="contact_no" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
                                    </div>

                                    <button type="submit" name="update_contactno" class="btn btn-primary">Update Contact Number</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-dark rounded-0">
                            <div class="card-header text-light">
                                Address 
                            </div>
                            <div class="card-body">
                                <form action="../system/database/db_website_info.php" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Address</span>
                                        <input type="text" name="address" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
                                    </div>

                                    <button type="submit" name="update_address" class="btn btn-primary">Update Address</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-dark rounded-0">
                            <div class="card-header text-light">
                                Email
                            </div>
                            <div class="card-body">
                            <form action="../system/database/db_website_info.php" method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Email</span>
                                        <input type="email" name="email" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
                                    </div>

                                    <button type="submit" name="update_email" class="btn btn-primary">Update Email</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include '../admin/assets/includes/footer.php'; }?>