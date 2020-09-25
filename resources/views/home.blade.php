@extends('layouts.app')
@section('content')
<div class="container mt-3">
    @empty(!$errors->all())
        <div class="alert alert-danger" role="alert">
            İnputu boş saxlamayın !
        </div>
    @endif
    <div class="row justify-content-between m-0">

        <div style="height:max-content;" class="card col-12 col-md-5 px-0">

            <div class="card-header">
                Şagirdlər
            </div>
            <div  class="card-body px-3">
                <form method="post" action="{{route('add.student')}}" class="row m-0 justify-content-between w-100">
                    @csrf
                    <div class="col-9 p-0">
                        <input name="student" placeholder="Şagirdin tam adı" type="text" class=" w-100 mx-0 form-control">

                    </div>
                    <div class="col-3 row m-0 justify-content-end">
                        <input value="+" type="submit" class="btn btn-primary px-4">
                    </div>
                </form>
                    <ul style="heigth:max-content;"  class="list-group p-0 m-0 mt-3 mb-3 w-100">
                        @foreach($students as $student)
                        <li class="list-group-item">
                            @if(isset($bool_edit) && $id == $student->id)
                                <form class="row justify-content-around" action="" method="post">
                                    @csrf
                                    <input class="form-control w-75 mx-0" type="text" value="{{$student->full_name}}" name="student">
                                    <input type="submit" class="btn btn-success" value="&#10004">
                                </form>
                            @else
                                <span>{{$student->full_name." (id : $student->id)"}}</span>
                                <a  class="text-white float-right mx-1 py-0 btn btn-danger" href="{{route('studentDelete',$student->id)}}">&#10007</a>
                                <a  class="text-white float-right py-0 btn btn-danger" href="{{route('studentEdit',$student->id)}}">&#9998;</a>
                            @endif
                        </li>
                        @endforeach
                            @if(count($students)==0)
                                <li class="list-group-item text-danger"> Şagird sayı 0 dır</li>
                            @endif
                            {{$students->appends(['students' => $students->currentPage(), 'subjects' => $subjects->currentPage()])->links('layouts.paginator')}}

                    </ul>
            </div>
        </div>
        <div class="card col-12 col-md-5 px-0">
            <div class="card-header w-100">
                Fənnlər
            </div>
            <div class="card-body px-3">
            <form method="post" action="{{route('add.subject')}}" class="row m-9 justify-content-between w-100">
                   @csrf <div class="col-9 p-0">
                        <input name="subject" placeholder="Fənnin adı" type="text" class=" w-100 mx-0 form-control">
                    </div>
                    <div class="col-3 float-rigth row m-0 justify-content-end">
                        <input value="+" type="submit" class="btn btn-primary px-4">
                    </div>
                </form>
                <div class="row m-0">
                    <ul class="list-group p-0 m-0 mt-3 w-100">
                        @foreach($subjects as $subject)
                            <li class="list-group-item">
                            @if(isset($bool_sub) && $id == $subject->id)
                                <form class="row m-0 justify-content-around" action="{{route('post.editSubject')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <input class="form-control w-75 mx-0" type="text" value="{{$subject->name}}" name="subject">
                                    <input type="submit" class="btn btn-success" value="&#10004">
                                </form>
                            @else
                                <span>{{$subject->name." (id : $subject->id)"}}</span>
                                <a  class="text-white float-right mx-1 py-0 btn btn-danger" href="{{route('subjectDelete',$subject->id)}}">&#10007</a>
                                <a  class="text-white float-right py-0 btn btn-danger" href="{{route('subjectEdit',$subject->id)}}">&#9998;</a>
                            @endif

                            </li>
                        @endforeach
                            @if(count($subjects)==0)
                                <li class="list-group-item text-danger"> Fənn sayı 0 dır</li>
                            @endif
                    </ul>
                    {{$subjects->appends(['students' => $students->currentPage(), 'subjects' => $subjects->currentPage()])->links('layouts.paginator')}}

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .row{
        margin:0;
    }
</style>
@endsection
