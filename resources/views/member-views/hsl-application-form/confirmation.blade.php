@extends('member-components.member-layout')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 90vh;">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-4 card confirmation-card shadow-sm p-3" style="min-width: 350px;">
            <div class="row-12 d-flex justify-content-center align-items-center">
                <img src="{{asset('assets/check.png')}}" alt="check" class="check-mark">
            </div>
            <p class="fw-bold text-center mt-4">Request Sent!</p>
            <p class="warning2 mt4">Congrats! Form completed! Co-borrower requested. Once they accept, a printable file will be auto-generated with all info filled. Just print and sign. We'll notify you when it's ready. Thanks for using our service!</p>
            <p class="mt4 orga fw-normal">BU PROVIDENT FUND INC.</p>
            <a type="button" class="btn bu-orange text-light fw-bold w-100 mt-2" href="{{ route('outgoing.request') }}">Go to Request</a>
            <a href="/" class="w-100 border text-center mt-1 rounded">
                <button type="button" class="btn bhome w-100 fw-bold text-center">Back to Home</button>
            </a>    
        </div>
    </div>
</div>
@endsection
