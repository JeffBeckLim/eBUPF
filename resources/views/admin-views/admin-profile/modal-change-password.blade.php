 <!-- Modal -->
 <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-0" >
          <h1 style="font-size: 14px !important" class="modal-title fs-5" id="changePasswordModalLabel">Change Password</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
            <label for="current_password">Current Password</label>
            <input class="form-control" type="password" name="current_password" id="current_password">
            <div class="border-top mt-4">
            <label for="new_password">New Password</label>
            <input class="form-control" type="password" name="new_password" id="new_password">
            
            <label for="confirm_password">Confirm New Password</label>
            <input class="form-control" type="password" name="confirm_password" id="confirm_password">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn bu-orange text-light">Chnage Password</button>
        </div>
      </div>
    </div>
  </div>