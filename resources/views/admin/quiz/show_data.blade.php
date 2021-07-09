@extends('admin.layouts.template')

@section('title', '學生考試紀錄')

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
                <h5 class="card-title">學生考試紀錄</h5>
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
                        <td>最近作答時間</td>
                        <td>姓名</td>
                        <td>分數</td>
                        <td>作答時間(秒)</td>
                        <td>備註</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($result as $user)
                        <tr>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->score}}</td>
                        <td>{{$user->use_time}}</td>
                        <td>
                            @if( $user->fail != "null")
                            <form action="{{route('quiz_record')}}" method="get">
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button class="btn btn-success">作答紀錄</button>
                            </form>
                            @else
                                沒有錯誤紀錄
                            @endif
                        </td>
                        </tr>
                    @endforeach                          
                </tbody>           
            </table>
        </div>
    </div>

@stop