<!-- Modal -->
<div class="modal fade" id="edit_stop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Stop</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> 
        <form action="../system/database/db_routes.php" method="post">
          <div class="row g-3">
            <div class="col-md-7">
              <!-- Bus Stop Name-->
              <div class="input-group">
                <span class="input-group-text" id="inputGroup-sizing-default">Name of Stop</span>
                <input type="text" name="stop_name" class="stop-name form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>
            </div>

              <!--Route where bus stop belongs-->
            <div class="col-md-5">
              <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Route</label>
                  <!--Displaying list of Routes-->
                  <select name="route_ID" class="route form-select" id="inputGroupSelect01">
                    <option class="route" selected>Choose</option>
                  <?php 
                      include '../system/database/dbcon.php';
                      $ref_table = "routes";
                      $fetch_data = $database->getReference($ref_table)->getValue();
                      if($fetch_data > 0){
                          foreach($fetch_data as $key => $row){   ?>
                              <option value="<?= $key ?>"><?= $row['route_name']; ?></option>
                          <?php
                              }
                          }else{
                          ?>
                            <option value="1">No routes found</option>
                          <?php
                              }
                          ?>>
                    </select>
              </div>

            </div>

              <!--Bus Stop Latitude-->
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-text" id="inputGroup-sizing-default">Latitude</span>
                <input type="text" name="latitude" class="latitude form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>
            </div>


              <!--Bus Stop Longitude-->
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-text" id="inputGroup-sizing-default">Longitude</span>
                <input type="text" name="longitude" class="longitude form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>
            </div>
            
            <!--Stop Order Number-->
            <div class="col-md-6">
              <div class="input-group">
                  <span class="input-group-text" id="inputGroup-sizing-default">Stop Order Number</span>
                  <input type="text" name="stop_order" class="stop-order form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="stop_id" id="stop-id">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="edit_stop" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>