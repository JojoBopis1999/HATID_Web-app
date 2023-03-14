<!-- Turning off location Modal -->
<div class="modal fade" id="turn_off_location" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Sign OFF</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to sign off?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="../system/database/db_location_status.php" method="post">
          <input type="hidden" name="bus_location_id" value="<?php $bus_location_id ?>">
          <input type="hidden" name="trip_id" value="<?php $trip_id ?>">
          <input type="hidden" name="bus_id" value="<?php $bus_id ?>">
          <button type="submit" name="turn_off_loc" class="btn btn-primary">Understood</button>
        </form>
      </div>
    </div>
  </div>
</div>