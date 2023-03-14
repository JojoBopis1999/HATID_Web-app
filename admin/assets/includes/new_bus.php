<!-- Modal -->
<div class="modal fade" id="new_bus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">New Bus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../system/database/db_bus.php" method="post">
            <div class="form-group my-2">
                <label for="bus_model">Bus Model</label>
                <input type="text" name="bus_model" class="form-control" name="bus_model" id="bus_model" aria-describedby="helpId" placeholder="Bus Model">
            </div>

            <div class="form-group my-2">
                <label for="license_plate">License Plate</label>
                <input type="text" name="license_plate" class="form-control" name="license_plate" id="license_plate" aria-describedby="helpId" placeholder="License Plate">
            </div>

            <div class="form-group my-2">
                <label for="my-select">Status</label>
                <select id="my-select" name="status" class="form-control" name="status">
                    <option value="Good">Good</option>
                    <option value="Under Maintenance">Under Maintenance</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="new_bus" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>