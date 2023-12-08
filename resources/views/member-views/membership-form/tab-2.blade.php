<div class="tab fade-in">
    <div class="row g-1">
                <div class="col-12">
                    <p class="fw-bold m-0">Department</p>
                </div>
                <div class="col-12 mb-3">
                    <label  for="">College/Unit & Campus</label>
                    <select name="unit_id" class="form-select form-control validate" >
                        <option class="text-secondary" value="" selected disabled>Choose Your College</option>

                        @foreach ($units as $unit)
                            <option value="{{$unit->id}}"  {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{$unit->unit_code}} : {{$unit->campuses->campus_code}}</option>
                        @endforeach

                    </select>

                </div>
                @error('unit_id')
                    <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
                @enderror
    </div>
    <div class="row g-1  mb-3  mt-2">
        <div class="col-12">
            <p class="fw-bold m-0">Employment</p>
        </div>

        <div class="col-6">
            <label class="fw-normal" for="position">Position</label>
            <input id="position" class="form-control validate" name="position" value="{{old('position')}}">
        </div>
        @error('position')
            <p class="text-danger mt-1">Position is needed</p>
        @enderror
        <div class="col-6">
            <label  for="salary">Monthly Salary</label>
            <input id="monthly_salary" class="form-control validate" type="number" name="monthly_salary" value="{{old('monthly_salary')}}">
        </div>
    </div>
    <div class="row g-1 mb-3">
        <div class="col-12 p-1" style="font-size: 12px">
            <i>Note: dashes in TIN and Employee Numbers are added automatically</i>
        </div>
        <div class="col-6">
            <label for="tin">TIN number</label>
            <input id="tin_num" class="form-control validate" type="text" name="tin_num" value="{{old('tin_num')}}" maxlength="16">
        </div>
        @error('tin_num')
             <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
        @enderror
        <div class="col-6">
            <label for="salary">Employee Number</label>
            <input id="employee_num" class="form-control" type="text" name="employee_num" value="{{old('employee_num')}}">
        </div>
        @error('employee_num')
                <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
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
            <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
        @enderror
        <div class="col-6">
            <label for="salary">Date of Appointment in BU.</label>
            <input id="bu_appointment_date" class="form-control validate" type="date" name="bu_appointment_date" value="{{old('bu_appointment_date')}}">
        </div>
        @error('bu_appointment_date')
            <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
        @enderror
    </div>
    <div class="col-12  mt-2">
        <div class="col-12">
            <p class="fw-bold m-0">Contribution</p>
        </div>
        <label for="salary">Fixed Monthly Contribution</label>
        <label for="salary"><i>For non-teaching staff, the minimum contribution is Php 100. Teaching staff are required to contribute a minimum of Php 300.</i></label>
        <input id="monthly_contribution" class="form-control validate" type="number" name="monthly_contribution" value="{{old('monthly_contribution')}}">
    </div>
    @error('monthly_contribution')
    <p class="text-danger mt-1"><i class="bi bi-exclamation-circle"></i> {{$message}}</p>
@enderror
</div>
<script>
    const employee_num = document.getElementById('employee_num');
    const employee_num_value = employee_num.value;
    
    employee_num.addEventListener('input', function(event) {
    let employee_num_event = event.target.value.replace(/\D/g, ''); // Remove non-digits
    
    // Add dashes after every 3 digits
    employee_num_event = employee_num_event.replace(/^(\d{4})(\d{3})(\d{1})/, '$1-$2-$3');
    
    // Update the input value with the formatted phone number
    event.target.value = employee_num_event;
    });
    
    const tin_num = document.getElementById('tin_num');
    const tin_num_value = tin_num.value;
    
    tin_num.addEventListener('input', function(event) {
    let tin_num_event = event.target.value.replace(/\D/g, ''); // Remove non-digits
    
    // Add dashes after every 3 digits
    tin_num_event = tin_num_event.replace(/(\d{3})(?=\d)/g, '$1-');
    
    // Update the input value with the formatted phone number
    event.target.value = tin_num_event;
    });
    
    </script>