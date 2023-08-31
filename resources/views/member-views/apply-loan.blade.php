@extends('member-components.member-layout')

@section('content')

<main >      
    <div class="container loan-apps-container">
        <div class="row loans-to-apply gap-2">
            <div class="col-sm-4 apply-loan-border">
                <div class="row mb-3">
                    <div class="col-9">
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="fs-7">Apply for</div>
                            </div>
                            <div class="col-12">
                                <div class="fw-bold fs-6">Multi-Purpose Loan</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 d-flex justify-content-end">
                        <img class="img-fluid" src="{{asset('icons/MPL-mini.svg')}}" alt="mpl mini" width="40px">
                    </div>
                </div>
                <div style="text-indent: 3em; text-align: justify;" class="fs-7">Proin semper nisi vel ante lacinia, vel molestie elit ornare. Nam quis sapien vel massa commodo consectetur vel nec urna.</div>
                <div class="d-flex justify-content-end">
                    <a href="/member/mpl-application-form/" type="button" class="btn apply-loan-btn">Apply</a>
                </div>
            </div>

            <div class="col-sm-4 apply-loan-border">
                <div class="row mb-3">
                    <div class="col-9">
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="fs-7">Apply for</div>
                            </div>
                            <div class="col-12">
                                <div class="fw-bold fs-6">Housing Loan</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 d-flex justify-content-end">
                        <img class="img-fluid" src="{{asset('icons/HSl-mini.svg')}}" alt="mpl mini" width="40px">
                    </div>
                </div>
                <div style="text-indent: 3em; text-align: justify;" class="fs-7">Proin semper nisi vel ante lacinia, vel molestie elit ornare. Nam quis sapien vel massa commodo consectetur vel nec urna.</div>
                <div class="d-flex justify-content-end">
                    <a href="/member/hsl-application-form/" type="button" class="btn apply-loan-btn">Apply</a>
                </div>
            </div>
        </div>
    </div>


</main>

@endsection
