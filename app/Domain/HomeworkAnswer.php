<?php

namespace App\Domain;

class HomeworkAnswer
{
	//this should be private and use getter/setter
	public $id;
	public $homeworkId;
	public $studentId;
	public $answer;
	public $answer_date;
	
	function __construct($id, $homeworkId, $studentId, $answer, $date)
	{
		$this->id = $id;
		$this->homeworkId = $homeworkId;
		$this->studentId = $studentId;
		$this->answer = $answer;
		$this->answer_date = $date;
	}
	
	/**
	 * Compare this answers date with the date of a different answer
	 * Returns true if this date is more recent and $answer->date
	 * @param unknown $answer
	 */
	function compareDate($answer)
	{		
		return (strtotime($this->answer_date) > strtotime($answer->answer_date));
	}
}
