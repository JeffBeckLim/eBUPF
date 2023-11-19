<ul class="list-unstyled components mb-5 " style="scale: 0.93;" >
    <li class="hover-menu border-bottom">

      <a class="{{Route::is('admin.profile')? 'fw-bold' : ''}}"  href="{{route('admin.profile')}}">
        <img style="width: 2rem; height: 2rem; object-fit: cover" class="me-1 rounded-circle" src="{{Auth::user()->member->profile_picture != null ? asset('storage/' . Auth::user()->member->profile_picture) : asset('assets/no_profile_picture.jpg')}}" alt="icon">
        {{ Auth::user()->member->firstname }}
        {{-- {{ Auth::user()->member->lastname }}--}}
      </a>

    </li>

    <li class="active hover-menu">
      <a class="{{Route::is('admin-dashboard')? 'fw-bold' : ''}}" href="{{route('admin-dashboard')}}">
        <i style="font-size: 18px; color: #0082BA" class="bi bi-grid-1x2{{Route::is('admin-dashboard')? '-fill' : ''}} me-1"></i>
        Dashboard
      </a>
    </li>
    <li>

      <div class="accordion accordion-flush" id="accordionFlushExample" >

        <div class="accordion-item">
          <p class="accordion-header fw-7">
            <button class="accordion-sidebar accordion-button text-start collapsed hover-menu" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseMember" aria-expanded="false" aria-controls="flush-collapseMember">

              {{-- <img src="{{asset('../icons/admin-icons/members.svg')}}" style="width: 1.1rem; margin-left: 10px;"> --}}
                <i style="font-size: 20px; color: #C066DF; margin-left: 10px;" class="bi bi-people{{Route::is('admin.membership-application') || Route::is('admin.all.users') || Route::is('admin.members')? '-fill' : ''}} me-2"></i>
                <p class="fw-7 my-auto {{Route::is('admin.membership-application') || Route::is('admin.all.users') || Route::is('admin.members')? 'fw-bold' : ''}} ">Users</p>
            </button>
          </p>
          <div id="flush-collapseMember" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <ul class="list-unstyled components ms-4">
              <li>
                <a href="{{route('admin.membership-application')}}"  class="fs-7">Membership Applications</a>
              </li>
              {{-- show list od all USERS regardless of user type --}}
              <li>
                <a href="{{route('admin.all.users')}}" class="fs-7">All Users</a>
              </li>
              {{-- show list of all MEMBERS --}}
              <li>
                <a href="{{route('admin.members')}}"  class="fs-7">Members</a>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </li>

    <li class="hover-menu">
      <a class="d-flex align-items-center {{Route::is('admin.loan.applications.tracking')? 'fw-bold' : ''}}" href="{{route('admin.loan.applications.tracking', 'mpl')}}">
        <i style="font-size: 20px; color: #FF6F19" class="bi bi-compass{{Route::is('admin.loan.applications.tracking')? '-fill' : ''}} me-2"></i>
        Tracking Loans
      </a>
    </li>

    <li>
        <h6 class="border-top pt-3 ps-4" style="font-size: 12px; color: #ACACAC;">Loan Applications</h6>
    </li>

    <li class="hover-menu">
      <a class="d-flex align-items-center {{$loanType == 1 ? 'fw-bold' : ''}}" href="{{route('admin.loan.applications' , ['loanType' => 1, 'freeze' => 'table'])}}">
        <i style="font-size: 20px; color: #0038FF" class="bi bi-layers{{$loanType == 1? '-fill' : ''}} me-2"></i>
        Multi-purpose Loans
      </a>
    </li>

    <li class="hover-menu">
      <a class="d-flex align-items-center {{$loanType == 2 ? 'fw-bold' : ''}}" href="{{route('admin.loan.applications' , ['loanType' => 2, 'freeze' => 'table'])}}">
        <i style="font-size: 20px; color: #FF0000" class="bi bi-house{{$loanType == 2 ? '-fill' : ''}} me-2"></i>
        Housing Loans
      </a>
    </li>

    <li class="border-bottom hover-menu">
      <a class="d-flex align-items-center {{Route::is('admin.ledgers')? 'fw-bold' : ''}}" href="{{route('admin.ledgers')}}">
        {{-- <img src="{{asset('../icons/admin-icons/ledgers.svg')}}" style="width: 1rem;"  class="me-2">  --}}
        <i style="font-size: 20px; color: #00D186" class="bi bi-book{{Route::is('admin.ledgers')? '-half' : ''}} me-2"></i>
        Ledgers</a>
    </li>

    <li class="hover-menu">
      <a class="d-flex align-items-center {{Route::is('admin.remittance')? 'fw-bold' : ''}}" href="{{route('admin.remittance')}}">
        {{-- <img src="{{asset('../icons/admin-icons/remittances.svg')}}" style="width: 1rem;" class="me-2"> --}}
        <i style="font-size: 20px; color: #FF6F19;" class="bi bi-sticky{{Route::is('admin.remittance')? '-fill' : ''}} me-2"></i>
        Remittances</a>
    </li>
    <li class="border-bottom hover-menu">
      <a class="d-flex align-items-center {{Route::is('admin.receivables')? 'fw-bold' : ''}}" href="{{ route('admin.receivables', ['report' => 'quarterly', 'loan_type' => 'mpl']) }}">
        {{-- <img src="{{asset('../icons/admin-icons/receivables.svg')}}" style="width: 1rem;"  class="me-2">  --}}
        <i style="font-size: 20px; color: #4C7EFF;" class="bi bi-hourglass{{Route::is('admin.receivables')? '-split' : ''}} me-2"></i>
        Receivables
      </a>
    </li>

    <li class="border-bottom hover-menu">
      <a class="d-flex align-items-center {{Route::is('admin.loan.logs')? 'fw-bold' : ''}}" href="{{ route('loan.logs') }}">
        {{-- <img src="{{asset('../icons/admin-icons/receivables.svg')}}" style="width: 1rem;"  class="me-2">  --}}
        <i style="font-size: 20px; color: #612882;" class="bi bi-clock{{Route::is('loan.logs')? '-fill' : ''}} me-2"></i>
        Logs
      </a>
    </li>

    <li class="mt-4 hover-menu py-2">
      <div class="dropup-center dropup">
        <button class="btn btn-block text-start w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #868686">
          <img class=" me-2 ms-3" src="{{asset('assets/admin-icons/bars.svg')}}" alt="menu" style="width: 1rem">
          More
        </button>
        <ul class="dropdown-menu w-100 mb-1 border border-dark">
          <li><a class="dropdown-item" href="/logout">Log Out</a></li>
        </ul>
      </div>
    </li>

  </ul>