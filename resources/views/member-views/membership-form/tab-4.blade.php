<div class="tab">
    <div class="row">
        <div class="col-12 mb-4 ">
            <label for="formFile" class="fw-bold mb-3">Upload Your Profile Picture</label>
            <input class="form-upload" type="file" id="formFile" name="profile_picture">
        </div>

        <div class="col-12 mb-5">
            <div class="form-check">
                <input class="form-check-input checkbox-input validate" type="checkbox" value="1" id="defaultCheck1" name="agree_to_certify" {{ (Auth::user()->member->agree_to_certify) ? 'checked' : '' }}
                >
                <label class="form-check-label fs-6" for="defaultCheck1" >
                    I hereby certify that all the information given  are true and correct <span class="fw-bold">and aggree to terms of collecting and using my data</span>
                </label>
            </div>
            @error('agree_to_certify')
                <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
            @enderror
        </div>
        <div class="col-12 mb-5">
            <div class="form-check">
                <input class="form-check-input checkbox-input validate " type="checkbox" value="1" id="defaultCheck1" name="agree_to_authorize" {{ (Auth::user()->member->agree_to_authorize) ? 'checked' : '' }}>
                <label class="form-check-label fs-6 " for="defaultCheck1" >
                            Further, I hereby authorize the Administrative/Payroll Section to deduct from my salaries my monthly contribution as member to the bu Provident Fund, Inc.
                </label>
            </div>
            @error('agree_to_authorize')
                <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
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