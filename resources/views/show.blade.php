@extends('layouts.app')


@section('content')
<div class="container">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#Name</th>
                    <th>Scenes</th>
                    <th>Number</th>
                    <th>Data</th>
                    <th>Insert_time</th>
                </tr>
            </thead>
            <tbody>
            @foreach($user->userdata as $userdata)
                <tr>
                <td>{{$user->name}}</td>
                <td>{{$userdata->scenes}}</td>
                <td>{{$userdata->topic}}</td>
                <td>{{$userdata->inputdata}}</td>
                <td>{{$userdata->inserted_at}}</td>
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