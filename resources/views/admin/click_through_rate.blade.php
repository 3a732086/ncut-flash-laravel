@extends('admin.layouts.template')

@section('title', '學生點擊狀況紀錄')

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
                <h5 class="card-title">學生點擊狀況紀錄</h5>
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
                    <td>Name</td>
                    @foreach($courses as $course)
                    <td>{{$course->name}}</td>
                    @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($result as $data)
                        <tr>
                        @for ($i = 0; $i < count($data); $i++)
                            <td>{{$data[$i]}}</td>
                        @endfor
                        </tr>
                    @endforeach                          
                </tbody>        
            </table>
        </div>
    </div>
@stop