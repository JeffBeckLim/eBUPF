@extends('admin-components.admin-layout')

@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center ">
        <div class="col-lg-9 bg-white rounded border d-flex justify-content-center m-3 p-4">
            <div class="row w-100">       
                <div class="col-12 g-0">
                    <div class="row d-flex justify-content-center ">
                        @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          {{session('fail')}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>    
                      @endif
                        
                        @if (session('passed'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{session('passed')}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>    
                      @endif
                
                      @error('old_password')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div> 
                      @enderror
                      @error('password')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div> 
                      @enderror
                      @error('password_confirmation')
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$message}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div> 
                      @enderror
                </div>
            
                <div class="col-12 p-3 rounded shadow" style="background-image: url({{ asset('assets/core-feature-bg.png') }}); filter: saturate(200%)">
                    <div class="pb-3 text-white text-center" style="font-size: 14px">
                        Member ID {{ Auth::user()->member->id}}
                    </div>
                    <div class="row">        
                        <div class="col-3  text-center">
                            <img src="{{Auth::user()->member->profile_picture != null ? asset('storage/' . Auth::user()->member->profile_picture) : asset('assets/no_profile_picture.jpg')}}" alt="profile picture" class="rounded-circle shadow img-fluid" style="object-fit:cover; width: 9rem; height: 9rem; border: 4px solid white;">
                        </div>
                        <div class="col  my-auto text-white p-2" style="text-shadow: 1px 1px 4px rgb(46, 46, 46);">
                            <span>
                                <h6 class="fw-bold" style="font-size: 24px; ">
                                {{ Auth::user()->member->firstname}}
                                {{ Auth::user()->member->middle_initial}}.
                                {{ Auth::user()->member->lastname}}
                                <a class="text-decoration-none text-white" href="{{route('admin.update.profile')}}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                </h6>
                            </span>
                            <h6>
                                {{ Auth::user()->email}}
                            </h6>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @if (Route::is('admin.profile'))
                        @include('admin-views.admin-profile.profile')
                    @elseif(Route::is('admin.update.profile'))
                        @include('admin-views.admin-profile.update-profile')
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
@include('admin-components.admin-dataTables')
@endsection