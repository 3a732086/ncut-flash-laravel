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
            <div class="card-body">
                <?php
                    $result[0]=str_replace('"', '', $result[0]);  
                    $result[0]=str_replace('[', '', $result[0]);  
                    $result[0]=str_replace(']', '', $result[0]);  
                    $temp = explode("," , $result[0]);
                    // echo $temp[0];
                ?>

                <h3>學生選錯的答案</h3>


                @for($i=0 ; $i < count($temp) ; $i++)
                <div class="row">
                    <h1 class="display-4">{{$temp[$i]}}</h1>
                    <?php $i++; ?>
                    <h1 class="display-4">=></h1>
                    <h1 class="display-4">{{$temp[$i]}}</h1>
                </div>   
                @endfor
            </div>         
        </div>
    </div>
@stop