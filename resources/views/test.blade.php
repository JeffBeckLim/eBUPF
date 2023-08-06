<html>
    <h1><strong>MEMBER DETAILS</strong></h1>
    <br>
    Member id:{{Auth::user()->member->id}}<br>
    User_id:{{Auth::user()->id}}<br>
    {{$member_unit->unit_code}}<br>
    {{$member_unit->campuses->campus_code}}<br>
    {{Auth::user()->member->firstname}}<br>
    {{Auth::user()->member->middle_initial}}<br>
    {{Auth::user()->member->lastname}}<br>
    {{Auth::user()->member->sex}}<br>
    {{Auth::user()->member->contact_num}}<br>
    {{Auth::user()->member->address}}<br>
    {{Auth::user()->member->date_of_birth}}<br> 
    {{Auth::user()->member->place_of_birth}}<br>
    {{Auth::user()->member->tin_num}}<br>
    {{Auth::user()->member->position}}<br>
    {{Auth::user()->member->employee_num}}<br>
    {{Auth::user()->member->bu_appointment_date}}<br>
    {{Auth::user()->member->civil_status}}<br>
    {{Auth::user()->member->spouse}}<br>
    
    <h3>Beneficiary</h3>
    @foreach ($beneficiaries as $beneficiary)
        {{$beneficiary->beneficiary_name}}<br>
        {{$beneficiary->birthday}}<br>
        {{$beneficiary->relationship}}<br>
        <br>
        ---------------------------------
        <br>
    @endforeach

</html>