<div class="tab">
    <div class="row border-bottom border-1 pb-3 mb-3 g-1">
                <p class="fw-bold bu-text-orange">Provide at least one</p>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Beneficiary (1)</label>
                    <input class="form-control validate" type="text" name="beneficiary0" value="{{ $beneficiaries[0]->beneficiary_name ?? old('beneficiary0') }}" id="beneficiary0">
                </div>
                @error('beneficiary0')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6">
                    <label class="fw-bold" for="salary">Beneficiary's Date of Birth</label>
                    <input class="form-control validate" type="date" name="beneficiary_birthday0" value="{{ $beneficiaries[0]->birthday ?? old('beneficiary_birthday0') }}">
                </div>
                @error('beneficiary_birthday0')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship0" class="form-select form-control validate" aria-label="Default select example">
                        <option value="" disabled selected>Select Relationship</option>
                        <option value="">...</option>
                        @foreach ($relationship_types as $type)
                        @if (isset($beneficiaries[0]->relationship) && $beneficiaries[0]->relationship == $type->relationship_type)
                            <option value="{{$type->relationship_type}}" selected>{{$type->relationship_type}}</option>
                        @else
                            <option value="{{$type->relationship_type}}">{{$type->relationship_type}}</option>
                        @endif

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
                    <input class="form-control" type="text" name="beneficiary1" value="{{ $beneficiaries[1]->beneficiary_name ?? old('beneficiary1') }}" id="beneficiary1">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficiary_birthday1" value="{{ $beneficiaries[1]->birthday ?? old('beneficiary_birthday1') }}">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship1" class="form-select form-control" aria-label="Default select example">

                        <option value="" disabled selected>Select Relationship</option>
                         <option value="">...</option>
                        @foreach ($relationship_types as $type)
                            @if (isset($beneficiaries[1]->relationship) && $beneficiaries[1]->relationship == $type->relationship_type)
                                <option value="{{$type->relationship_type}}" selected>{{$type->relationship_type}}</option>
                            @else
                                <option value="{{$type->relationship_type}}">{{$type->relationship_type}}</option>
                            @endif

                        @endforeach

                    </select>
                </div>
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">

                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Benificiary (3)</label>
                    <input class="form-control" type="text" name="beneficiary2" value="{{ $beneficiaries[2]->beneficiary_name ?? old('beneficiary2') }}" id="beneficiary2">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficiary_birthday2"value="{{ $beneficiaries[2]->birthday ?? old('beneficiary_birthday2') }}">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship2" class="form-select form-control" aria-label="Default select example">
                        <option value="" disabled selected>Select Relationship</option>\
                        @foreach ($relationship_types as $type)
                            @if (isset($beneficiaries[2]->relationship) && $beneficiaries[2]->relationship == $type->relationship_type)
                                <option value="{{$type->relationship_type}}" selected>{{$type->relationship_type}}</option>
                            @else
                                <option value="{{$type->relationship_type}}">{{$type->relationship_type}}</option>
                            @endif

                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">

                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Benificiary (4)</label>
                    <input class="form-control" type="text" name="beneficiary3" value="{{ $beneficiaries[3]->beneficiary_name ?? old('beneficiary3')}}" id="beneficiary3">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Benificiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficiary_birthday3" value="{{ $beneficiaries[3]->birthday ?? old('beneficiary_birthday3') }}">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship3" class="form-select form-control" aria-label="Default select example">
                        <option value="" disabled selected>Select Relationship</option>
                        <option value="">...</option>
                        @foreach ($relationship_types as $type)
                            @if (isset($beneficiaries[3]->relationship) && $beneficiaries[3]->relationship == $type->relationship_type)
                                <option value="{{$type->relationship_type}}" selected>{{$type->relationship_type}}</option>
                            @else
                                <option value="{{$type->relationship_type}}">{{$type->relationship_type}}</option>
                            @endif

                        @endforeach

                    </select>
                </div>
            </div>

            <div class="row border-bottom border-1 pb-3 mb-3 g-1">

                <div class="col-6">
                    <label class="fw-bold" for="salary">Name of Beneficiary (5)</label>
                    <input class="form-control" type="text" name="beneficiary4"
                    value="{{ $beneficiaries[4]->beneficiary_name ?? old('beneficiary4') }}" id="beneficiary4">
                </div>
                <div class="col-6">
                    <label class="fw-bold" for="salary">Beneficiary's Date of Birth</label>
                    <input class="form-control" type="date" name="beneficiary_birthday4" value="{{ $beneficiaries[4]->birthday ?? old('beneficiary_birthday4') }}">
                </div>
                <div class="col-6">
                    <label class="fw-bold"  for="appointmentStatus">Relationship to Applicant</label>
                    <select name="beneficiary_relationship4" class="form-select form-control" aria-label="Default select example">
                        <option value="" disabled selected>Select Relationship</option>
                        <option value="">...</option>
                        @foreach ($relationship_types as $type)
                            @if (isset($beneficiaries[4]->relationship) && $beneficiaries[4]->relationship == $type->relationship_type)
                                <option value="{{$type->relationship_type}}" selected>{{$type->relationship_type}}</option>
                            @else
                                <option value="{{$type->relationship_type}}">{{$type->relationship_type}}</option>
                            @endif

                    @endforeach
                    </select>
                </div>
            </div>
</div>
