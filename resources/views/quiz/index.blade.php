<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>猜猜看</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('js/jquery.countdown.js')}}"></script>

    <style>
    body {
        background-image: url('{{asset('img/quiz/遊戲中畫面-01.png')}}');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    button.words {
        background-image: url('{{asset('img/quiz/英文單字版.png')}}');
        background-size: cover;
        width: 150px;
        height: 100px;
        border: none;
        background-color: #f0f8ff00;
    }

    button.timer {
        background-image: url('{{asset('img/quiz/計時.png')}}');
        background-size: cover;
        width: 150px;
        height: 100px;
        border: none;
        background-color: #f0f8ff00;
    }

    button.score {
        background-image: url('{{asset('img/quiz/分數.png')}}');
        background-size: cover;
        width: 150px;
        height: 100px;
        border: none;
        background-color: #f0f8ff00;
        color: #fff;
        font-weight: 700;
    }
    button.score >span {
        font-size: 100%;
    }
    .footer {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
    }
    </style>
</head>
<body>

    <div class="container-fluid ">

        <div class="row">
            <div class="col-auto mr-auto"></div>
            <div class="col-auto mt-0">
                <button id="clock" class="timer" style="color:#fff;padding-left: 30px;padding-top: 5px;" disabled></button>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-lg">
                <button id="btn1" class="words" value="1"></button>
                <button id="btn2" class="words" value="3"></button>
                <button id="btn3" class="words" value="2"></button>
                <button  id="btn4"class="words" value="5"></button>

                <button  id="btn5"class="words" value="3"></button>

                <button  id="btn6"class="words" value="4"></button>
                <button  id="btn7"class="words" value="2"></button>
                <button  id="btn8"class="words" value="4"></button>
                <button  id="btn9"class="words" value="1"></button>
                <button  id="btn10"class="words" value="5"></button>
                <div id="redirect_btn"></div>
            </div>
        </div>
    </div>
    <!-- <div id="getting-started"></div> -->
    <!-- <script type="text/javascript">
    $("#getting-started")
    .countdown("2020/10/29", function(event) {
        $(this).text(
        event.strftime('%D days %H:%M:%S')
        );
    });
    </script> -->
    <footer class="footer" id="sticky-footer">
        <div class="container text-center">
            <button class="score" disabled><span class="badge ml-4">0</span>分</button>
        </div>
    </footer>

    <script type="text/javascript">

        $(document).ready(function() {

            window.score = 0;
            window.fail=[] ;
            window.submit = false;
            var total_quiz = 0;
            var temp=[];
            var res_quiz = [];
            var color = 1;

            $.get("quiz/getyellow", function(data){
                // re =data;
                console.log(data);
                for(var i = 0 ; i<data[0].length ; i++){
                    $("#"+data[0][i]).val(data[2][i]);
                    $("#"+data[0][i]).text(data[1][i]);
                    res_quiz = data[1];
                }

            });

            // var i = 0;
            $("button").click(function() {
                temp.push($(this));
                console.log(temp);
                if(temp.length > 1){
                    // console.log(temp[0].text());
                    if(temp[0].attr('id') == temp[1].attr('id')){

                        temp.length = 0;
                    }else{
                        if(temp[0].val() == temp[1].val()){
                            console.log('yes');
                            temp[0].css('display','none');
                            temp[1].css('display','none');
                            window.score+=10;
                            total_quiz = total_quiz+1;
                            console.log(total_quiz);
                            $(".badge").text(window.score);
                            if(total_quiz == 5){
                                send_score(window.score, window.fail ,window.counter);
                                window.submit = true;
                                var ask = window.confirm("成功破關，是否要重新挑戰呢?");
                                if (ask) {
                                    window.location.href = "{{route('test')}}";
                                    return;
                                }
                                window.counter = 0;
                                // $( "#redirect" ).html( "<a href='{{route('quiz_show')}}' class='btn btn-info mr-2'>查看成績</a><a href='#' class='btn btn-info ml-2'>再玩一次</a>" );

                            }
                        }else{
                            window.fail.push(temp[0].text());
                            window.fail.push(temp[1].text());
                            $('button[value='+temp[0].val()+']').attr('disabled' ,true);
                            $('button[value='+temp[1].val()+']').attr('disabled' ,true);
                            switch(color){
                                case 1:
                                    $('button[value='+temp[0].val()+']').css('border', '2px solid black');
                                    $('button[value='+temp[1].val()+']').css('border', '2px solid red');
                                    color = color+1;
                                    break;
                                default:
                                    $('button[value='+temp[0].val()+']').css('border', '2px solid blue');
                                    $('button[value='+temp[1].val()+']').css('border', '2px solid orange');
                                    break;
                            }

                            // console.log(fail);
                            // i=i+1;
                        }

                    }
                    temp.length = 0;
                }
            });
                window.counter = 20;
                var timeless = true
                var interval = setInterval(function() {
                    window.counter--;
                    // Display 'counter' wherever you want to display it.
                    if (window.counter <= 0) {
                        clearInterval(interval);
                        $('#clock').text("Times Up");
                        if(!window.submit){
                            if(window.fail.length == 0){
                                alert('完全未作答。');
                                window.fail = res_quiz;
                            }
                            send_score(window.score, window.fail ,window.counter);
                            alert('Times Up');
                        }
                        $( "#redirect_btn" ).html( "<a href='{{route('quiz_show')}}' class='btn btn-info mr-2 mt-2'>查看成績</a><a href='{{route('test')}}' class='btn btn-info ml-2 mt-2'>再玩一次</a>" );
                        return;
                    }else{
                        if(timeless && window.counter < 10 && window.fail.length != 0){
                            $( "#redirect_btn" ).html( "<a href='#' onclick='btn_send()' class='btn btn-info mr-2 mt-2'>提早結束</a>" );
                            timeless = false;
                        }
                        $('#clock').text(window.counter+"秒");
                        // console.log("Timer --> " + counter);
                    }
                }, 1000);
        });
            function send_score(score , fail ,counter){
                $.post("/quiz/save", {
                    "_token":"{{ csrf_token() }}",
                    "user_id":"{{ Auth::user()->id }}",
                    "score": score,
                    "time":20-counter,
                    "fail":fail
                    },function(data){
                });
            }
            function btn_send(){
                window.submit = true;
                send_score(window.score , window.fail ,window.counter)
                window.counter = 0;
                return;
            }
    </script>

</body>
</html>
