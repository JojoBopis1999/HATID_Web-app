    <!-- Delete Employee Modal -->
    <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Warning</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this account? 
                <br>
                By removing this account, it will lose its access anymore to Bus Driver WebApp.
            </div>
            <div class="modal-footer">
                <form action="../system/database/db_employee.php" method="post">
                    <input type="hidden" name="employee_id" id="employeeID" >
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" name="remove_employee" class="btn btn-danger">Yes</button>
                </form>
            </div>
            </div>
        </div>
    </div>