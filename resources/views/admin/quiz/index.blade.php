@extends('admin.layouts.template')

@section('title', 'Yellow')

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
                <h5 class="card-title">Yellow</h5>
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
                        <td>No.</td>
                        <td>Verb</td>
                        <td>Noun</td>
                        <td>Adjective</td>
                        <td>Adverb</td>
                        <td>備註</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($yellow_data as $data)
                        <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->Verb}}</td>
                        <td>{{$data->Noun}}</td>
                        <td>{{$data->Adjective}}</td>
                        <td>{{$data->Adverb}}</td>
                        <td>
                            <form action="{{route('yellow.edit' , $data->id)}}" method="get" style="margin-top: 0px;margin-bottom: 0px;">
                                <button title="編輯單字" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="remove">
                                    <i class="icon-pencil3" ></i>
                                </button>
                            </form>
                        </td>
                        </tr>
                    @endforeach                          
                </tbody>           
            </table>
        </div>
    </div>
    <!-- <div class="text-center mt-2 mb-4">
        <a class="btn btn-success" href="{{route('Useractivity2xls')}}">匯出</a>
    </div> -->

    <div class="row">
        <div class="card col-lg">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">新增詞彙(黃色區塊)</h5>
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
                <form action="{{route('yellow_word_insert')}}" method="post">
                    @csrf
                    <fieldset class="mb-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Verb:</label>
                                <input type="text" name="verb" class="form-control" placeholder="add">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Noun:</label>
                                <input type="text" name="noun" class="form-control" placeholder="addition">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Adjective:</label>
                                <input type="text" name="adjective" class="form-control" placeholder="additional">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Adverb:</label>
                                <input type="text" name="adverb" class="form-control" placeholder="additionally">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="audio_url" name="audiourl" value="">
                    </fieldset>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">新增 <i
                            class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop