<?php
    session_start();
    include('dbcon.php');

    if(isset($_POST['new_employee'])){
        $first_last_name = $_POST['first_last_name'];
        $mobile_number = $_POST['mobile_number'];
        $email_address = $_POST['email_address'];
        $user_password = $_POST['user_password'];

        try {
            $registerUser = ['email'=>$email_address,
                        'emailVerified'=> false,
                        'displayName'=>$first_last_name,
                        'phoneNumber'=> $mobile_number,
                        'password'=>$user_password,
                        'disabled'=>false,];
        
            $registerResult = $auth->createUser($registerUser);
            $emp_uid = $registerResult->uid;

            $roles_table = "account_roles";
            $role_details = [ 'account_id'=>$emp_uid,
                                'roles'=>"employee"];
            $set_roles = $database->getReference($roles_table)->push($role_details);

            $_SESSION['status'] = "Employee registered successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');

        } catch (\Kreait\Firebase\Exception\Auth\EmailExists $th) {
            $_SESSION['failed'] = "ERROR MESSAGE: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        }
        catch (\Kreait\Firebase\Exception\Auth\PhoneNumberExists $th) {
            $_SESSION['failed'] = "ERROR MESSAGE: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        }
        catch (\Kreait\Firebase\Exception\Auth\WeakPassword $th) {
            $_SESSION['failed'] = "ERROR MESSAGE: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        }
        catch (\Exception $th) {
            $_SESSION['failed'] = "ERROR MESSAGE: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        }
        
    }

    if(isset($_POST['edit_employee'])){
        $employee_id = $_POST['employee_id'];
        $first_name = $_POST['first_last_name'];
        $mobile_number = $_POST['mobile_number'];
        $email_address = $_POST['email_address'];
        try {
            $update_employee = ['displayName'=>$first_name,
                                'phoneNumber'=>$mobile_number,    
                                'email'=>$email_address,];

            $update_employee_result = $auth->updateUser($employee_id, $update_employee);

        
            $_SESSION['status'] = "Employee's data updated successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        
        } catch (\Kreait\Firebase\Exception\Auth\EmailExists $th) {
            $_SESSION['failed'] = "ERROR MESSAGE: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        }
        catch (\Kreait\Firebase\Exception\Auth\PhoneNumberExists $th) {
            $_SESSION['failed'] = "ERROR MESSAGE: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        }
        catch (\Kreait\Firebase\Exception\Auth\WeakPassword $th) {
            $_SESSION['failed'] = "ERROR MESSAGE: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        }
        catch (\Exception $th) {
            $_SESSION['failed'] = "ERROR MESSAGE: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        }
    }

    //Deleting an employee data
    if(isset($_POST['remove_employee'])){
        $employee_id = $_POST['employee_id'];

        try {
            $auth->deleteUser($employee_id);
            $_SESSION['status'] = "Employee's data remove successfully.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "There's no Employee found in data.";
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
        }
    }

    if(isset($_POST['enable_disable_employee'])){
        $employee_id = $_POST['employee_id'];
        $employee_status = $_POST['employee_status'];

        try{
            if($employee_status == 'Disable'){
                $account_status = $auth->disableUser($employee_id);
                $msg = "disabled.";
            }else{
                $account_status = $auth->enableUser($employee_id);
                $msg = "enabled.";
            }

            $_SESSION['status'] = "Employee's Account has been ".$msg;
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
            exit();
        }catch(\Exception $e){
            $_SESSION['failed'] = "ERROR MESSAGE: ".$e->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/employees.php');
            exit();
        }
    }
?>