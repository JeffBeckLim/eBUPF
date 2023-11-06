 <!-- Modal -->
 <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0" >
                <h1 style="font-size: 14px !important" class="modal-title fs-5" id="changePasswordModalLabel">Change Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <small class="text-muted">Your password must be at least 8 characters long and include at least 1 number and 1 special character.</small>
            <form action="{{ route('member.change.password', ['id' => Auth::user()->member->id]) }}"  method="post">
                @csrf
                <label for="current_password" class="mt-3">Current Password</label>
                <input required class="form-control" type="password" name="old_password" id="old_password">
                <div class="border-top mt-4">
                    <label for="new_password">New Password</label>
                    <input required class="form-control" type="password" name="password" id="password">

                    <label for="confirm_password">Confirm New Password</label>
                    <input required class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn bu-orange text-light">Change Password</button>
        </form>
        </div>
      </div>
    </div>
  </div>
