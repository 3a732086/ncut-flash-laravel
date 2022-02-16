@extends('admin.layouts.template')

@section('title', '用戶管理')

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
            <h5 class="card-title">用戶管理</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="zero_config" class="table datatable-button-print-rows">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>StudentID</th>
                        <th>Email</th>
                        <th>role</th>
                        <th>ps</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                @foreach ($profiles as $profile)
                <tr>
                    <td>{{$profile->id}}</td>
                    <td>{{$profile->name}}</td>
                    <td>{{$profile->class}}</td>
                    <td>{{$profile->email}}</td>
                    <td>{{$profile->role}}</td>
                    <td>
                        <form action="{{route('setting.destroy',$profile->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary" value="{{$profile->id}}" onclick="return confirm('確認刪除此筆資料嗎?');" name='delete'>刪除</button>
                            <button type="button" class="btnSelect  btn btn-danger " value="{{$profile->id}}" name='update' data-toggle="modal" data-target="#exampleModalLong1">修改</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">修改</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form1" class="form-horizontal" action="{{route('setting.update',1)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="uname">Username:</label>
                        <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" value="" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="class">Class:</label>
                        <input type="text" class="form-control" id="class" placeholder="Enter class" name="class" value="" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="mail">Email:</label>
                        <input type="text" class="form-control" id="mail" placeholder="Enter email" name="mail" value="" required disabled>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="form-group">
                        <label for="role">Role:</label>
                        <input type="text" class="form-control" id="role" placeholder="預設為0 1為使用者 2為管理者" name="role" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

// code to read selected table row cell data (values).
$("#myTable").on('click','.btnSelect',function(){
    // get the current row
    var currentRow=$(this).closest("tr");
    var col0=currentRow.find("td:eq(0)").html();
    var col1=currentRow.find("td:eq(1)").html(); // get current row 2nd table cell TD value
    var col2=currentRow.find("td:eq(2)").html(); // get current row 3rd table cell  TD value
    var col3=currentRow.find("td:eq(3)").html();
    var col4=currentRow.find("td:eq(4)").html();

    // $('#id1').val(col0);
    $('#uname').val(col1);
    $('#class').val(col2);
    $('#mail').val(col3);
    $('#role').val(col4);
    $('#form1').attr('action', "{{route("setting.update","")}}"+"/"+col0)
    // console.log($('#form1').attr('action', "{{route("setting.update","")}}"+"/"+col0));
    });
});
</script>

@stop
