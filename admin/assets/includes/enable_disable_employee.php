    <!-- Delete Employee Modal -->
    <div class="modal fade" id="disable_enable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Enable/Disable</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to enable/disable this employee's account?
                Warning: Once an account is disabled, it will lose it's access to bus driver system.
            </div>
            <div class="modal-footer">
                <form action="../system/database/db_employee.php" method="post">
                    <input type="hidden" name="employee_status" id="employeeStatus">
                    <input type="hidden" name="employee_id" id="employee_ID">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" name="enable_disable_employee" class="btn btn-primary">Yes</button>
                </form>
            </div>
            </div>
        </div>
    </div>