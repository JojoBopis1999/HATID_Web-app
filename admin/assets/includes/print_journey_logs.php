<!-- Excel -->
<div class="modal fade" id="printExcel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Set the Excel content</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../system/spreadsheet/spreadsheet.php" method="post">
            <div class="form-group my-2">
                <label for="my-select">Choose Route</label>
                <select id="my-select" class="form-control" name="choose_route">  
                <?php
                    include '../system/database/dbcon.php';
                    $route_table = "routes";
                    $route_list = $database->getReference($route_table)->getValue();
                    if($route_list > 0){
                        foreach($route_list as $route_key => $route_row){
                            ?>
                                <option value="<?php echo $route_key ?>"><?= $route_row['route_name']; ?></option>
                            <?php
                        }
                    }else{
                        ?>
                            <option value="all_route">No Routes</option>   
                        <?php
                    }
                ?>
                </select>
            </div>
            
            <div class="form-group my-2">
                <label for="my-select">Choose Bus</label>
                <select id="my-select" class="form-control" name="choose_bus">
                <?php
                    $bus_table = "bus";
                    $bus_list = $database->getReference($bus_table)->getValue();
                    if($bus_list > 0){
                        foreach($bus_list as $bus_key => $bus_row){
                            ?>
                                <option value="<?php echo $bus_key ?>"><?= $bus_row['bus_model']."|".$bus_row['license_plate'] ?></option>
                            <?php
                        }
                    }else{
                        ?>
                            <option value="all_route">No Bus</option>   
                        <?php
                    }
                ?>
                </select>
            </div>

            <div class="form-group my-2">
                <label for="my-select">Choose Employee</label>
                <select id="my-select" class="form-control" name="choose_employee">
                <?php
                    $users = $auth->listUsers();
                    foreach($users as $user) {
                            ?>
                                <option value="<?php echo $user->uid ?>"><?= $user->displayName ?></option>
                            <?php
                    }
                ?>
                </select>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="print_logs" class="btn btn-primary">Download</button>
        </form>
      </div>
    </div>
  </div>
</div>