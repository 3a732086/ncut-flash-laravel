@extends('admin.layouts.template')

@section('title', '課程編輯')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('course.update',$query[0]->number)}}" method="POST">
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
                <audio controls>
                    <source src="horse.ogg" type="audio/ogg">
                    <source src="horse.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <div class="form-group row">
                    <div class="col-lg">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="送出">
                        <input type="hidden" name="cid" value="{{$cid}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop