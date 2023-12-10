@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid">
    <div class="adminbox mt-2">


        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {!! session('warning') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('reject'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! session('reject') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif



        <div class="d-flex w-100">
            <div class="d-flex membership-app-header1 text-dark">
                <img src="{{asset('assets/admin-icons/membership-application-icon.svg')}}" alt="" width="50px">
                <p class="text-break" style="padding-left: 10px; padding-top: 5px d-flex"><span class="fw-bold" style="font-size: 1.2rem; margin-right: 10px;">Membership</span> <span class="fw-bold fs-7">Applications</span></p>
            </div>

            <div class="membership-app-header2">
                <div class="lh-1" style="padding: 15px 0 0 15px;">
                    <p class="fw-bold">{{$pending}} Pending</p>
                    <div class="d-flex">
                        <div class="row">
                            <div class="col-sm-6">
                                <p style="margin-right: 20px; font-size: 0.7rem; width: 100%;" class="text-success">{{$approved}} Approved</p>

                            </div>
                            <div class="col-sm-6">
                                <p class="text-danger" style="font-size: 0.7rem; width: 100%">{{$denied}} Denied</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <div class="custom-table-for-admin">

                <table class="table admin-table table-striped " id="myTable">
                    <thead style="border-bottom: 2px solid black">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date Created</th>
                            <th>Unit</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($memberApplications) > 0)
                            @foreach ($memberApplications as $memberApplication)

                                <tr>
                                    <td>{{$memberApplication->member->id}}</td>
                                    <td>
                                        <img src="{{$memberApplication->member->profile_picture != null ?asset('storage/'.$memberApplication->member->profile_picture) : asset('assets/no_profile_picture.jpg') }}" alt="" style="height: 30px; width: 30px; object-fit: cover;" class="border rounded-circle">
                                        <a href="#" class="fw-bold text-dark" style="text-decoration: none;">
                                            {{$memberApplication->member->firstname}}
                                            {{$memberApplication->member->middle_initial ? $memberApplication->member->middle_initial.'.' : ''   }}
                                            {{$memberApplication->member->lastname}}
                                        </a>
                                    </td>
                                    <td>
                                        {{ date('F d, Y', strtotime($memberApplication->created_at)) }}
                                    </td>
                                    <td>{{$memberApplication->member->units->unit_code}}</td>
                                    <td>{{$memberApplication->member->address}}</td>
                                    <td>{{$memberApplication->member->contact_num}}</td>
                                    <td class="text-secondary">
                                        @if ($memberApplication->status == 0)
                                            Pending
                                        @elseif($memberApplication->status==1)
                                            <span class="text-success">Approved</span>
                                        @elseif($memberApplication->status==2)
                                            <span class="text-danger">Denied</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($memberApplication->member->user->user_type == 'member' || $memberApplication->member->user->user_type == 'admin' )
                                            Already approved
                                        @elseif($memberApplication->status == 2)
                                            Denied
                                        @else
                                        <h5>
                                            <a href="#" style="color: #00D186" class="me-3"><i class="bi bi-check-circle-fill" data-bs-toggle="modal" data-bs-target="#approveModal{{$memberApplication->member->id}}"></i></a>

                                            <a href="#" style="color: #FF0000" data-bs-toggle="modal" data-bs-target="#denyModal{{$memberApplication->member->id}}"><i class="bi bi-x-circle-fill"></i></a>
                                        </h5>
                                        @endif


                                        @include('admin-views.admin-membership-applications.accept-deny-modal')



                                    </td>
                                    <td>
                                        <button class="btn grow-on-hover" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots fs-4 icon"></i>
                                          </button>
                                          <ul class="dropdown-menu">
                                            {{-- SEE INCLUDED MODALS BELOW --}}
                                            <li>
                                                <a type="button" class="dropdown-item" href="{{ route('generateMembershipForm', ['id' => $memberApplication->member->id]) }}">
                                                    Download Membership Application
                                                    <p class="" style="font-size: x-small">PDF of Membership Application</p>
                                                </a>

                                            </li>
                                          </ul>
                                    </td>
                                </tr>

                            @endforeach
                        @else

                        @endif
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@include('admin-components.admin-dataTables')
<script>
    $(document).ready(function () {
    // Function to hide alerts after 3 seconds
    function hideAlerts() {
      $(".alert").delay(3000).slideUp(500, function () {
        $(this).alert("close");
      });
    }

    hideAlerts();
  });
</script>
@endsection
