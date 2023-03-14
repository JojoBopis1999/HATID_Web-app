<!-- Turning on location Modal -->
<div class="modal fade" id="turn_on_location" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Please choose Route and Bus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../system/database/db_location_status.php" method="post">
          <div class="row m-3">
            <select name="route_id" class="form-select" id="inputGroupSelect01">
              <option selected>Route</option>
                <?php 
                  include '../system/database/dbcon.php';
                  $route_table = "routes";
                  $route_list = $database->getReference($route_table)->getValue();
                  if($route_list > 0){
                      foreach($route_list as $key => $row){?>
                        <option value="<?= $key ?>"><?= $row['route_name'] ?></option>
                <?php }
                      }else{ ?>
                        <option>No routes found.</option>
                <?php }?>
            </select>
          </div>

          <div class="row m-3">
            <select name="bus_id" class="form-select" id="inputGroupSelect01">
                <option selected>Bus</option>
                  <?php 
                    include '../system/database/dbcon.php';
                    $ref_table = "bus";
                    $fetch_data = $database->getReference($ref_table)->getValue();
                    if($fetch_data > 0){
                        foreach($fetch_data as $key => $row){
                          if($row['condition']=="Good" && $row['status']=="Available"){    ?>
                            <option value="<?= $key ?>"><?= $row['license_plate']; ?></option>
                  <?php   } 
                        }
                        }else{ ?>
                          <option>No bus available.</option>
                  <?php } ?>
              </select>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="employee_uid" value="<?php echo $employeeID ?>">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" name="turn_on_loc" class="btn btn-primary">Set</button>
        </form>
      </div>
    </div>
  </div>
</div>