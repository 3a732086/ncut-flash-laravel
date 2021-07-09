@extends('admin.layouts.template')

@section('title', '情境編輯')

@section('script')
    <script src="{{ asset('global_assets/js/demo_pages/datatables_extension_buttons_print.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/extensions/select.min.js')}}"></script>
@stop

@section('content')
    <div class="row">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">情境編輯</h5>
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
                            <td>情境</td>
                            <td>新增時間</td>
                            <td class="text-center">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                            <td>{{$course->name}}</td>
                            <td>{{$course->inserted_at}}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="" method="post">
                                            <button class="dropdown-item"><i class="icon-file-pdf"></i>編輯情境</button>
                                                @csrf
                                                @method('GET')
                                            </form>
                                            <form action="{{ route('course.destroy',$course->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" onclick="return confirm('是否要刪除此情境?')"><i class="icon-file-excel"></i>刪除情境</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            </tr>
                        @endforeach                          
                    </tbody>           
                </table>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">新增情境</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="mb-4"></p>
                    <form action="{{route('course.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="mb-3">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">情境名稱</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            
                        </fieldset>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit <i
                                class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">隱藏情境</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                            <a class="list-icons-item" data-action="reload"></a>
                            <a class="list-icons-item" data-action="remove"></a>
                        </div>
                    </div>
                </div>

                <table class="table datatable-button-print-basic" style="font-size:16px">
                    <thead>
                        <tr>
                            <td>情境</td>
                            <td>新增時間</td>
                            <td class="text-center">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dis_courses as $course)
                            <tr>
                            <td>{{$course->name}}</td>
                            <td>{{$course->inserted_at}}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="{{ route('course.update',$course->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button class="dropdown-item" onclick="return confirm('是否要開放此情境?')"><i class="icon-file-excel"></i>開放情境</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            </tr>
                        @endforeach                          
                    </tbody>           
                </table>
            </div>
        </div> 
    </div>
@stop