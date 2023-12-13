<div class="table-responsive">
    <div class="custom-table-for-admin">

        <table class="table table-borderless  table-striped " id="logs-table" style="font-size: 12px">
            <thead style="border-bottom: 2px solid black" >
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>IP Address</th>
                    <th>Operating System</th>
                    <th>Browser</th>
                    <th>User Agent</th>
                    <th>Date Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($session_logs as $session_log)
                <tr>
                    <td>{{$session_log->id}}</td>
                    <td>{{$session_log->user_id}}</td>
                    <td>{{$session_log->ip_address}}</td>
                    <td>{{$session_log->operating_system}}</td>
                    <td>{{$session_log->browser_used}}</td>
                    <td>{{$session_log->user_agent}}</td>
                    <td>{{$session_log->created_at->format('M-d-Y (h:i:s A)')}}</td>
                  </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
