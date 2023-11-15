<div class="table-responsive">
    <div class="custom-table-for-admin">
        
        <table class="table table-borderless  table-striped " id="logs-table" style="font-size: 12px">
            <thead style="border-bottom: 2px solid black" >
                <tr>
                    <th>ID</th>
                    <th>Time Updated</th>
                    <th>Loan ID</th>
                    <th>LOAN CODE</th>
                    <th>Loan Type</th>
                    <th>MPL/HSL</th>
                    <th>Principal</th>
                    <th>Interest</th>
                    <th>Term</th>
                    <th>State</th>
                    <th>Time Deleted</th>
                    <th>Changes</th>
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
                    <td>{{$log->loan_category_log}}</td>
                    <td>{{$log->loan_type_log}}</td>
                    <td>{{ number_format($log->principal_amount_log, 2, ".",",")}}</td>
                    <td>{{ $log->interest_log? number_format($log->interest_log,  2, ".",",") : '' }}</td>
                    <td>{{$log->term_years_log}}</td>
                    <td>
                        {{$log->is_active_log == 1 ?  "active" : ''}}
                        {{$log->is_active_log == 2 ?  "closed" : ''}}
                    </td>
                    <td>{{$log->deleted_at_log}}</td>
                    <td class="fw-bold">{{strtoupper($log->create_update_or_delete)}}</td>
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