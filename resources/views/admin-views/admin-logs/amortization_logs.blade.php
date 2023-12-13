<div class="table-responsive">
    <div class="custom-table-for-admin">

        <table class="table table-borderless  table-striped " id="logs-table" style="font-size: 12px">
            <thead style="border-bottom: 2px solid black" >
                <tr>
                    <th>ID</th>
                    <th>Time Updated</th>

                    <th>Loan ID</th>
                    <th>LOAN CODE</th>

                    <th>Principal-amort.</th>
                    <th>Interest-amort.</th>

                    <th>Start of Amort.</th>
                    <th>End of Amort.</th>

                    <th>Action</th>
                    {{-- <th>Changes</th> --}}

                    <th>Updated by</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loan_logs as $log)
                <tr>
                    <td>{{$log->id}}</td>
                    <td>{{$log->created_at->format('M-d-Y (h:i:s A)')}}</td>

                    <td>{{$log->loan_id_log}}</td>
                    <td>{{$log->loan_code_log}}</td>

                    <td>{{ number_format($log->amort_principal_log, 2) }}</td>
                    <td>{{ number_format($log->amort_interest_log, 2) }}</td>

                    @if($log->amort_start_log == null)
                        <td>Not Set</td>
                        <td>Not Set</td>
                    @else
                        <td>{{ date('F d, Y', strtotime($log->amort_start_log)) }}</td>
                        <td>{{ date('F d, Y', strtotime($log->amort_end_log)) }}</td>
                    @endif
                    <td class="fw-bold">{{$log->changes}}</td>
                    <td>
                        @php
                            $updated_by = App\Models\Member::find($log->updated_by);
                        @endphp
                        {{"ID: ".$updated_by->id." ".$updated_by->firstname." ".$updated_by->lastname}}
                    </td>


                  </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
