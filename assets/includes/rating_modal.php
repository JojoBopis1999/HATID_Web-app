<!-- Rating Modal -->
<div class="modal fade" id="rating_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Trip Feedback Form</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="./system/database/db_rating_driver.php">
            <div class="form-group">
                <div class="col my-2">
                    <label>How efficient is our driver:</label>
                    <br>
                    <small class="fst-italic">1-Highly Dissatisfied, 2-Dissatisfied, 3-Neutral, 4-Satisfied, 5-Very Satisfied</small>
                    <br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-danger btn-circle">
                            <input type="radio" name="efficiency" id="option1" value="1" required> 1
                        </label>
                        <label class="btn btn-outline-warning btn-circle">
                            <input type="radio" name="efficiency" id="option2" value="2" required> 2
                        </label>
                        <label class="btn btn-outline-info btn-circle">
                            <input type="radio" name="efficiency" id="option3" value="3" required> 3
                        </label>
                        <label class="btn btn-outline-success btn-circle">
                            <input type="radio" name="efficiency" id="option4" value="4" required> 4
                        </label>
                        <label class="btn btn-outline-primary btn-circle">
                            <input type="radio" name="efficiency" id="option5" value="5" required> 5
                        </label>
                    </div>
                </div>
            </div>

            <input type="hidden" name="route_id" id="routeID">
            <input type="hidden" name="bus_id" id="busID">
            <input type="hidden" name="employee_uid" id="empID">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" name="rating_btn" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>