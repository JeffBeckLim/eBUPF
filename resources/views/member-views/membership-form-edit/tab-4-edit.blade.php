<div class="tab">
    <div class="row">

        <div class="col-12 mb-4 ">
            <div class="text-center mb-2">
                @if (Auth::user()->member->profile_picture != null)
                    <img class="p-2 rounded-5 border" src="{{asset('storage/'.Auth::user()->member->profile_picture)}}" alt=""style="width: 150px; height: 150px; object-fit:cover">
                  <p class="p-1 m-0" style="font-size: small;">Current profile picture</p>
                  @endif
            </div>
            <label for="formFile" class="fw-bold mb-3">{{Auth::user()->member->profile_picture != null? 'Change' : 'Upload'}} Your Profile Picture</label>
            <input class="form-upload form-control" type="file" id="formFile" name="profile_picture" accept=".png, .jpg, .jpeg">
            <div class="invalid-feedback">Upload a png or jpg file not exceeding 2 mb</div>
        </div>

        <div class="col-12 mb-5">
            <div class="form-check">
                <input class="form-check-input checkbox-input validate" type="checkbox" value="1" id="defaultCheck1" name="agree_to_certify" {{ (Auth::user()->member->agree_to_certify) ? 'checked' : '' }}
                style="pointer-events:none; opacity: 50%">
                <label class="form-check-label fs-6" for="defaultCheck1" >
                    I hereby certify that all the information given are true and correct <span class="fw-bold">and agree to terms of collecting and using my data</span>
                </label>
            </div>
            @error('agree_to_certify')
                <p class="text-danger mt-1">{{$message}}</p>
            @enderror
        </div>
        <div class="col-12 mb-5">
            <div class="form-check">
                <input class="form-check-input checkbox-input validate " type="checkbox" value="1" id="defaultCheck1"  name="agree_to_authorize" {{ (Auth::user()->member->agree_to_authorize) ? 'checked' : '' }} style="pointer-events:none; opacity: 50%">
                <label class="form-check-label fs-6 " for="defaultCheck1" >
                            Further, I hereby authorize the Administrative/Payroll Section to deduct from my salaries my monthly contribution as member to the BU Provident Fund, Inc.
                </label>
            </div>
            @error('agree_to_authorize')
                <p class="text-danger mt-1">{{$message}}</p>
            @enderror

        </div>
        {{-- <div class="col-12 mb-5">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="agree_to_terms" {{ (Auth::user()->member->agree_to_terms) ? 'checked' : '' }}>
                <label class="form-check-label fs-6" for="defaultCheck1">
                    I agree to the terms and conditions for collecting and using my data.
                </label>
            </div>
            @error('agree_to_terms')
                <p class="text-danger mt-1">{{$message}}</p>
            @enderror
        </div> --}}
    </div>

</div>
