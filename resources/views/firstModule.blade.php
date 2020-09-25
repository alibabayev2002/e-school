@extends('layouts.app')
@section('content')
<br>
    <div class="container w-50">
        @if(isset($error) || !empty($errors->all()))
            <div class="alert alert-danger mt-2" role="alert">
                Axtardığınız məlumat tapılmadı !
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Qiymet yazılması
            </div>

            <div class="card-body">
                <form action="{{route('get.first.module')}}" method="get">
                    <select name="student" class="form-control" id="exampleFormControlSelect2">
                        <option selected disabled>Şagirdi seçin</option>
                        @foreach($students as $student)
                            <option value="{{$student->id}}">{{$student->full_name}}</option>
                        @endforeach

                    </select><br>
                    <select name="subject" class="form-control" id="exampleFormControlSelect2">
                        <option selected disabled>Fənni seçin</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach

                    </select><br>
                    <input type="date" class="form-control mb-4" name="first_date" id="">
                    <input type="date" class="form-control mb-4" name="last_date" id="">
                    <input type="submit" class="form-control mb-4" value="Göndər">
                </form>
            </div>
        </div>
    </div>
@endsection
