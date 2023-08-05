<div class="tab fade-in">
    <div class="row g-1">
                <div class="col-12">
                    <p class="fw-bold m-0">Department</p>
                </div>
                <div class="col-6 mb-3">
                    <label  for="">College / Unit</label>
                    <select name="units_id" class="form-select form-control validate" > 
                        <option value="">...</option>
                        <option value="1">Option 1</option>

                        
                    </select>
                    
                </div>
                @error('units_id')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
                <div class="col-6">
                    <label  for="">Campus</label>
                    <select name="campus_id" class="form-select form-control validate" >
                        <option value="casual" selected disabled >....</option>
                        <option value="1">BUCS</option>
                        
                    </select>
                </div>
                @error('campus_id')
                    <p class="text-danger mt-1">{{$message}}</p>
                @enderror
    </div>
    <div class="row g-1  mb-3  mt-2">
        <div class="col-12">
            <p class="fw-bold m-0">Employment</p>
        </div>

        <div class="col-6">
            <label   for="">Position</label>
            <select name="position" class="form-select form-control validate" >
                <option value="">...</option>
                <option value="option1">Option 1</option>
                
            </select>
        </div>
        @error('position')
            <p class="text-danger mt-1">{{$message}}</p>
        @enderror
        <div class="col-6">
            <label  for="salary">Monthly Salary</label>
            <input class="form-control validate" type="number" name="monthly_salary" value="{{old('monthly_salary')}}">
        </div>
    </div>
    <div class="row g-1 mb-3">
        <div class="col-6">
            <label   for="tin">TIN number</label>
            <input class="form-control validate" type="number" name="tin_num" value="{{old('tin_num')}}">
        </div>
        @error('tin_num')
             <p class="text-danger mt-1">{{$message}}</p>
        @enderror
        <div class="col-6">
            <label for="salary">Employee Number</label>
            <input class="form-control validate" type="number" name="employee_num" value="{{old('employee_num')}}">
        </div>
        @error('employee_num')
                <p class="text-danger mt-1">{{$message}}</p>
        @enderror
    </div>
    <div class="row g-1 mb-3">
        <div class="col-6">
            <label  for="appointmentStatus">Status of Appointment</label>
            <select name="appointment_status" class="form-select form-control validate" aria-label="Default select example">
                <option value="casual">Casual</option>
                <option value="permanent">Permanent</option>
            </select>
        </div>
        @error('appointment_status')
            <p class="text-danger mt-1">{{$message}}</p>
        @enderror
        <div class="col-6">
            <label for="salary">Date of Appointment in BU.</label>
            <input class="form-control validate" type="date" name="bu_appointment_date" value="{{old('bu_appointment_date')}}">
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
        <input class="form-control validate" type="number" name="monthly_contribution" value="{{old('monthly_contribution')}}">
    </div>
    @error('monthly_contribution')
    <p class="text-danger mt-1">{{$message}}</p>
@enderror
</div>