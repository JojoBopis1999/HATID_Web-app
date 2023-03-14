<!-- Remove Feedback Modal -->
<div class="modal fade" id="remove_advisory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Remove Post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure want to remove this feedback?
      </div>
      <div class="modal-footer">
        <form action="#" method="post">
            <input type="hidden" name="feedback_id" id="feedback_ID">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="remove_advisory" class="btn btn-danger">Remove Post</button>
        </form>
      </div>
    </div>
  </div>
</div>