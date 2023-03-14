    <!--Deletion Modal -->
    <div class="modal fade" id="remove_route" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-danger" id="staticBackdropLabel">
                <i class="bi bi-exclamation-triangle pe-3"></i>Warning</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure you want you remove this route?
            Removing this route will also delete all of its stops.
        </div>
        <div class="modal-footer">
            <form action="../system/database/db_routes.php" method="post">
                <input type="hidden" name="route_id" id="route_Id" >
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" name="remove_routes" class="btn btn-danger">Yes</button>
            </form>
        </div>
        </div>
    </div>
    </div>