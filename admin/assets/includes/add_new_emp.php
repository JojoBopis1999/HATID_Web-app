<!-- Modal -->
<div class="modal fade" id="new_emp_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add new Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="..//system/database/db_employee.php" method="post">
        <div class="row g-3">
            <div class="col-12">
                <!--First and Last Name-->
                <div class="input-group">
                <span class="input-group-text">First & Last Name</span>
                <input type="text" name="first_last_name" aria-label="First name" class="form-control" required>
                </div>
            </div>

            <div class="col-12">
                <div class="input-group ">
                <span class="input-group-text">Contact No.</span>
                <input type="tel" name="mobile_number" aria-label="mobile_num" class="form-control" pattern="^(+639)\d{9}$" value="+639">
                </div>
            </div>

            <div class="col-12">
                <div class="input-group">
                <span class="input-group-text" id="basic-addon2">Email Address</span>
                <input type="text" name="email_address" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                </div>
            </div>

            <div class="col-12">
                <div class="input-group">
                <span class="input-group-text">Password</span>
                <input type="password" name="user_password" class="form-control" required>
                </div>
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="new_employee" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>