@extends('admin.layouts.template')

@section('title', '課程編輯')

@section('script')
	<script src="{{ asset('global_assets/js/demo_pages/form_inputs.js')}}"></script>
@stop


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('coursetopic.update',$query[0]->number)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group row">
                    <div class="col-lg-6">
                        <h3 class="text-center"><label for="english">English</label></h3>
                        <textarea class="form-control" id="content" name="eng_topic" rows="10" style="font-size:20pt">{{$query[0]->eng_topic}}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="text-center"><label for="chinese">Chinese</label></h3>
                        <textarea class="form-control" id="content" name="chi_topic" rows="10" style="font-size:20pt">{{$query[0]->chi_topic}}</textarea>
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
                            <source id="source" src="{{asset('data/FOLDER'.($cid-1).'/LS/PAUL/'.($query[0]->number-1).'.mp3')}}" type="audio/ogg">
                        </audio>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="送出">
                        <input type="hidden" name="cid" value="{{$cid}}">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
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