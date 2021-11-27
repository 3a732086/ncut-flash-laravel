@extends('admin.layouts.template')

@section('title', 'Blue')

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
                <h5 class="card-title">修改詞彙(藍色區塊)</h5>
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
                <form action="{{route('blue.update' , $data->id)}}" method="post">
                    @csrf
                    <fieldset class="mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>synonym(v):</label>
                                    <input type="text" name="verb" class="form-control" placeholder="add" value="{{$data->Verb}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>synonym(n):</label>
                                    <input type="text" name="noun" class="form-control" placeholder="addition" value="{{$data->Noun}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>synonym(adj):</label>
                                    <input type="text" name="adjective" class="form-control" placeholder="additional" value="{{$data->Adjective}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>synonym(adv):</label>
                                    <input type="text" name="adverb" class="form-control" placeholder="additionally" value="{{$data->Adverb}}">
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">修改 <i
                                class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
