@extends('admin.layouts.template')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-7">
            <div class="card">

                <div class="card-header header-elements-inline">
                    <h5 class="card-title">最近登入的使用者</h5>
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
                            <th>最近登入時間</th>
                            <th>姓名</th>
                            <th>學號</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($activite as $data)
                        <tr>
                            <td><span class="badge badge-success">{{$data->updated_at}}</span></td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->class}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-xl-5">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Members online -->
                    <div class="card bg-teal-400">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{$today_user}}</h3>
                                <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span>
                            </div>

                            <div>
                                今日拜訪人數
                                <div class="font-size-sm opacity-75">489 avg</div>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div id="members-online"></div>
                        </div>
                    </div>
                    <!-- /members online -->
                </div>
                <div class="col-lg-6">
                    <!-- Today's revenue -->
                    <div class="card bg-blue-400">
                        <div class="card-body">
                            <div class="d-flex">
                                <h3 class="font-weight-semibold mb-0">{{$today_data}}</h3>
                                <div class="list-icons ml-auto">
                                    <a class="list-icons-item" data-action="reload"></a>
                                </div>
                            </div>

                            <div>
                                今日練習量
                                <div class="font-size-sm opacity-75">37,578 avg</div>
                            </div>
                        </div>
                        <div id="today-revenue"></div>
                    </div>
                    <!-- /today's revenue -->
                </div>
            </div>

        </div>
        <!-- /form inputs -->

    </div>
@stop
