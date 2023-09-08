<div class="modal fade" id="{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow">
        <div class="modal-header border-0">
            <p class="modal-title" id="staticBackdropLabel">Change User Type</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                @if($user->member->membershipApplication == null || 
                $user->member->membershipApplication->status == null)
                         <p class="m-0 text-danger border border-danger rounded p-2 mb-2"><i class="bi bi-exclamation-triangle"></i>
                            <strong>Member option is disabled: </strong>
                            This user has no Membership Application or Membership is not yet approved, please review details first.
                        
                        </p>
                @endif
           
                <p class="m-0 fw-bold text-dark">ID {{$user->id}}: {{$user->member->firstname}} {{$user->member->lastname}}</p>
                
                Current User Type: {{$user->user_type}}

                
                    <div class="form-group">
                        <label for="roleSelect">Choose a Role:</label>
                        <select class="form-select bg-light border" id="roleSelect" name="user_type">   
                                <option value="{{$user->user_type}}" selected disabled>current: {{$user->user_type}}</option>
                                <option value="admin">admin</option>
                                <option value="non-member">non-member</option>
                                @if ($user->member->membershipApplication == null)
                                    <option value="member" disabled>member</option>
                                @elseif($user->member->membershipApplication->status == null)
                                    <option value="member" disabled>member</option>
                                @else        
                                    <option value="member" >member</option> 
                                @endif
                                
                                <option class="fw-bold text-danger" value="restricted">Restrict Account</option>    
            
                        </select>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn bu-orange text-light">Apply Changes</button>
            </div>
        </form>
        </div>
        </div>
</div>
