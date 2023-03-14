<?php 

    session_start();
    $uid = $_SESSION['verified_admin_uid'];
    $idTokenString = $_SESSION['idTokenString'];
    if(!isset($uid) && !isset($idTokenString)){
        $_SESSION['failed'] = "UNAUTHORIZED ACCESS!!";
        header('Location:http://localhost/Shuttle_Bus_System/admin/index.php');
        exit();
    }else{
    $tabName = "Employees";
    $tabLocation = $tabName;
    include '../admin/assets/includes/header.php';
    include_once '../admin/assets/includes/navbar.php';
    include_once '../admin/assets/includes/add_new_emp.php';
    include_once '../admin/assets/includes/edit_employee_data.php';
    include_once '../admin/assets/includes/remove_employee_data.php';
    include_once '../admin/assets/includes/reset_password.php';
    include_once '../admin/assets/includes/alert_success.php';
    include_once '../admin/assets/includes/alert_failed.php';
    include_once '../admin/assets/includes/enable_disable_employee.php'?>

    <div class="container">
        <div class="row">
            <!--d-flex d-flex-column mt-1 justify-content-evenly-->
            <div class="col flex-fill bg-dark p-3 card o-hidden border-0 rounded-0 shadow-lg mx-2">
                    <!--Search Box-->
                <div class="d-flex justify-content-between">
                    <p class="lead fw-bolder me-2 my-2 text-light">Employees List</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new_emp_modal">
                    <i class="bi bi-person-plus"></i>  New Employee</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-dark mt-2">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact No.</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            include '../system/database/dbcon.php';
                            $users = $auth->listUsers();
                            foreach($users as $user) {
                                $roles_table = "account_roles";
                                $fetch_roles = $database->getReference($roles_table)->getValue();
                                if($fetch_roles > 0){
                                    foreach($fetch_roles as $key => $row){
                                        if($row['account_id'] == $user->uid && $row['roles'] == "employee"){
                        ?>
                            <!--This will hide admin's email and uid info-->
                            <tr>  
                                <input type="hidden" name="employee_uid" value="<?= $user->uid ?>">
                                <td><?= ($user->disabled == "false") ? $status =  '<i class="bi bi-lock-fill d-flex justify-content-center mt-2"></i>'  : $status = '<i class="bi bi-unlock-fill d-flex justify-content-center mt-2"></i>'; ?></td>
                                <td><?= $user->displayName ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->phoneNumber ?></td>
                                <td>
                                    <button class="btn btn-secondary mx-1" type="submit"
                                    data-bs-toggle="modal" data-bs-target="#edit_employee"
                                    data-bs-whatever="<?= $user->uid ?>,<?= $user->displayName ?>,<?= $user->email ?>,<?= $user->phoneNumber ?>">
                                    <i class="bi bi-pencil"></i></button>

                                    <button class="btn btn-danger mx-1" type="submit"
                                    data-bs-toggle="modal" data-bs-target="#removeModal" data-bs-whatever="<?= $user->uid ?>">
                                    <i class="bi bi-trash"></i></button>

                                    <button class="btn btn-secondary mx-1" type="submit"
                                    data-bs-toggle="modal" data-bs-target="#reset_password" data-bs-whatever="<?= $user->uid ?>">
                                    Reset Password</button>

                                    <button class="btn btn-warning" type="submit" 
                                    data-bs-toggle="modal" data-bs-target="#disable_enable" data-bs-whatever="<?= $user->uid ?>,<?= ($user->disabled == "false") ? $status =  'Enable'  : $status = 'Disable'; ?>">
                                    <?= ($user->disabled == "false") ? $status =  'Enable Account'  : $status = 'Disable Account'; ?></button>
                                </td>
                            </tr>

                            <script>
                                //these will transfer data to modals for editing & removing 
                                var exampleModal = document.getElementById('edit_employee')
                                exampleModal.addEventListener('show.bs.modal', function (event) {
                                    var button = event.relatedTarget
                                    var recipient = button.getAttribute('data-bs-whatever')

                                    var employee = recipient.split(",");
                                    var employee_id = employee[0];
                                    var employee_first_name = employee[1];
                                    var employee_email_address = employee[2];
                                    var employee_mobile_number = employee[3];
                                    var employee_status = employee[4];

                                    document.getElementById("employee_Id").value = employee_id;

                                    var emp_first_name = exampleModal.querySelector('.first-name')
                                    emp_first_name.value = employee_first_name

                                    var emp_email_address = exampleModal.querySelector('.email-add')
                                    emp_email_address.value = employee_email_address

                                    var emp_contact_no = exampleModal.querySelector('.contact-no')
                                    emp_contact_no.value = employee_mobile_number
                                })

                                var removeStop = document.getElementById('removeModal')
                                removeStop.addEventListener('show.bs.modal', function (event) {
                                    var button = event.relatedTarget
                                    var recipient = button.getAttribute('data-bs-whatever')
                                    document.getElementById("employeeID").value = recipient;
                                })

                                var resetButton = document.getElementById('reset_password')
                                resetButton.addEventListener('show.bs.modal', function (event) {
                                    var button = event.relatedTarget
                                    var recipient = button.getAttribute('data-bs-whatever')
                                    document.getElementById("emp_ID").value = recipient;
                                })

                                var disable_enable = document.getElementById('disable_enable')
                                disable_enable.addEventListener('show.bs.modal', function (event) {
                                    var button = event.relatedTarget
                                    var recipient = button.getAttribute('data-bs-whatever')

                                    var employee = recipient.split(",");
                                    var employee_id = employee[0];
                                    var employee_status = employee[1];

                                    document.getElementById("employee_ID").value = employee_id;
                                    document.getElementById("employeeStatus").value = employee_status;
                                })
                            </script>
                        <?php
                                        }
                                    }
                                }else{
                                    ?>
                                        <tr>
                                            <td>No Accounts Found.</td>
                                        </tr>
                                    <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
        </div>
    </div>
<?php include '../admin/assets/includes/footer.php'; 
    }?>