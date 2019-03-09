<?php

namespace Career\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Career\points;
use Career\courses;
use Career\categories;
use Career\guidances;
use Career\groups;
use DB;
use Input;
use Career\subjects;
use Career\course_groups;
use Auth;
use subjectgroups;
use Career\universities;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function index1(){
        return view('layouts.index');
    }
    
    public function help(){
        return view('layouts.help');
    }
    public function storesubjects(Request $request){
         $validator = Validator::make($request->all(), [
            'mathematics' => 'required',
            'english' => 'required',
            'kiswahili' => 'required',
            'chemistry'=>'required',     
        ]);

        if ($validator->fails()) {
            return redirect('/home')
                        ->withErrors($validator)
                        ->withInput();
        }
$math=$request->input('mathematics');
$eng=$request->input('english');
$kis=$request->input('kiswahili');
$bio=$request->input('biology');
$chem=$request->input('chemistry');
$phy=$request->input('physics');
$cre=$request->input('cre');
$hist=$request->input('history');
$geo=$request->input('geography');
$bus=$request->input('business');
$agri=$request->input('agriculture');
$comp=$request->input('computer');
$hindu=$request->input('hindu');
$islam=$request->input('islam');
$music=$request->input('music');
$wood=$request->input('wood');
$mechanics=$request->input('mechanic');
$arabic=$request->input('arabic');
$electric=$request->input('electric');
$arts=$request->input('art');
$germany=$request->input('germany');


//$phy=$request->input('physics');
//$array = array($math,$eng,$kis,$bio,$chem,$phy, $cre, $hist, $geo, $bus, $agri);
//$grades=array("A", "A-", "B+","B","B-","C+","C","C-","D+","D","D-","E");
//$marks=array(12,11,10,9,8,7,6,5,4,3,2,1);
//for ($i=0; $i <count($grades); $i++) { 
   // if($math==$grades[$i])
   // {
           //$mathspoints= $marks[$i];
$array = array($math,$eng,$kis,$bio,$chem,$phy,$cre, $agri, $hist, $geo, $bus, $comp, $hindu, $islam, $music, $wood, $mechanics, $arabic, $electric, $arts, $germany);

$m1 = $m2 = $m3 = $m4 = PHP_INT_MIN;
$sub1 = $sub2 = $sub3 = $sub4 = $sub5 = $sub6 = $sub7 =PHP_INT_MIN;
for ($i = 0 ; $i < count($array); $i++) {
    $x = $array[$i] ; 
    if ($x >= $m1){
        $m4 = $m3 ;
        $m3 = $m2 ;            
        $m2 = $m1 ;
        $m1 = $x  ;
    } elseif ($x > $m2){
        $m4 = $m3;
        $m3 = $m2;
        $m2 =$x  ;
    } elseif ($x > $m3){
        $m4  =$m3;
        $m3 = $x;
    } 
    elseif ($x>$m4) {
        $m4=$x;
    }

    $four=array($m1,$m2,$m3,$m4);
    $sum=array_sum($four);
    //end of four subjects
    if ($x >= $sub1){
        $sub7 = $sub6 ;
        $sub6 = $sub5 ;            
        $sub5 = $sub4 ; 
        $sub4 = $sub3 ; 
        $sub3 = $sub2 ; 
        $sub2 = $sub1 ;
        $sub1 = $x ;
    } elseif ($x > $sub2){
        $sub7 = $sub6 ;
        $sub6 = $sub5 ;            
        $sub5 = $sub4 ; 
        $sub4 = $sub3 ; 
        $sub3 = $sub2 ;
        $sub2 = $x ;
    } elseif ($x > $sub3){
        $sub7 = $sub6 ;
        $sub6 = $sub5 ;            
        $sub5 = $sub4 ; 
        $sub4 = $sub3 ; 
        $sub3 = $x ;
    } 
     elseif ($x > $sub4){
        $sub7 = $sub6 ;
        $sub6 = $sub5 ;            
        $sub5 = $sub4 ; 
        $sub4 = $x; 
    } 
     elseif ($x > $sub5){
        $sub7 = $sub6 ;
        $sub6 = $sub5 ;            
        $sub5 = $x ;
    } 
     elseif ($x > $sub6){
        $sub7 = $sub6 ;
        $sub6 = $x ;
    } 
    elseif ($x>$sub7) {
        $sub7=$x;
    }
    //end of seven subjects;
    $seven=array($sub1, $sub2, $sub3, $sub4, $sub5, $sub6, $sub7);
    $sumseven=array_sum($seven);
}
$points=round(sqrt(($sum/48*$sumseven)/84)*48);
if ($points >= 45 && $points <= 48) {
        $course_groups=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id')->where('points', '=', $points)->get();
        $courses=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id')->where('points', '<', $points)->get();
         return view('courses.groups',['course_groups'=>$course_groups, 'points'=>$points, 'courses'=>$courses]);
}
    elseif ($points >= 40 && $points <=44) {
        $course_groups=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id')->where('points', '=', $points)->get();
         $courses=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id')->where('points', '<', $points)->get();
         return view('courses.groups',['course_groups'=>$course_groups, 'points'=>$points, 'courses'=>$courses]);
     } 

    elseif ($points >= 36 && $points <=39) {
         $course_groups=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id')->where('points', '=', $points)->get();
         $courses=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id')->where('points', '<', $points)->get();
         return view('courses.groups',['course_groups'=>$course_groups, 'points'=>$points, 'courses'=>$courses]);
    }
    elseif ($points >=33 && $points <=35) {
        $course_groups=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id')->where('points', '=', $points)->get();
        $courses=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id')->where('points', '<', $points)->get();
         return view('courses.groups',['course_groups'=>$course_groups, 'points'=>$points, 'courses'=>$courses]);
    }
     elseif ($points >=25 && $points <=30) {
        $course_groups=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.course_id')->where('points', '=', $points)->get();
        $courses=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id', 'courses.course_id')->where('points', '<', $points)->get();
         return view('courses.groups',['course_groups'=>$course_groups, 'points'=>$points, 'courses'=>$courses]);
    }
     elseif ($points >=21 && $points <=25) {
        $course_groups=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id')->where('points', '=', $points)->get();
        $courses=DB::table('course_groups')->join('courses', 'course_groups.course_id', '=', 'courses.course_id')->select('courses.course_name', 'course_groups.id')->where('points', '<', $points)->get();
         return view('courses.groups',['course_groups'=>$course_groups, 'points'=>$points, 'courses'=>$courses]);
    }
    elseif ($points >=0 && $points <=20) {
      return view('courses.pagenotfound', ['points'=>$points]);
    }
}
public function welcomecourses($course_id){
    $universities=universities::all();
    $course_groups=DB::table('courses')->join('course_groups', 'course_groups.course_id', '=', 'courses.course_id')->join('universities', 'course_groups.university_id', '=', 'universities.university_id')->join('subject_groups', 'course_groups.group_id','=', 'subject_groups.id')->join('subjects', 'subject_groups.subject_id','=', 'subjects.id')->join('course_subjects', 'courses.course_id', '=', 'course_subjects.course_id')->select('courses.course_name', 'universities.university_name', 'subjects.subject_name')->groupby('courses.course_name', 'universities.university_name',  'subjects.subject_name')->where('course_groups.id', '=', $course_id)->get();
  
    return view('courses.viewcourses', ['course_groups'=>$course_groups, 'universities'=>$universities]);
}
  public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }

    
}
