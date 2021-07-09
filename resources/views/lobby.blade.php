@extends('layouts.app')

@section('content')
<div class="container">
<div class="mb-4">
            <ul id="myTab" role="tablist" class="nav justify-content-center nav-tabs nav-pills text-center bg-light border-0 rounded-nav">
                <li class="nav-item">
                    <a id="home-tab" data-toggle="tab" href="1" role="tab" aria-controls="home" aria-selected="true" class="nav-link border-0 font-weight-bold active " value="0" style="font-size:16px">{{$courses[0]->name}}</a>
                </li>
                @for($i = 1 ; $i < count($courses) ; $i++)
                <li class="nav-item">
                    <a id="profile-tab" data-toggle="tab" href="1" role="tab" aria-controls="profile" aria-selected="false" class="nav-link border-0 font-weight-bold" value="{{$i}}" style="font-size:16px">{{$courses[$i]->name}}</a>
                </li>
                @endfor   
            </ul>
            </div>


            
            <div id="myTabContent" class="tab-content" style="text-align:center">
                <h3 id="topic1" class="mb-3"></h3>
                <div class="input-group">
                    <textarea class="form-control" aria-label="With textarea" placeholder="在此輸入英文句子" rows="5" required></textarea>
                </div>
                <h3 id="topic2" class="mt-3"></h3>

                <audio id="audio" src="data/FOLDER0/LS/PAUL/1.mp3">Your browser does not support the audio element.</audio>

                <button type="button" class="btn btn-outline-dark btn-lg" onclick="prevpage()">上題</button>
                <button type="button" class="btn btn-outline-dark btn-lg" onclick="nextpage()">下題</button>
                <button type="button" class="btn btn-outline-primary btn-lg" onclick="playAudio()">複誦</button>
                <button type="button" class="btn btn-outline-secondary btn-lg" onclick="dictation()">默寫</button>
                <button type="button" class="btn btn-outline-success btn-lg" onclick="check()">核對</button>
                <button type="button" class="btn btn-outline-danger btn-lg" onclick="random()">抽題</button>
                <!-- <button type="button" class="btn btn-outline-info btn-lg">背誦</button> -->
                <div class="col-lg">
                    <button type="button" id="submit" class="btn btn-outline-dark btn-lg mt-2" onclick="submit()">繳交題目</button>
                </div>
            </div>


</div>
<script type="text/javascript">
    var x = document.getElementById("audio");
    var current_dir=0;
    var total_file;
    var scenes;
    var page=0;

    $(document).ready(function(){
        $.get("/getAllqa", function(data){
            total_file=data;
            current_dir=0;
            page=0;
            $("#topic1").text(page+1+"."+total_file[current_dir][page]['chi_topic']);
            $("#topic2").text(page+1+"."+total_file[current_dir][page]['eng_topic']);
            scenes = total_file[current_dir][page]['name'];
            dictation();
        });
        
        $('.nav-tabs').scrollingTabs({
            bootstrapVersion: 4,
            scrollToTabEdge: true,
            enableSwiping: true,
            disableScrollArrowsOnFullyScrolled: true,
        });
        $("#myTab .nav-link").click(function(){
            // console.log($(this).text());
            $("p").text($(this).text());
            scenes = $(this).text();
            current_dir=$(this).attr('value');

            page=0;//切換情境一律從第一題開始
            $("#topic1").text(page+1+"."+total_file[current_dir][page]['chi_topic']);
            $("#topic2").text(page+1+"."+total_file[current_dir][page]['eng_topic']);
            ctr($(this).val() , $(this).text());
            dictation();
            // console.log(Object.keys(total_file[current_dir]).length);
        });
    });

    function nextpage() {
        if(page<(Object.keys(total_file[current_dir]).length)-1){
            page++;
            $("#topic1").text(page+1+"."+total_file[current_dir][page]['chi_topic']);
            $("#topic2").text(page+1+"."+total_file[current_dir][page]['eng_topic']);
            dictation();
        }
        // console.log(totle_file[0][page][0]);
    }
    function prevpage() {
        if(page>0){
            page--;
            $("#topic1").text(page+1+"."+total_file[current_dir][page]['chi_topic']);
            $("#topic2").text(page+1+"."+total_file[current_dir][page]['eng_topic']);
            dictation();
            // console.log(totle_file[0][page][1]);
            // console.log(totle_file[0][page][0]);

        }
    }
    function dictation(){
        $("#topic2").text("默寫模式");
    }
    function check(){
        $("#topic2").text(page+1+"."+total_file[current_dir][page]['eng_topic']);
    }
    function random(){
        var temp = Object.keys(total_file[current_dir]).length;
        random_topic=Math.floor(Math.random()*temp);
        // console.log(current_dir);
        console.log(random_topic);
        $("#topic1").text(random_topic+1+"."+total_file[current_dir][random_topic]['chi_topic']);
        $("#topic2").text(random_topic+1+"."+total_file[current_dir][random_topic]['eng_topic']);
        dictation();
        page = random_topic;

    }
    function submit(){
        $('#submit').attr('disabled', true);
        var textarea = $("textarea").val();
        var topic = page+1;
        $.post("/insert", {
            "_token":"{{ csrf_token() }}",
            "scenes": scenes,
            "topic": topic,
            "text": textarea},function(data){
            // console.log(data);
            if(data.status){
                alert(data.code);
                $("textarea").val('');
                $('#submit').attr('disabled', false);
                nextpage();
            }else{
                alert(data.code);
                $('#submit').attr('disabled', false);
            }
        });
    }

    function ctr(value , text){
        // console.log(text);
        $.post("/ctr", {
            "_token":"{{ csrf_token() }}",
            "user_id":"{{Auth::id() }}",
            "scenes": text
            },function(data){
        });
    }
    
    function playAudio() {
        $("audio").attr('src',"data/FOLDER"+current_dir+"/LS/PAUL/"+(page+1)+".mp3");
        x = document.getElementById("audio");
        x.play();
    }


</script>


@stop
