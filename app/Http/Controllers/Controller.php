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
    
    public function __construct()
    {
    	
    	$this->middleware('auth');
    	
    	$this->studentRepository = new StudentRepository();
    	$this->homeworkRepository = new HomeworkRepository();
    	$this->teacherRepository = new TeacherRepository();    	    
    }
    
    /**
     * Generate the teacher and student initial screens.
     * Student dashboard shows all the assigned active homework.
     * Teacher dashboard shows the homework assignments created by the teacher.
     * @param Request $request
     */
    public function getDashboard(Request $request)
    {    	
    	if($request->user()->role == 'student'){
    		    		
    		$student = $this->studentRepository->findByUserName($request->user()->user_name);    		    		
    		$homeworkList = $this->homeworkRepository->findByStudentId($student->id);
    		
    		$student->setAssignedHomework($homeworkList);
    		    		    		    		
    		return view('student.assigned_homework', ['student' => $student]);    		
    		
    	}else if($request->user()->role == 'teacher'){
    		    		
    		$teacher = $this->teacherRepository->findByUserName($request->user()->user_name);    		
    		$homeworkList = $this->homeworkRepository->findByTeacherId($teacher->id);
    		
    		$teacher->setCreatedHomework($homeworkList);
    		
    		return view('teacher.homework_list', ['teacher' => $teacher]);
    	}else{
    		//return view('error');
    	}
    	
    }
    
    
    public function getLogout()
    {
    	Auth::logout();
    	return redirect('/');
    }
    
    /**
     * Get the student's assigned homework details
     * 
     * @param Request $request
     * @param unknown $homeworkId
     */
    public function getHomework(Request $request, $homeworkId)
    {    	    	
    	$user = $request->user();
    	    	
    	$homework = $this->homeworkRepository->findById($homeworkId);
    	
    	return view('student.homework_details', ['student' => $user,'homework' => $homework]);    	 
    }
    
    /**
     * Persist a student's homework answer, and redirect to the dashboard
     * @param Request $request
     */
    public function postHomework(Request $request)
    {
    	$user = $request->user();
    	    	
    	$this->studentRepository->submitStudentHomework($user->id, $request->homework_id, $request->answer);    	
    	
    	return redirect()->intended('dashboard');  	
    }
        
    /**
     * Show the latest students submissions for a homework assignment 
     * 
     * @param Request $request
     * @param unknown $homeworkId
     */
    public function getHomeworkSubmissions(Request $request, $homeworkId)
    {    	
    	$teacher = $this->teacherRepository->findByUserName($request->user()->user_name);    	    	
    	$homework = $this->homeworkRepository->findByIdWithAnswers($homeworkId);
    	    	    	
    	return view('teacher.submitted_homework', ['teacher' => $teacher, 'homework' => $homework]);
    }
    
    /**
     * Show the history of answers for a specific homework assignment and student
     * @param Request $request
     * @param unknown $homeworkId
     * @param unknown $studentId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getStudentHomeworkHistory(Request $request, $homeworkId, $studentId)
    {

    	$teacher = $this->teacherRepository->findByUserName($request->user()->user_name);    	
    	$student = $this->studentRepository->findById($studentId);    	    	
    	$homework = $this->homeworkRepository->findByIdWithAnswers($homeworkId, $studentId);
    	     	
    	return view('teacher.homework_answers', [
    			'teacher' => $teacher,
    			'current_student' => $student,
    			'homework' => $homework]);
    	    	
    }
}
