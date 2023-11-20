<div class="tab fade-in">
    <div class="row g-1">
                <div class="col-12">
                    <p class="fw-bold m-0">Department</p>
                </div>
                <div class="col-12 mb-3">
                    <label  for="">College / Unit & Campus</label>
                    <select name="unit_id" class="form-select form-control validate" > 
                        @foreach ($units as $unit)
                            @if (Auth::user()->member->unit_id == $unit->id)
                            <option value="{{$unit->id}}"  selected>{{$unit->unit_code}} : {{$unit->campuses->campus_code}}</option>
                                
                            @else
                                <option value="{{$unit->id}}">{{$unit->unit_code}} : {{$unit->campuses->campus_code}}</option>
                            @endif
                           
                        @endforeach

                    </select>
                    
                </div>
                @error('unit_id')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
    </div>
    <div class="row g-1  mb-3  mt-2">
        <div class="col-12">
            <p class="fw-bold m-0">Employment</p>
        </div>

        <div class="col-6">
            <label   for="">Position</label>
            
            <input class="form-control validate" name="position" value="{{Auth::user()->member->position}}">
        </div>
        @error('position')
            <p class="text-danger mt-1">{{$message}}</p>
        @enderror
        <div class="col-6">
            <label  for="salary">Monthly Salary</label>
            <input class="form-control validate" type="number" name="monthly_salary" value="{{Auth::user()->member->monthly_salary}}">
        </div>
    </div>
    <div class="row g-1 mb-3">
        <div class="col-6">
            <label   for="tin">TIN number</label>
            <input class="form-control validate" type="number" name="tin_num" value="{{Auth::user()->member->tin_num}}">
        </div>
        @error('tin_num')
             <p class="text-danger mt-1">{{$message}}</p>
        @enderror
        <div class="col-6">
            <label for="salary">Employee Number</label>
            <input class="form-control validate" type="number" name="employee_num" value="{{Auth::user()->member->employee_num}}">
        </div>
        @error('employee_num')
                <p class="text-danger mt-1">{{$message}}</p>
        @enderror
    </div>
    <div class="row g-1 mb-3">
        <div class="col-6">
            <label  for="appointmentStatus">Status of Appointment</label>
            <select name="appointment_status" class="form-select form-control validate" aria-label="Default select example">
                <option value="casual"{{Auth::user()->member->appointment_status == 'casual' ? 'selected' : ''}}>Casual</option>
                <option value="permanent" {{Auth::user()->member->appointment_status == 'permanent' ? 'selected' : ''}}>Permanent</option>
            </select>
        </div>
        @error('appointment_status')
            <p class="text-danger mt-1">{{$message}}</p>
        @enderror
        <div class="col-6">
            <label for="salary">Date of Appointment in BU.</label>
            <input class="form-control validate" type="date" name="bu_appointment_date" value="{{Auth::user()->member->bu_appointment_date}}">
        </div>   
        @error('bu_appointment_date')
            <p class="text-danger mt-1">{{$message}}</p>
        @enderror
    </div>
    <div class="col-12  mt-2">  
        <div class="col-12">
            <p class="fw-bold m-0">Contribution</p>
        </div> 
        <label for="salary">Fixed Monthly Contribution</label>
        <input class="form-control validate" type="number" name="monthly_contribution" value="{{Auth::user()->member->monthly_contribution}}">
    </div>
    @error('monthly_contribution')
    <p class="text-danger mt-1">{{$message}}</p>
@enderror
</div>