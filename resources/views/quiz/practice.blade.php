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
        background-image:url('{{asset('img/quiz/英文單字版.png')}}');
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
        var temp=[];
        $(document).ready(function() {
            @if(Request::get('id'))
                query_url ="{{route('practice_data' ,Request::get('id'))}}";
            @else
                query_url="{{route('practice_data' ,1)}}";
            @endif
            $.get(query_url, function(data){
                // re =data;
                console.log(data);
                for(var i = 0 ; i<data[0].length ; i++){
                    $("#"+data[0][i]).val(data[2][i]);
                    $("#"+data[0][i]).text(data[1][i]);
                }

            });
            var score = 0;
            var total_quiz = 0;
            var fail=[] ;
            var submit = false;
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
                            score+=10;
                            total_quiz = total_quiz+1;
                            console.log(total_quiz);
                            $(".badge").text(score);
                            if(total_quiz == 5){
                                submit = true;
                                var ask = window.confirm("Are you sure you want to delete this post?");
                                if (ask) {
                                    window.location.href = "quiz";

                                }
                            }
                        }else{
                            fail.push(temp[0].text());
                            fail.push(temp[1].text());
                            $('button[value='+temp[0].val()+']').attr('disabled' ,true);
                            $('button[value='+temp[1].val()+']').attr('disabled' ,true);

                            $('button[value='+temp[0].val()+']').css('border', '1px solid black');
                            $('button[value='+temp[1].val()+']').css('border', '1px solid red');
                            // console.log(fail);
                            // i=i+1;
                        }
                        
                    }
                    temp.length = 0;
                }
            });  
            var counter = 20;
                var interval = setInterval(function() {
                    counter--;
                    // Display 'counter' wherever you want to display it.
                    if (counter <= 0) {
                        clearInterval(interval);
                        $('#clock').text("Times Up");
                        alert('Times Up');  
                        return;
                    }else{
                        $('#clock').text(counter+"秒");
                        console.log("Timer --> " + counter);
                    }
                }, 1000);
            });

    </script>

</body>
</html>