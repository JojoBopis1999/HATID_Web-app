<?php 
    session_start();
    if(isset($_SESSION['verified_admin_uid']) && isset($_SESSION['idTokenString'])){
        $_SESSION['status'] = "You're already signed in.";
        header('Location:http://localhost/Shuttle_Bus_System/admin/dashboard.php');
        exit();
    }else{
    $tabName = "Administrator";
    include 'assets/includes/header.php';
    include 'assets/includes/alert_success.php';
    include 'assets/includes/alert_failed.php'; 
?>
    <div class="container">
        <div class="row">
            
        </div>
        <div class="row-4 d-flex align-items-center my-5">     
            <div class="col-md-4 mx-auto">
                <div class="card rounded-0">
                    <div class="mt-5 px-3">
                        <img src="../attachments/hatid-low-resolution-logo-black-on-transparent-background.png" width="325rem" height="72rem" alt="HATID LOGO">
                    </div>
                    <div class="card-body">
                        <form action="../system/database/db_admin_siginin.php" method="post">
                            <p class="fs-2 text-center text-dark mt-5">Administrator ONLY</p>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control border-dark" id="exampleFormControlInput1" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="exampleInputPassword1"></i> Password</label>
                                <input type="password" name="password" class="form-control border-dark" id="exampleInputPassword1" required>
                            </div>

                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" name="signin_admin" class="btn btn-outline-dark" type="button">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'assets/includes/footer.php'; }?>