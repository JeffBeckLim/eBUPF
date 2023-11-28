<!doctype html>
<html lang="en">
@php
    use App\Models\Loan;
    use App\Models\Payment;
    use App\Models\CoBorrower;

    $user = Auth::user();
    $loans = Loan::where('member_id', $user->member->id)->where('is_active', 1)->get();
    //get members additional_loan column
    $additionalLoan = $user->member->additional_loan;

    //get all mpl and hsl loans
    $mplLoans = Loan::where('member_id', $user->member->id)->where('loan_type_id', 1)->where('is_active', 1)->get();
    $hslLoans = Loan::where('member_id', $user->member->id)->where('loan_type_id', 2)->where('is_active', 1)->get();

    //get all payments for mpl and hsl loans, grouped by loan_id
    $mplPayments = Payment::where('member_id', $user->member->id)
    ->whereIn('loan_id', $mplLoans->pluck('id'))
    ->get()
    ->groupBy('loan_id');

    $hslPayments = Payment::where('member_id', $user->member->id)
    ->whereIn('loan_id', $hslLoans->pluck('id'))
    ->get()
    ->groupBy('loan_id');

    //get total payments for mpl and hsl loans, by grouping the payments by loan_id and summing the interest and principal
    $totalPaymentsMPL = $mplPayments->map(function ($payments) {
        $totalInterest = $payments->sum('interest');
        $totalPrincipal = $payments->sum('principal');
        return $totalInterest + $totalPrincipal;
    });

    $totalPaymentsHSL = $hslPayments->map(function ($payments) {
        $totalInterest = $payments->sum('interest');
        $totalPrincipal = $payments->sum('principal');
        return $totalInterest + $totalPrincipal;
    });

    $inActiveLoan = CoBorrower::with(
        'member.units.campuses',
        'loan.member.units.campuses',
        'loan.loanApplicationStatus.loanApplicationState',
        'loan.loanType'
    )
    ->whereHas('loan', function ($query) {
        $query->where(function ($query) {
            $query->where('member_id', Auth::user()->member->id)
                ->orWhereNull('member_id')
                ->orWhere('member_id', 0);
        })
        ->where(function ($query) {
            $query->where('is_active', 0)
                ->orWhereNull('is_active');
        });
    })->first();

    $mplTotalAmount = 0;
    $hslTotalAmount = 0;

    // Get total amount of all loans
    foreach ($loans as $loan) {
        if ($loan->loan_type_id == 1) {
            $mplTotalAmount += ($loan->principal_amount + $loan->interest);
        } elseif ($loan->loan_type_id == 2) {
            $hslTotalAmount += ($loan->principal_amount + $loan->interest);
        }
    }

    $mplTotalBalance = $mplTotalAmount;
    $hslTotalBalance = $hslTotalAmount;

    // Get total balance of all loans
    foreach ($loans as $loan) {
        if(isset($totalPaymentMPL) && isset($totalPaymentMPL[$loan->id])){
        $mplTotalBalance -= $totalPaymentMPL[$loan->id];
    }
    if(isset($totalPaymentHSL) && isset($totalPaymentHSL[$loan->id])){
        $hslTotalBalance -= $totalPaymentHSL[$loan->id];
        }
    }

    // Check if all MPL loans have been paid 50%
    $allMPLPaid50Percent = $mplLoans->isEmpty() || $mplLoans->every(function ($loan) use ($totalPaymentsMPL) {
        return isset($totalPaymentsMPL[$loan->id]) && $totalPaymentsMPL[$loan->id] >= 0.5 * ($loan->principal_amount + $loan->interest);
    });

    // Check if all HSL loans have been paid 50%
    $allHSLPaid50Percent = $hslLoans->isEmpty() || $hslLoans->every(function ($loan) use ($totalPaymentsHSL) {
        return isset($totalPaymentsHSL[$loan->id]) && $totalPaymentsHSL[$loan->id] >= 0.5 * ($loan->principal_amount + $loan->interest);
    });

    // Determine if the MPL and HSL apply buttons should be disabled
    // MPL is disabled if there is an active loan or if all MPL loans have not been paid 50% and
    $mplDisabled = !empty($inActiveLoan) || !$allMPLPaid50Percent && ($additionalLoan == 0 || $additionalLoan == null || $additionalLoan == 2 && $additionalLoan != 3);
    $hslDisabled = !empty($inActiveLoan) || !$allHSLPaid50Percent && ($additionalLoan == 0 || $additionalLoan == null || $additionalLoan == 1 && $additionalLoan != 3);

@endphp


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eBUPF</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/BU-logo.png') }}" type="image/x-icon">


    {{-- DATA TABLE .NET --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



</head>
<style>
    .modal-backdrop{
        width: 100%;
        height: 100%;
    }
</style>

<body class="p-0 m-0 border-0 overflow-x-hidden">


    {{---------------------------------------
        MAke sure that this two components have identical links and assets being used.
     -------------------------------------}}

    @include('member-components.member-layout-offcanvas')
    <div class="row">

    @include('member-components.member-layout-inPageSidebar')


    <!-- MAIN CONTENT GOES HERE -->
    <div id="content" class="col m-0 scrollable-content">
        @include('member-components.session-timeout-modal')
        @yield('content')
    </div>

    </div>

    <script>



        var modal = document.getElementById("profileMyModal");
        var link = document.getElementById("profileOpenModalLink");

        link.onclick = function () {
            modal.style.display = "block";
        };

        var closeBtn = document.getElementsByClassName("profile-close")[0];
        var modalCloseBtn = document.getElementsByClassName("modal-profile-close")[0];

        closeBtn.onclick = function () {
            modal.style.display = "none";
        };
        modalCloseBtn.onclick = function () {
            modal.style.display = "none";
        };

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
</body>

</html>
<script>
    // Get all accordion buttons
    const accordionButtons = document.querySelectorAll('.accordion-button');

    // Add event listeners to each button
    accordionButtons.forEach(button => {
    button.addEventListener('click', () => {
        const target = document.querySelector(button.getAttribute('data-bs-target'));
        const collapses = document.querySelectorAll('.accordion-collapse');

        // Close all collapsible elements except the one being opened
        collapses.forEach(collapse => {
            if (collapse !== target && collapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(collapse);
                bsCollapse.hide();
                }
            });
        });
    });

    // Timer function to show the modal before session timeout
    function startSessionTimer() {
       // const sessionTimeout = session.lifetime * 60 * 1000;
        const sessionTimeout = {{ config('session.lifetime') }} * 60 * 1000;

        setTimeout(function () {
            $('#sessionTimeoutModal').modal('show');
        }, sessionTimeout);
    }

    // Start the timer when the page loads or user logs in
    document.addEventListener('DOMContentLoaded', function () {
        startSessionTimer();
    });

</script>
