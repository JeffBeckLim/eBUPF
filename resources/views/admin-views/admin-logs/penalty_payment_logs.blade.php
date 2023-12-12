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
                                @php
                                    dd($penaltyPaymentLog->penalty->member)
                                @endphp
                            </td>
                            <td>4</td>
                            <td>5</td>
                            <td>d</td>
                            <td>d</td>
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
