    <!-- Modal For Removing Bus Stop -->
    <div class="modal fade" id="remove_stop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="stop-id modal-title fs-5 text-danger" id="exampleModalLabel">Warning</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete it?
                </div>
                <div class="modal-footer">
                    <form action="../system/database/db_routes.php" method="post">.
                        <input type="hidden" name="stop_id" id="stop_Id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="remove_stops" class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>