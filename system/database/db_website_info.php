<?php
    session_start();
    include('dbcon.php');

    if(isset($_POST['update_contactno'])){
        try {
            $contact_no = $_POST['contact_no'];

            $update_contact_no = ['contact_no' => $contact_no];
            $ref_table = "website_info/contact/";
            $database->getReference($ref_table)->update($update_contact_no);

            $_SESSION['status'] = "Updated Contact Successfully!";
            header('Location:http://localhost/Shuttle_Bus_System/admin/website_information.php');
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Error: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/website_information.php');
        }
    }

    if(isset($_POST['update_address'])){
        try {
            $address = $_POST['address'];

            $update_address = ['address' => $address];
            $ref_table = "website_info/address/";
            $database->getReference($ref_table)->update($update_address);

            $_SESSION['status'] = "Updated Address Successfully!";
            header('Location:http://localhost/Shuttle_Bus_System/admin/website_information.php');
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Error: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/website_information.php');
        }
    }

    if(isset($_POST['update_email'])){
        try {
            $email = $_POST['email'];

            $updateEmail = ['email' => $email];
            $ref_table = "website_info/email/";
            $database->getReference($ref_table)->update($updateEmail);

            $_SESSION['status'] = "Updated Email Successfully!";
            header('Location:http://localhost/Shuttle_Bus_System/admin/website_information.php');
        } catch (\Throwable $th) {
            $_SESSION['failed'] = "Error: ".$th->getMessage();
            header('Location:http://localhost/Shuttle_Bus_System/admin/website_information.php');
        }
    }
?>