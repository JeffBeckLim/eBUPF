<div class="tab">
    <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                <p class="fw-bold bu-text-orange">Provide Atleast One</p>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Beneficiary (1)</label>
                    <input class="form-control validate" type="text" name="beneficiary0" value="{{old('beneficiary0')}}">
                </div>
                @error('beneficiary0')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6">
                    <label class="fw-bold" for="salary">Beneficiary's Date of Birth</label>
                    <input class="form-control validate" type="date" name="beneficiary_birthday0" value="{{old('beneficiary_birthday0')}}">
                </div>
                @error('beneficiary_birthday0')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship0" class="form-select form-control validate" aria-label="Default select example">
                        <option value="" disabled selected>Select Relationship</option>\
                        @foreach ($relationship_types as $type)
                            <option value="{{$type->relationship_type}}">{{$type->relationship_type}}</option>    
                        @endforeach
                    </select>
                </div>
                @error('beneficiary_relationship0')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Benificiary (2)</label>
                    <input class="form-control" type="text" name="beneficiary1" value="{{old('beneficiary1')}}">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficiary_birthday1" value="{{old('beneficiary_birthday1')}}">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship1" class="form-select form-control" aria-label="Default select example">
                        <option value="" disabled selected>Select Relationship</option>\
                        @foreach ($relationship_types as $type)
                            <option value="{{$type->relationship_type}}">{{$type->relationship_type}}</option>    
                        @endforeach
                        
                    </select>
                </div>
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Benificiary (3)</label>
                    <input class="form-control" type="text" name="beneficiary2" value="{{old('beneficiary2')}}">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficiary_birthday2" value="{{old('beneficiary_birthday2')}}">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship2" class="form-select form-control" aria-label="Default select example">
                        <option value="" disabled selected>Select Relationship</option>\
                        @foreach ($relationship_types as $type)
                            <option value="{{$type->relationship_type}}">{{$type->relationship_type}}</option>    
                        @endforeach
                        
                    </select>
                </div>
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Benificiary (4)</label>
                    <input class="form-control" type="text" name="beneficiary3" value="{{old('beneficiary3')}}">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficiary_birthday3" value="{{old('beneficiary_birthday3')}}">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship3" class="form-select form-control" aria-label="Default select example">
                        <option value="" disabled selected>Select Relationship</option>\
                        @foreach ($relationship_types as $type)
                            <option value="{{$type->relationship_type}}">{{$type->relationship_type}}</option>    
                        @endforeach
                        
                    </select>
                </div>
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Beneficiary (5)</label>
                    <input class="form-control" type="text" name="beneficiary4" value="{{old('beneficiary4')}}">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Beneficiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficiary_birthday4" value="{{old('beneficiary_birthday4')}}">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship4" class="form-select form-control" aria-label="Default select example">
                        <option value="" disabled selected>Select Relationship</option>\
                        @foreach ($relationship_types as $type)
                            <option value="{{$type->relationship_type}}">{{$type->relationship_type}}</option>    
                        @endforeach
                    </select>
                </div>
            </div>
</div>