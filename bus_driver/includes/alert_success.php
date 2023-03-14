<?php
if(isset($_SESSION['status'])){
    echo "<div class='alert alert-success alert-dismissible'>
            <button type='button' data-bs-dismiss='alert' class='btn-close' aria-label='Close'></button>"
            .$_SESSION['status']."</div>";
    unset($_SESSION['status']);
}

?>