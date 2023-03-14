<?php
if(isset($_SESSION['status'])){
    echo "<div class='container'>
            <div class='alert alert-success alert-dismissible'>
            <button type='button' data-bs-dismiss='alert' class='btn-close' aria-label='Close'></button>"
            .$_SESSION['status']."</div></div>";
    unset($_SESSION['status']);
}
?>