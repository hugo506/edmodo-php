<?php

namespace App\Domain;

class Teacher extends Person
{
	//this should be private and use getter/setter
	public $createdHomework = array();
	
	public function setCreatedHomework($homeworkList)
	{
		$this->createdHomework = $homeworkList;
	}
}
