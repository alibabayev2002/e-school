@extends('layouts.app')
@section('content')
    <form action="{{route('first.module.post')}}" method="post">
        @csrf
        <input  name="stringIds" type="hidden" value="{{$stringIds}}">
        <input  name="from" type="hidden" value="{{$from}}">
        <input  name="to" type="hidden" value="{{$to}}">
        <input  name="subjectId" type="hidden" value="{{$subjectId}}">
        <div class="card mt-5">

            <div class="card-header text-center">Cədvəl</div>

            <div class="mark-table">
                <div class="column-header py-3">
                    <span style="width:250px;" class="border px-5 text-center">Ad</span>
                        <span class="border text-center">{{$user}}</span>
                </div>
                <div class="clear"></div>
                <div class="py-3" style="overflow-x:scroll;flex-wrap:nowrap;display:flex;">
                <div class="mark-table-student-names  px-1 row m-0 justify-content-end text-center">

                    <div class="column-header">
                        <div style="overflow:scroll;" class="row m-0">
                            @foreach($period as $date)
                                <span class="border col px-3">{{$date->format('Y-m-d')}}</span>
                            @endforeach
                        </div>
                        <div class="column-header">
                            @foreach($arr as $id=>$item)
                                <div class="row m-0">
                                    @foreach($item as $date=>$val)
                                        <div style="box-sizing:border-box;" class="col  border px-5">
                                                <input name="{{$id.':'.$date}}" value="{{$val}}" type="text" class="mark-input bg-success px-0 text-white text-center @if($val==0) bg-dark @endif ">
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            {{--                @endforeach--}}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary mx-auto my-0 mb-2" value="Yadda saxla!">

        </div>

    </form>
    <style>

    </style>
@endsection
