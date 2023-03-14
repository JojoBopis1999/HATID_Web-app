<?php 
    session_start();
    $tabName = "Email Verification";
    include '../bus_driver/includes/header.php';
    include '../bus_driver/includes/alert_failed.php';
    include '../bus_driver/includes/alert_success.php';
?>
    <div class="container">
        <div class="row my-5 py-5">
            
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-md-4 mx-auto">
                <div class="card rounded-0 my-5">
                    <div class="card-body">
                        <div class="h1 fw-bold my-4 text-center">RESET PASSWORD</div>
                        <form action="../system/database/db_reset_password.php" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">New Password</span>
                                <input type="password" name="new_password" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Confirm New Password</span>
                                <input type="password" name="confirm_password" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
                            </div>

                            <button class="btn btn-primary" name="reset_btn" type="Submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include '../bus_driver/includes/footer.php';?>