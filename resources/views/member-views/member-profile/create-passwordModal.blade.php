 <!-- Modal -->
 <div class="modal fade" id="createPasswordModal" tabindex="-1" aria-labelledby="createPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0" >
                <h1 style="font-size: 14px !important" class="modal-title fs-5" id="createPasswordModalLabel">Change Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <small class="text-muted">Your password must be at least 8 characters long and include at least 1 number (0..9), 1 lowercase letters (a..z),  1 uppercase letter (A..Z), and 1 special symbol (!..$).</small>
            <form action="{{ route('member.create.password', ['id' => Auth::user()->member->id]) }}"  method="post">
                @csrf

                <div class="mt-4">
                    <label for="new_password">New Password</label>
                    <div class="input-group">
                        <input required class="form-control" type="password" name="password" id="password">
                        <span class="input-group-text border-start-0" style="background-color: rgba(255, 0, 0, 0) !important"><button type="button" id="password-toggle-new" class="btn btn-link p-0 text-dark"><i class="bi bi-eye-slash-fill"></i></button></span>
                    </div>

                    <label class="mt-2" for="confirm_password">Confirm New Password</label>
                    <input required class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bu-orange text-light">Create Password</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    togglePasswordField('old_password', 'password-toggle-old');
    togglePasswordField('password', 'password-toggle-new');


   function togglePasswordField(inputFieldId, toggleButtonId) {
    const passwordField = document.getElementById(inputFieldId);
    const toggleButton = document.getElementById(toggleButtonId);

    toggleButton.addEventListener('click', function() {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleButton.innerHTML = '<i class="bi bi-eye-fill"></i>'; // Change button icon to show the password
        } else {
            passwordField.type = 'password';
            toggleButton.innerHTML = '<i class="bi bi-eye-slash-fill"></i>'; // Change button icon to hide the password
        }
    });
}
</script>
