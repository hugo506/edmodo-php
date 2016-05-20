<?php

namespace App\Domain;

class Homework
{
	//this should be private and use getter/setter
	public $title;
	public $question;
	public $due_date;
	public $id;
	
	public $studentAnswers;
	
	function __construct($id, $title, $question, $due_date)
	{
		$this->id = $id;
		$this->title = $title;
		$this->question = $question;
		$this->due_date = $due_date;		
		$this->studentAnswers = array();
	}
	
	
	public function addStudentAnswer($student, $answer)
	{
		//ensure this answer belongs to this homework
		if($this->id != $answer->homeworkId)
		{
			return false;
		}
		
		if(!isset($this->studentAnswers[$student->id])){
			$this->studentAnswers[$student->id]['student'] = $student;
			$this->studentAnswers[$student->id]['answers'] = array();
			$this->studentAnswers[$student->id]['latest_answer'] = $answer;
		}			
		
		if(!isset($this->studentAnswers[$student->id]['answers'][$answer->id]))
		{
			$this->studentAnswers[$student->id]['answers'][$answer->id] = $answer;
		}
		
		//update the latest known answer if needed
		if($answer->compareDate($this->studentAnswers[$student->id]['latest_answer'])){
			$this->studentAnswers[$student->id]['latest_answer'] = $answer;
		}
							
	}
	
	

}
