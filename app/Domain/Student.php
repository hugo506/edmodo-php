<?php

namespace App\Domain;

class Student extends Person
{
	//this should be private and use getter/setter
	public $assignedHomework = array();	
	
	public function setAssignedHomework($homeworkList)
	{
		$this->assignedHomework = $homeworkList;
	}
	
}
