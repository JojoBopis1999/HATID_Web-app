<!-- Modal -->
<div class="modal fade" id="create_route" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add new Route</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../system/database/db_routes.php" method="post">
          
          <div class="input-group">
            <span class="input-group-text">Route Name</span>
            <input type="text" name="route_name" aria-label="Route Name" class="form-control">
          </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type='submit' name='new_bus_route'class='btn btn-primary'>Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

