<div class="table-responsive">
    <div class="custom-table-for-admin">

        <table class="table table-borderless  table-striped " id="logs-table" style="font-size: 12px">
            <thead style="border-bottom: 2px solid black" >
                <tr>
                    <th>ID</th>
                    <th>Time Updated</th>

                    <th>Principal Borrower</th>
                    <th>Loan ID</th>

                    <th>Penalty Payment Amount</th>
                    <th>Payment Date</th>

                    <th>OR Number</th>
                </tr>
            </thead>
            <tbody>
                @if($penaltyPaymentLogs != null)
                    @foreach($penaltyPaymentLogs as $penaltyPaymentLog)
                        <tr>
                            <td>{{$penaltyPaymentLog->id}}</td>
                            <td>{{$penaltyPaymentLog->updated_at->format('M-d-Y (h:i:s A)')}}</td>
                            <td>
                                {{$penaltyPaymentLog->penalty->loan->member->firstname}}
                                @if($penaltyPaymentLog->penalty->loan->member->middlename != null)
                                    {{$penaltyPaymentLog->penalty->loan->member->middlename}}
                                @endif
                                {{$penaltyPaymentLog->penalty->loan->member->lastname}}
                            </td>
                            <td>{{$penaltyPaymentLog->penalty->loan->id}}</td>
                            <td>Php {{ number_format($penaltyPaymentLog->penalty_payment_amount_log, 2) }}</td>
                            <td>{{$penaltyPaymentLog->payment_date_log}}</td>
                            <td>{{$penaltyPaymentLog->or_number_log}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No data available in table</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    </div>
