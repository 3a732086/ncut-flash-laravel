@extends('admin.layouts.template')

@section('title', '學生作答紀錄')

@section('script')
    <script src="{{ asset('assets/js/app.js')}}"></script>
    <script src="{{ asset('global_assets/js/demo_pages/datatables_extension_buttons_print.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/extensions/select.min.js')}}"></script>
@stop

@section('content')
    <div class="row">
        <div class="card col-lg">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">學生作答紀錄</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <table class="table datatable-button-print-rows" style="font-size:16px">
                <thead>
                    <tr>
                        <th>#Name</th>
                        <th>StudentID</th>
                        <th>Scenes</th>
                        <th>Number</th>
                        <th>Data</th>
                        <th>Insert_time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $userdata)
                        <tr>
                            <td>{{$userdata->name}}</td>
                            <td>{{$userdata->class}}</td>
                            <td>{{$userdata->scenes}}</td>
                            <td>{{$userdata->topic}}</td>
                            <td>{{$userdata->inputdata}}</td>
                            <td>{{$userdata->inserted_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="text-center mt-2">
        <a class="btn btn-success" href="{{route('Userdata2xls')}}">匯出</a>
    </div>
@stop
