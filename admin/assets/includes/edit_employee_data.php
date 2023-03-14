<!-- Edit Employee Data -->
<div class="modal fade" id="edit_employee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Employees Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../system/database/db_employee.php" method="post">
        <input type="hidden" name="employee_id" id="employee_Id" >
        <div class="row g-3">
            <div class="col-12">
                <!--First and Last Name-->
                <div class="input-group">
                <span class="input-group-text">First & Last Name</span>
                <input type="text" name="first_last_name" aria-label="First name" class="first-name form-control" required>
                </div>
            </div>

            <div class="col-12">
                <div class="input-group ">
                <span class="input-group-text">Contact No.</span>
                <input type="tel" name="mobile_number" aria-label="mobile_num" class="contact-no form-control" pattern="+[0-9]{13}" required>
                </div>
            </div>

            <div class="col-12">
                <div class="input-group">
                <span class="input-group-text" id="basic-addon2">Email Address</span>
                <input type="text" name="email_address" class="email-add form-control" aria-describedby="basic-addon2" required>
                </div>
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="edit_employee" class="btn btn-primary">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>