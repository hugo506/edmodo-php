<?php

namespace App\Repositories;


use DB;
use App\Domain\Homework;

class HomeworkRepository{
	
	use Mapper;	
	
	public function findByStudentId($userId)
	{
		$now = date('Y-m-d h:i:s');
		
		$rows = DB::table('homework_assigned')
			->where('student_id', $userId)
			->where('due_date','>',$now)
			->join('homework', 'homework.id', '=', 'homework_assigned.homework_id')
			->join('users', 'users.id', '=', 'homework_assigned.student_id')			
			->select('homework.*')
			->get();
		
		if(!$rows) return false;
			
		return $this->createHomeworkList($rows);
	}
	
	public function findByTeacherId($userId)
	{
		$now = date('Y-m-d');
	
		$rows = DB::table('homework')
		->where('teacher_id', $userId)
		->select('homework.*')
		->get();
		
		if(!$rows) return false;
	
		return $this->createHomeworkList($rows);
	}
	
	
	public function findById($homeworkId)
	{
		$row = DB::table('homework')
			->where('id', $homeworkId)
			->first();
		
		if(!$row) return false;
		
		return $this->createHomework(
				$row->id, 
				$row->title, 
				$row->question, 
				$row->due_date);
	}
	
	public function findByIdWithAnswers($homeworkId, $studentId = false)
	{
		$query = DB::table('homework_assigned')
			->where('homework_assigned.homework_id', $homeworkId)
			->join('homework_answers', 'homework_assigned.homework_id', '=', 'homework_answers.homework_id')
			->join('users', 'users.id', '=', 'homework_answers.student_id')
			->join('homework', 'homework.id', '=', 'homework_assigned.homework_id')
			->select('homework.*','users.*',
					'homework_answers.*',
					'homework_answers.id as homework_answer_id')
			->orderBy('homework_answers.id', 'desc');
		
		if(false !== $studentId){
			$query = $query->where('homework_assigned.student_id', $studentId);
			$query = $query->where('homework_answers.student_id', $studentId);
		}
		
		$rows = $query->get();
			
		if(!$rows){
			//return the homework data only
			return $this->findById($homeworkId);
		}
			
		return $this->createHomeworkAnswers($rows);
	}
	
	
	
	
	
	
	
	
}