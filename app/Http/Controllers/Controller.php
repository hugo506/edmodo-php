<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Auth;
use Illuminate\Http\Request;

use App\Repositories\StudentRepository;
use App\Repositories\HomeworkRepository;
use App\Repositories\TeacherRepository;

/**
 * On bigger applications there would be multiple 
 * controllers, for now 1 will do
 * 
 * @author Hugo Alvarado
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    
    public function dashboard(Request $request)
    {    	
    	if($request->user()->role == 'student'){
    		
    		$studentRepository = new StudentRepository();
    		$student = $studentRepository->findByUserName($request->user()->user_name);
    		
    		$homeworkRepository = new HomeworkRepository();
    		$homeworkList = $homeworkRepository->findByStudentId($student->id);
    		
    		$student->setAssignedHomework($homeworkList);
    		    		    		    		
    		return view('student.assigned_homework', ['student' => $student]);    		
    	}else{
    		
    		$teacherRepository = new TeacherRepository();
    		$teacher = $teacherRepository->findByUserName($request->user()->user_name);
    		
    		$homeworkRepository = new HomeworkRepository();
    		$homeworkList = $homeworkRepository->findByTeacherId($teacher->id);
    		
    		$teacher->setCreatedHomework($homeworkList);
    		
    		return view('teacher.homework_list', ['teacher' => $teacher]);
    	}    		
    }
    
    public function getLogout()
    {
    	Auth::logout();
    	return redirect('/');
    }
    
    public function getHomework(Request $request, $homeworkId)
    {    	    	
    	$user = $request->user();
    	
    	$homeworkRepository = new HomeworkRepository();
    	$homework = $homeworkRepository->findById($homeworkId);
    	
    	return view('student.homework_details', ['student' => $user,'homework' => $homework]);    	 
    }
    
    public function postHomework(Request $request)
    {
    	$user = $request->user();
    	
    	$studentRepository = new StudentRepository();
    	$studentRepository->submitStudentHomework($user->id, $request->homework_id, $request->answer);    	
    	
    	return redirect()->intended('dashboard');  	
    }
        
    public function getHomeworkSubmissions(Request $request, $homeworkId)
    {    	
    	$teacherRepository = new TeacherRepository();
    	$teacher = $teacherRepository->findByUserName($request->user()->user_name);
    	
    	$homeworkRepository = new HomeworkRepository();
    	$homework = $homeworkRepository->findByIdWithAnswers($homeworkId);
    	    	    	
    	return view('teacher.submitted_homework', ['teacher' => $teacher, 'homework' => $homework]);
    }
    
    public function getStudentHomeworkHistory(Request $request, $homeworkId, $studentId)
    {
    	$teacherRepository = new TeacherRepository();
    	$teacher = $teacherRepository->findByUserName($request->user()->user_name);
    	
    	$studentRepository = new StudentRepository();
    	$student = $studentRepository->findById($studentId);
    	    	
    	$homeworkRepository = new HomeworkRepository();
    	$homework = $homeworkRepository->findByIdWithAnswers($homeworkId, $studentId);
    	     	
    	return view('teacher.homework_answers', [
    			'teacher' => $teacher,
    			'current_student' => $student,
    			'homework' => $homework]);
    	    	
    }
}
