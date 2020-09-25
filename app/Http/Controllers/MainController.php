<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Subject;
use App\Models\Mark;


class MainController extends Controller
{
    public function index(){
        $students = students::paginate(6,['*'],'students');
        $subjects = subject::paginate(6,['*'],'subjects');
        return view('home',['students'=>$students,"subjects"=>$subjects]);
    }
    public function add_student(request $request){
        $validatedData = $request->validate([
            'student' => 'required',
        ]);
        Students::insert(["full_name"=>$request->student]);
        return back();
    }
    public function add_subject(request $request){
        $validatedData = $request->validate([
            'subject' => 'required',
        ]);
        Subject::insert(["name"=>$request->subject]);
        return back();
    }
    public function view_first_module(){
        $students = Students::get();
        $subjects = Subject::get();
        return view('firstModule',['students'=>$students,'subjects'=>$subjects]);
    }
    public function insert_mark_list(request $request){
        $validatedData = $request->validate([
            'student' => 'required',
            'subject' => 'required',
            'first_date' => 'required',
            'last_date' => 'required',

        ]);
        $from = $request->first_date;
        $to = $request->last_date;
        $arr = [];
        $ids = [];
        $user;
        $students = Students::where('id', $request->student)->get();
        foreach ($students as $student) {
            $ids[] = $student->id;
            $user = $student->full_name;
            $all_marks = Mark::where("student_id", $request->student)->where("subject_id", $request->subject)->whereBetween('date', [$from, $to])->get();
            foreach ($all_marks as $markData) {
                $item2 = date("Y-m-d", strtotime($markData->date));
                $arr[$student->id][$item2] = $markData->mark;
            }
        }
        $begin = new \DateTime($from);
        $end = new \DateTime($to);
        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);
        foreach($period as $key=>$date){
            foreach($ids as $name=>$id){
                if(isset($arr[$id][$date->format('Y-m-d')])){
                    $returnArr[$id][$date->format('Y-m-d')] = $arr[$id][$date->format('Y-m-d')];
                }else{
                    $returnArr[$id][$date->format('Y-m-d')]=0;
                }
            }
        }
        if(isset($key) && isset($returnArr) && $key<61){
            return view('insertMark', ["arr" => $returnArr,'user'=>$user, "period" => $period, "ids" => $ids,'i'=>0, 'stringIds' => implode(',', $ids), "from" => $from, "to" => $to, 'subjectId' => $request->subject]);
        }else{
            $students = Students::get();
            $subjects = Subject::get();
            return view('firstModule',['error'=>true,'students'=>$students,'subjects'=>$subjects]);

        }
    }
    public function post_first_module(request $request){

        $ids = explode(',',$request->stringIds);
        $begin = new \DateTime($request->from);
        $end = new \DateTime($request->to);
        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);
        foreach($ids as $id){
            foreach($period as $date){
                $strDate = $date->format("Y-m-d");
                $inputName = $id.":".$strDate;
                if($request->input($inputName) >= 2 && $request->input($inputName) <= 5) {
                    $bool = Mark::where(['student_id' => $id, 'subject_id' => $request->subjectId])->whereDate("date", "=", $strDate)->delete();
                    Mark::insert([
                        "student_id" => $id,
                        "subject_id" => $request->subjectId,
                        "date" => $strDate,
                        "mark" => $request->input($inputName)
                    ]);
                }
            }
        }


        return back();
    }
    public function student_delete($id){
        Students::where('id',$id)->delete();
        Mark::where('student_id',$id)->delete();
        return back();
    }
    public function subject_delete($id){
        Subject::where('id',$id)->delete();
        Mark::where('subject_id',$id)->delete();
        return back();
    }
    public function student_edit($id){
        $students = students::paginate(6,['*'],'students');
        $subjects = subject::paginate(6,['*'],'subjects');
        return view('home',['bool_edit'=>true,'id'=>$id,'students'=>$students,"subjects"=>$subjects]);
    }
    public function post_student_edit($id,request $request){
        $validatedData = $request->validate([
            'student' => 'required',
        ]);
        $full_name = $request->student;
        Students::where('id',$id)->update([
            "full_name"=>$full_name
        ]);
        return redirect()->route('home');
    }
    public function mark_table(){
        $students = Students::get();
        $subjects = Subject::get();
        return view('markTable',['students'=>$students,'subjects'=>$subjects]);
    }
    public function get_mark_table(request $request){
        $validatedData = $request->validate([
            'first_date' => 'required',
            'last_date' => 'required',
        ]);
        $student_id = $request->student_id;
        $subject_id = $request->subject_id;
        $begin = new \DateTime($request->first_date);
        $end = new \DateTime($request->last_date);
        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);
        if(empty($student_id) && empty($subject_id)){
            $mark= Mark::whereBetween('date',[$request->first_date,$request->last_date])->get();
            $subjects= Subject::get();
            $students= Students::get();
        }
        else{
            if(empty($student_id) && !empty($subject_id)){
                $mark= Mark::whereIn('subject_id',$subject_id)->whereBetween('date',[$request->first_date,$request->last_date])->get();
                $students= Students::get();
                $subjects= Subject::whereIn('id',$subject_id)->get();
            }
            else{
                if (!empty($student_id) && empty($subject_id)){
                    $mark= Mark::whereIn('student_id',$student_id)->whereBetween('date',[$request->first_date,$request->last_date])->get();
                    $students= Students::whereIn('id',$student_id)->get();
                    $subjects= Subject::get();
                }
                else{
                    $mark= Mark::whereIn('student_id',$student_id)->whereIn('subject_id',$subject_id)->whereBetween('date',[$request->first_date,$request->last_date])->get();
                    $students= Students::whereIn('id',$student_id)->get();
                    $subjects= Subject::whereIn('id',$subject_id)->get();
                }
            }
        }
        $all_subjects = [];
        $all_students = [];
        foreach($subjects as $subject){
            $all_subjects[] = $subject->name;
        }
        foreach($students as $student){
            $all_students[$student->id] = $student->full_name;
        }
        $arr = [];
        foreach($arr as $key=>$val){
            foreach($all_subjects as $sub){
                foreach($students as $stud){
                    if(empty($val[$sub][$stud->id])){
                        $arr[$key][$sub][$stud->id] = 0;
                    }
                }
            }
        }
        foreach($period as $key=>$date){
            foreach($students as $stud){
                foreach($all_subjects as $sub) {
                    $arr[$date->format('Y-m-d')][$sub][$stud->id] = 0;

                }
            }
        }
        foreach($mark as $item){
            $itemDate =  date("Y-m-d", strtotime($item->date));
            $arr[$itemDate][$item->subject->name][$item->student->id] = $item->mark;
            if(!isset($count[$item->student->id])){
                $count[$item->student->id] = 1;
            }else{
                $count[$item->student->id]+=1;
            }
        }
        foreach($period as $key=>$date) {
            foreach ($students as $stud) {
                foreach ($all_subjects as $sub) {
                    if (isset($count[$stud->id])) {
                        if (!empty(($arr["Ortalama"][$sub][$stud->id]))) {
                            $arr["Ortalama"][$sub][$stud->id] += (($arr[$date->format('Y-m-d')][$sub][$stud->id]) / $count[$stud->id]);
                        } else {
                            $arr["Ortalama"][$sub][$stud->id] = (($arr[$date->format('Y-m-d')][$sub][$stud->id]) / $count[$stud->id]);
                        }
                    }
                    else{
                        $arr["Ortalama"][$sub][$stud->id] = 0;
                    }
                }
            }
        }
        if(isset($key) && $key<61) {
            return view('markTable', ['arr' => $arr, 'table' => true, 'i' => 0 , 'all_students' => $all_students]);
        }else{
            $students = Students::get();
            $subjects = Subject::get();
            return view('markTable',['students'=>$students,'subjects'=>$subjects,'error'=>true]);
        }
    }

    public function subject_edit($id){
        $students = students::paginate(6,['*'],'students');
        $subjects = subject::paginate(6,['*'],'subjects');
        return view('home',['bool_sub'=>true,'id'=>$id,'students'=>$students,"subjects"=>$subjects]);
    }
    public function post_subject_edit(request $request){
        $validatedData = $request->validate([
            'subject' => 'required',
        ]);
        $name = $request->subject;
        Subject::where('id',$request->id)->update([
            "name"=>$name
        ]);
        return redirect()->route('home');
    }

}
