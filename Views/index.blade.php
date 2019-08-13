@extends("crudbooster::dev_layouts.layout")
@section("content")

    <div align="right">
        <a href="javascript:;" onclick="goToUrlWithConfirmation('','Do you want to clear log files?')" class="btn btn-danger"><i class="fa fa-trash"></i> Clear Log</a>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h1 class="box-title with-border">Show Latest Log Data ({{ count($result) }})</h1>
        </div>
        <div class="box-body">
            <table id="table-log" class="table datatable">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="30%">Log Time</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=0; @endphp
                    @foreach($result as $i=>$log)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $log['time'] }}</td>
                        <td><a title="Click to see detail" href="javascript:;" onclick="showDetailLog(this)">
                            <code>{{ $log['description'] }}</code></a>
                            <div style="display: none" class="detail">
                                Stack Trace: <br>
                                <code style="font-size: 11px">{!!  implode("<br/>", $log['detail']) !!}</code>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push("bottom")
        <script>
            function showDetailLog(t) {
                $("#table-log .detail").hide()
                $(t).next(".detail").fadeIn()
            }
        </script>
    @endpush

@endsection