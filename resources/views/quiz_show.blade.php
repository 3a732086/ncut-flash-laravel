@extends('layouts.app')


@section('content')
<div class="container">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#Name</th>
                    <th>分數</th>
                    <th>測驗時間</th>
                </tr>
            </thead>
            <tbody>
            @foreach($result as $data)
                <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->score}}</td>
                <td>{{$data->created_at}}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

</div>

<script src="{{ asset('js/datatables.min.js') }}"></script>
<script>
    /****************************************
    *       Basic Table                   *
    ****************************************/
    $('#zero_config').DataTable();

</script>

@stop