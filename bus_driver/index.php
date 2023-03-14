<?php 
    session_start();
    $tabName = 'Sign In';
    include '../bus_driver/includes/header.php';
    include '../bus_driver/includes/alert_failed.php';
    include '../bus_driver/includes/alert_success.php';
?>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col my-5 py-5">
                <div class="card">
                    <h5 class="card-header text-center">HATID (Authorized Employees ONLY!)</h5>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="../attachments/hatid-low-resolution-logo-black-on-transparent-background.png" class="my-4" width="250rem" height="57rem" alt="HATID Logo">
                        </div>
                        <form action="../system/database/db_employee_signin.php" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                <div id="emailHelp" class="form-text text-danger">NEVER share your email address with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="signin_employee" class="btn btn-primary">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    include '../bus_driver/includes/footer.php';
?>