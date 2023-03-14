<?php
if(isset($_SESSION['failed'])){
    echo "<div class='alert alert-danger alert-dismissible'>
            <button type='button' data-bs-dismiss='alert' class='btn-close' aria-label='Close'></button>"
            .$_SESSION['failed']."</div>";
    unset($_SESSION['failed']);
}
?>