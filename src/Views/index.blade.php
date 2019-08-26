@extends("crudbooster::dev_layouts.layout")
@section("content")

    <div align="right">
        <a href="javascript:;" onclick="goToUrlWithConfirmation('{{ cb()->getDeveloperUrl("plugins/LaravelLogReader/clear-log") }}','Do you want to clear log files?')" class="btn btn-danger"><i class="fa fa-trash"></i> Clear Log</a>
    </div>

    <div class="box box-primary mt-10">
        <div class="box-header">
            <h1 class="box-title with-border">Browse Log</h1>
        </div>
        <div class="box-body">
            <table id="table-log" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Level</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=0; @endphp
                    @foreach($result as $log)
                    <tr>
                        <td style="white-space: nowrap">{{ $log->date->format("Y-m-d H:i:s") }}</td>
                        <td>{{ $log->level }}</td>
                        <td>{{ $log->context->message }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row">
                <div class="col-sm-6">
                    {!! $result->links() !!}
                </div>
                <div class="col-sm-6">
                    <?php
                    $from = $result->count() ? ($result->perPage() * $result->currentPage() - $result->perPage() + 1) : 0;
                    $to = $result->perPage() * $result->currentPage() - $result->perPage() + $result->count();
                    $total = $result->total();
                    ?>
                    <div align="right">
                        <button style="margin-top: 20px" class="btn btn-default disabled" type="button">
                            {{ cbLang("pagination_footer_total_data",[
                                "from"=>$from,
                                "to"=>$to,
                                "total"=>$total
                                ]) }}
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection