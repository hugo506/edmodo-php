<?php

namespace App\Repositories;


use App\Domain\Student;
use App\HomeworkAnswers;

class StudentRepository extends UserRepository{
	
	public function createUser($row)
	{
		return new Student($row->id, $row->name, $row->user_name);
	}
	
	public function submitStudentHomework($studentId, $homeworkId, $answer)
	{
		$answers = new HomeworkAnswers();
		$answers->student_id = $studentId;
		$answers->homework_id = $homeworkId;
		$answers->answer = $answer;
		$answers->date = date('Y-m-d h:i:s');
	
		$answers->save();
	}
	
	
}