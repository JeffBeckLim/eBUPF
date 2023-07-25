<div style="padding-top: 220px" class="modal fade" id="{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow " style="height: 20rem">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Change User Type</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
            
                <p class="m-0 fw-bold">ID {{$user->id}}: {{$user->member->firstname}} {{$user->member->lastname}}</p>
                
                Current User Type: {{$user->user_type}}

                
                    <div class="form-group">
                        <label for="roleSelect">Choose a Role:</label>
                        <select class="form-select bg-light border" id="roleSelect" name="user_type">
                            <option value="{{$user->user_type}}" selected>current: {{$user->user_type}}</option>
                            <option value="admin">admin</option>
                            <option value="non-member">non-member</option>
                            <option value="member">member</option>
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
