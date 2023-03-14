<!-- Edit Employee Data -->
<div class="modal fade" id="reset_password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Employees Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="h1 fw-bold my-4 text-center">RESET PASSWORD</div>
        <form action="../system/database/db_reset_password.php" method="post">
        <input type="hidden" name="employee_id" id="emp_ID" >

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">New Password</span>
            <input type="password" name="new_password" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
        </div>
        
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Confirm New Password</span>
            <input type="password" name="confirm_password" class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="reset_btn" class="btn btn-primary">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>