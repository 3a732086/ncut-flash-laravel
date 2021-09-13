@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="photo-box">
{{--            <div id="home" class="tab-pane active">--}}
{{--                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">--}}
{{--                    <ol class="carousel-indicators">--}}
{{--                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>--}}
{{--                    </ol>--}}
{{--                    <div class="carousel-inner">--}}
{{--                        <div class="carousel-item active">--}}
{{--                            <img class="d-block w-100" src="img/BackGround.jpg" alt="First slide">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">--}}
{{--                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                        <span class="sr-only">Previous</span>--}}
{{--                    </a>--}}
{{--                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">--}}
{{--                        <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                        <span class="sr-only">Next</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div style="text-align:center">
                @guest
                @else
                    @if(Auth::user()->role == 2)
                        <a type="button" href="{{route('coursetopic.index')}}" id="submit"
                           class="btn btn-primary btn-block btn-lg mt-2">編輯課程</a>
                    @else
                        <a type="button" href="lobby" id="submit" class="btn btn-primary btn-block btn-lg mt-2">開始</a>
                    @endif
                @endguest
            </div>

            <div class="row mt-4">
                <!-- Column -->
                <div class="col-sm-6 col-lg-3 mb-2">
                    <div class="card card-hover">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white">
                                <i class="fas fa-user"></i>
                            </h1>
                            <h4 class="text-white">總人數 {{$users}}</h4>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-sm-6 col-lg-3 mb-2">
                    <div class="card card-hover">
                        <div class="box bg-info text-center">
                            <h1 class="font-light text-white">
                                <i class="fas fa-book"></i>
                            </h1>
                            <h4 class="text-white">課程數 {{$courses}}</h4>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-sm-6 col-lg-3 mb-2">
                    <div class="card card-hover">
                        <div class="box bg-warning text-center">
                            <h1 class="font-light text-white">
                                <i class="fas fa-edit"></i>
                            </h1>
                            <h4 class="text-white">今日練習量 {{$today_data}}</h4>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-sm-6 col-lg-3 mb-2">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white">
                                <i class="fas fa-sign-in-alt"></i>
                            </h1>
                            <h4 class="text-white">今日登入人數 {{$today_user}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
