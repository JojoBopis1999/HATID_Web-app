<!-- Update Advisory Modal -->
<div class="modal fade" id="edit_advisory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../system/database/db_advisory.php" method="post">
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Subject</label>
            <input type="text" class="subject-form form-control" name="subject" id="formGroupExampleInput" required>
          </div>

          <div class="input-group">        
              <textarea class="message_advisory form-control" id="replace_line_break" name="message" placeholder="Type message here..." rows="10"  required></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="adv_id" id="adv_ID">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" name="update_advisory" class="btn btn-primary">Update Post</button>
        </form>
      </div>
    </div>
  </div>
</div>