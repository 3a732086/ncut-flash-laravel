@extends('admin.layouts.template')

@section('title', '所有課程')

@section('script')
	<script src="{{ asset('global_assets/js/demo_pages/form_inputs.js')}}"></script>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <h2><label for="exampleFormControlSelect1">選擇要編輯的課程</label></h2>
                <select name="course" class="form-control" id="select1">
                    <option selected disabled >Select option</option>
                    @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">新增課程內容</h5>
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
                    <form action="{{route('coursetopic.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="mb-3">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">情境選擇</label>
                                <div class="col-lg-10">
                                    <select name="course" class="form-control" required>
                                        <option  disabled >Select option</option>
                                        @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">英文題目</label>
                                <div class="col-lg-10">
                                    <!-- <input type="text" class="form-control" name="name" required> -->
                                    <textarea name="eng" rows="6" cols="3" class="form-control" placeholder="Please input english content" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">中文題目</label>
                                <div class="col-lg-10">
                                    <textarea id="encodedResult" name="chi" rows="6" cols="3" class="form-control" placeholder="請輸入中文內容" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">選擇音檔</label>
                                <div class="col-lg-10">
                                    <input type="file" class="form-control-uniform-custom" name="voice" accept="audio/*">
                                    <span class="form-text text-muted">請勿上傳超過1MB的音檔</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"></label>
                                <div class="col-lg-10">
                                    <audio id="audio" controls style="width: 100%;">
                                        <source id="source" src="" type="audio/ogg"/>
                                    </audio>
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
        <div class="col-lg-8">
            <div id="view"></div>
        </div>
    </div>

    <script>
    var course_data;
    var course_id;
    $(document).ready(function(){
        $("#select1").change(function(){
            $("#view").empty();
            course_id = $(this).val();
            // console.log($(this).val());
            search_course(course_id);
        });
    });

    function search_course(id){
        $.post("/admin/coursetopic/getcourse", {
            "_token":"{{ csrf_token() }}",
            "id":id
            },function(data){
                course_data = data;
                view(course_data);
        });
    }

    function view(course_data){
        var view_topic='';
        
        var make_view_content='';

        for( var i = 0 ; i < course_data.length ; i++ ){
            // console.log(course_data[i]);
            make_view_content +=
            `<div class="col-md-6 col-lg-3 mb-4 sort-card">
                <div class="card border-secondary custom h-100" style="border:1px solid">
                <div class="card-header">
                    <h4><strong>No.`+course_data[i]['number']+`</strong></h4>
                </div>
                    <div class="card-body">
                        <h5><p class="card-text">`+course_data[i]['eng_topic']+`</p></h5>
                    </div>
                    <div class="card-footer text-muted">
                        <button class="button btn btn-success mb-2 mr-2" id="trt" value=`+course_data[i]['number']+`>編輯</button>
                    </div>
                </div>
            </div>`;
        }

        view_topic = `
        <div class="card">
            <div class="card-body">
                <div class="input-group mb-3">
                    <input class="form-control" type="search" placeholder="Search..." aria-label="Search" id="search">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-search4"></i></span>
                    </div>
                    <button class="btn btn-success" id="btnSort" type="button">Sort</button>
                </div>
                <div class="row sort">`
                    +make_view_content+
                `</div>
            </div>
        </div>
        `;
        $("#view").html(view_topic);
    }
    $(document).on('keyup', '#search', function(e) {
            $('.sort-card').removeClass('d-none');
            var filter = $(this).val(); // get the value of the input, which we filter on
            // $('.recipe-card').filter(function() {
            //     $(this).toggle($(this).find('h4').text().toLowerCase().indexOf(value) > -1)
            // });
            $('.sort').find('.card .card-header h4:not(:contains("'+filter+'"))').parent().parent().parent().addClass('d-none');
        });

    $(document).on('click', '#btnSort', function(e) {
        $('.sort .mb-4').sort(function(a,b) {
            return $(a).find(".h4").text() > $(b).find(".h4").text() ? 1 : -1;
        }).appendTo(".sort");

    });

    $(document).on('click', '#trt', function(e) {
        var url = "{{route('coursetopic.edit',':id')}}";
        url = url.replace(':id',$(this).val())+"?cid="+course_id;
        window.location.href =  url;      
    });

    var context = new AudioContext();
    var source = null;
    var audioBuffer = null;
    // Converts an ArrayBuffer to base64, by converting to string 
    // and then using window.btoa' to base64. 
    var bufferToBase64 = function (buffer) {
        var bytes = new Uint8Array(buffer);
        var len = buffer.byteLength;
        var binary = "";
        for (var i = 0; i < len; i++) {
            binary += String.fromCharCode(bytes[i]);
        }
        return window.btoa(binary);
    };
    var base64ToBuffer = function (buffer) {
        var binary = window.atob(buffer);
        var buffer = new ArrayBuffer(binary.length);
        var bytes = new Uint8Array(buffer);
        for (var i = 0; i < buffer.byteLength; i++) {
            bytes[i] = binary.charCodeAt(i) & 0xFF;
        }
        return buffer;
    };

    function initSound(arrayBuffer) {
        var base64String = bufferToBase64(arrayBuffer);
        var audioFromString = base64ToBuffer(base64String);
        // document.getElementById("encodedResult").value=base64String;
        context.decodeAudioData(audioFromString, function (buffer) {
            // audioBuffer is global to reuse the decoded audio later.
            audioBuffer = buffer;
            var buttons = document.querySelectorAll('button');
            buttons[0].disabled = false;
            buttons[1].disabled = false;

            data = "data:audio/mpeg;base64,"+base64String;
            var binary= convertDataURIToBinary(data);
            var blob=new Blob([binary], {type : 'audio/ogg'});
            var blobUrl = URL.createObjectURL(blob);
            // $('body').append('<br> Blob URL : <a href="'+blobUrl+'" target="_blank">'+blobUrl+'</a><br>');
            $("#audio_url").attr("value", blobUrl);
            $("#source").attr("src", blobUrl);
            $("#audio")[0].pause();
            $("#audio")[0].load();//suspends and restores all audio element
            $("#audio")[0].oncanplaythrough =  $("#audio")[0].play();

        }, function (e) {
            console.log('Error decoding file', e);
        });
    }
    // User selects file, read it as an ArrayBuffer and pass to the API.
    var fileInput = document.querySelector('input[type="file"]');
    fileInput.addEventListener('change', function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            initSound(this.result);
        };
        reader.readAsArrayBuffer(this.files[0]);
    }, false);
    // Load file from a URL as an ArrayBuffer.
    // Example: loading via xhr2: loadSoundFile('sounds/test.mp3');
    // function loadSoundFile(url) {
    //     var xhr = new XMLHttpRequest();
    //     xhr.open('GET', url, true);
    //     xhr.responseType = 'arraybuffer';
    //     xhr.onload = function (e) {
    //         initSound(this.response); // this.response is an ArrayBuffer.
    //     };
    //     xhr.send();
    // }

    function convertDataURIToBinary(dataURI) {
        var BASE64_MARKER = ';base64,';
        var base64Index = dataURI.indexOf(BASE64_MARKER) + BASE64_MARKER.length;
        var base64 = dataURI.substring(base64Index);
        var raw = window.atob(base64);
        var rawLength = raw.length;
        var array = new Uint8Array(new ArrayBuffer(rawLength));

        for(i = 0; i < rawLength; i++) {
        array[i] = raw.charCodeAt(i);
        }
        return array;
    }

    </script>
@stop
