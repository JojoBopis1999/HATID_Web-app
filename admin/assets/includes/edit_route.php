<!-- Edit Route Modal -->
<div id="edit_route" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Route</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="../system/database/db_routes.php" method="post">
           <input type="hidden" name="route_id" id="route-Id" >
          <div class="input-group">
            <span class="input-group-text">Route Name</span>
            <input type="text" name="route_name" aria-label="Route Name" class="route-name form-control">
          </div>
      </div>

      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type='submit' name='edit_bus_route' class='btn btn-primary'>Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>