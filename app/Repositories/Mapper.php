<?php

namespace App\Repositories;

use App\Domain\Homework;
use App\Domain\Student;
use App\Domain\HomeworkAnswer;

trait Mapper
{
	
	public function createStudent($id, $name, $userName)
	{
		return new Student($id, $name, $userName);
	}
	
	public function createHomeworkAnswer($id, $homeworkId, $studentId, $answer, $date)
	{
		return new HomeworkAnswer($id, $homeworkId,$studentId, $answer, $date);
	}
	
	public function createHomeworkList($rows)
	{
		$homeworkList = array();
	
		if($rows) foreach($rows as $row)
		{
			$homeworkList[] = $this->createHomework(
				$row->id, 
				$row->title, 
				$row->question, 
				$row->due_date);
		}
		return $homeworkList;
	}
	
	public function createHomework($id, $title, $question, $dueDate)
	{
		return new Homework($id, $title, $question, $dueDate);
	}
	
	public function createHomeworkAnswers($rows)
	{
		$homework = false;
	
		if($rows) foreach($rows as $row)
		{
			$homeworkId = $row->homework_id;
				
			if(!$homework){
				
				$homework = $this->createHomework(
						$homeworkId, 
						$row->title, 
						$row->question,
						$row->due_date);							
			}		

			$homework->addStudentAnswer(
				$this->createStudent(
					$row->student_id,
					$row->name,
					$row->user_name),
				$this->createHomeworkAnswer(
					$row->homework_answer_id,
					$row->homework_id,
					$row->student_id,
					$row->answer,
					$row->date)
			);
			
		}
		return $homework;
	}
	
	
}