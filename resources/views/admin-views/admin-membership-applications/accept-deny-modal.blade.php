{{-- ACCEPT MODAL --}}

<div class="modal fade " id="approveModal{{$memberApplication->member->id}}" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="approveModalLabel">Approve Membership ?</h1>
        <button type="button" class="btn-close border bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
             <h3><i class="text-warning bi bi-exclamation-circle"></i></h3>
             <p class="fs-6">Are you sure you want to approve
                <strong>
                {{$memberApplication->member->firstname}}
                 {{$memberApplication->member->lastname}}
                </strong>
                 membership in eBUPF? <br>
                <span class="text-danger">
                    This will automatically send an email to the applicant.
                </span>
            </p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Go back</button>
        <a href="{{route('membership.accept', $memberApplication->member->id)}}"><button type="button" class="btn bu-orange text-light border-0">Yes, I approve</button></a>
        </div>
    </div>
    </div>
</div>

{{-- DENY MODAL --}}

<div class="modal fade " id="denyModal{{$memberApplication->member->id}}" tabindex="-1" aria-labelledby="denyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="denyModalLabel">Reject Membership?</h1>
        <button type="button" class="btn-close border bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <h3><i class="text-danger bi bi-exclamation-circle"></i></h3>
            <p class="fs-6">Are you sure you want to reject
               <strong>
               {{$memberApplication->member->firstname}}
                {{$memberApplication->member->lastname}}
               </strong>
                membership in eBUPF?
           </p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Go back</button>
        <a href="{{route('membership.reject', $memberApplication->member->id)}}"><button type="button" class="btn btn-danger">Reject Membership</button></a>
        </div>
    </div>
    </div>
</div>

