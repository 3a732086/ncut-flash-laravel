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
        <h1 class="text-center mb-4">關卡選擇</h1>
            @for($i=1 ; $i<=9 ; $i++)
                <div class="row col-lg mb-4 d-flex justify-content-center">
                    <a href="{{route('practice')}}?id={{$i}}" class="btn btn-info btn-lg" width="50%">第{{$i}}關</a>
                </div>
            @endfor
    </div>


</body>
</html>