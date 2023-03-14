<?php 
    session_start();
    $tabName = "Bus Stops";
    include 'assets/includes/header.php';
    include 'assets/includes/route_stops_modal.php';
?>

    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <img src="attachments/bus_route.png" alt="Bus Route Logo" width="350px" height="95px">
        </div>
        <div class="row mb-3">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <?php 
                            include 'system/database/dbcon.php';
                            $ref_table = "routes";
                            $fetch_data = $database->getReference($ref_table)->getValue();
                            if($fetch_data > 0){
                                foreach($fetch_data as $key => $row){
                        ?>
                            <div class="row d-flex justify-content-evenly">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $key ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <?= $row['route_name']; ?>
                                        </button>
                                        </h2>
                                        <div id="<?php echo $key ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body text-center">
                                                <?php
                                                    $stop_list_table = "bus_stop";
                                                    $stop_detail = $database->getReference($stop_list_table)->orderByChild("stop_order")->startAt(0)->getValue();
                                                    if($stop_detail > 0){
                                                        foreach($stop_detail as $stop_key => $stop_row){
                                                            if($key == $stop_row['route_id']){
                                                                echo $stop_row['stop_name']."<br>";
                                                                ?>
                                                                <input type="hidden" name="route_id" value="<?= $stop_row['route_id'] ?>">
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                                }
                            }else{
                        ?>
                            <div class="row d-flex justify-content-evenly mt-3">
                                <div class="card mb-3" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title">No Route Found</h5>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
<?php
    include 'assets/includes/footer.php'; ?>