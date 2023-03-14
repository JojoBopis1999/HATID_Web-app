<?php
    session_start();
    $tabName = "Welcome!";
    include 'assets/includes/header.php';
?>
    <div class="container text-center">
        <div class="row">
            <div class="col-md-4"></div>

            <div class="col-md-4 mt-5 pt-5">
                    <div class="card c-opacity">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <img src="attachments/hatid-low-resolution-logo-black-on-transparent-background.png" class="img rounded mx-auto d-block" 
                                width="300px" height="60px" alt="Shuttle Bus System">
                            </div>
                        
                            <p class="h5 fw-semibold my-3 text-justify">
                                HATID or Handy Aviation Transport Information Display provides a real time tracker of bus location for your everyday commute.
                            </p>

                            <button class="btn btn-dark rounded-pill" style="width: 100px;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Routes
                            </button>
                            <ul class="dropdown-menu">
                                <?php 
                                include 'system/database/dbcon.php';
                                $ref_table = "routes";
                                $fetch_data = $database->getReference($ref_table)->getValue();
                                if($fetch_data > 0){
                                    foreach($fetch_data as $key => $row){   ?>
                                        <li><a class="dropdown-item fw-semibold" href="bus_location.php?id=<?php echo $key; ?>"><?= $row['route_name']; ?></a></li>
                                    <?php
                                        }
                                }else{
                                ?>
                                    <li>No Route Found</li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
            </div>

            <div class="col-md-4"></div>
        </div>
    </div>
    
<?php
    include 'assets/includes/footer.php';
?>