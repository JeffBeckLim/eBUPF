<div class="tab">
    <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                <p class="fw-bold bu-text-orange">Provide Atleast One</p>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Benificiary (1)</label>
                    <input class="form-control validate" type="text" name="beneficiary0" value="{{old('beneficiary0')}}">
                </div>
                @error('beneficiary0')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control validate" type="date" name="beneficairy_birthday0" value="{{old('beneficiary_birthday0')}}">
                </div>
                @error('beneficiary_birthday0')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship0" class="form-select form-control validate" aria-label="Default select example">
                        <option value="">Select Relationship</option>
                        <option value="spouse">Spouse</option>
                        <option value="child">Child</option>
                        <option value="parent">Parent</option>
                        <option value="sibling">Sibling</option>
                        <option value="grandparent">Grandparent</option>
                        <option value="grandchild">Grandchild</option>
                        <option value="friend">Friend</option>
                        <option value="relative">Relative</option>
                        <option value="partner">Partner</option>
                        <option value="colleague">Colleague</option>
                        <option value="other">Other</option>
                        
                    </select>
                </div>
                @error('beneficiary_relationship0')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Benificiary (2)</label>
                    <input class="form-control" type="text" name="beneficiary1">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficairy_birthday1">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship1" class="form-select form-control" aria-label="Default select example">
                        <option selected disabled>...</option>
                        <option value="1">Casual</option>
                        <option value="2">Permanent</option>
                        
                    </select>
                </div>
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Benificiary (3)</label>
                    <input class="form-control" type="text" name="beneficairy_birthday2">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control" type="date" name="birthday">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship2" class="form-select form-control" aria-label="Default select example">
                        <option selected disabled>...</option>
                        <option value="1">Casual</option>
                        <option value="2">Permanent</option>
                        
                    </select>
                </div>
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Benificiary (4)</label>
                    <input class="form-control" type="text" name="beneficiary3">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficairy_birthday3">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship3" class="form-select form-control" aria-label="Default select example">
                        <option selected disabled>...</option>
                        <option value="1">Casual</option>
                        <option value="2">Permanent</option>
                        
                    </select>
                </div>
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Benificiary (5)</label>
                    <input class="form-control" type="text" name="beneficiary4">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficairy_birthday4">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship4" class="form-select form-control" aria-label="Default select example">
                        <option selected disabled>...</option>
                        <option value="1">Casual</option>
                        <option value="2">Permanent</option>
                        
                    </select>
                </div>
            </div>
</div>