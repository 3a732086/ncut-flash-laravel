@extends('admin.layouts.template')

@section('title', '學生活動紀錄')

@section('script')
    <script src="{{ asset('global_assets/js/demo_pages/datatables_extension_buttons_print.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/extensions/select.min.js')}}"></script>
@stop

@section('content')
    <div class="row">
        <div class="card col-lg">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">學生活動紀錄</h5>
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
                        <td>最近登入時間</td>
                        <td>姓名</td>
                        <td>學號</td>
                        <td>編號</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($result as $user)
                        <tr>
                        <td>{{$user->updated_at}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->class}}</td>
                        <td>{{$user->id}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-center mt-2">
        <a class="btn btn-success" href="{{route('Useractivity2xls')}}">匯出</a>
    </div>
@stop
