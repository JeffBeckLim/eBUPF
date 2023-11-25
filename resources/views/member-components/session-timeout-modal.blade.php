<!-- Example modal structure -->
<div class="modal fade" id="sessionTimeoutModal" tabindex="-1" aria-labelledby="sessionTimeoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="sessionTimeoutModalLabel">Session Timeout Warning</h5>
            </div>
            <div class="modal-body">
                Your session is expired. Please login again to continue.
            </div>
            <div class="modal-footer">
                <a href="{{route('login')}}" type="button" class="btn bu-orange text-light">Login</a>
                <!-- Add logic here to redirect to logout or refresh the session -->
            </div>
        </div>
    </div>
</div>
