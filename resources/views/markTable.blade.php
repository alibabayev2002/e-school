@extends('layouts.app')
@section('content')

    @if(!isset($table))
        <div class="container w-50">
            @if(isset($error) || !empty($errors->all()))
                <div class="alert alert-danger mt-3" role="alert">
                    Axtardığınız məlumat tapılmadı !
                </div>
            @endif
            <div class="card mt-3">
                <div class="card-header">
                    Qiymet cədvəli
                </div>

                <div class="card-body">
                    <form method="get" action="{{route('get.markTable')}}">
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Şagird seçimi</label>
                            <select name="student_id[]" multiple class="form-control" id="exampleFormControlSelect2">
                                @foreach($students as $student)
                                    <option value="{{$student->id}}">{{$student->full_name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Fənn seçimi</label>
                            <select name="subject_id[]" multiple class="form-control" id="exampleFormControlSelect2">
                                @foreach($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Başlanğıc tarix</label>
                            <input type="date" class="form-control mb-4" name="first_date" id="">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Son tarix</label>
                            <input type="date" class="form-control mb-4" name="last_date" id="">
                            <span class="text-muted my-0 mb-1">İnterval maks. 60 gün olmalıdır</span>
                        </div>

                        <input type="submit" class="form-control btn btn-primary" value="Göstər">
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="card mt-5">
            <div class="card-header text-center">Cədvəl</div>

            <div class="mark-table">
                <div class="mark-table-student-names border border-dark row m-0 justify-content-end text-center">
                    <span class=" ">Tarix -></span>
                    <span class=" ">Ad/Fənn</span>
                    @foreach($all_students as  $name)
                        <span>{{$name}}</span>
                    @endforeach
                </div>
                @foreach($arr as $date => $students)
                    <div class="border border-dark" style="display:flex;flex-direction:column;text-align:center;">
                        <span >{{$date}}</span>

                        <div class="table-row p-0">

                            @foreach($students as $subject=>$mark_arr)
                                <div class="subject col p-0">
                                    <span class="px-2 border">{{$subject}}</span>
                                    @if(is_array($mark_arr) || is_object($mark_arr))
                                        @foreach($mark_arr as $student=>$mark)
                                            <span> {{$mark}}</span>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

    @endif

@endsection
