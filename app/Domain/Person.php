<?php

namespace App\Domain;

class Person
{
	//this should be private and use getter/setter
	public $name;
	public $user_name;
	public $id;
	
	public function __construct($id, $name, $user_name)
	{
		$this->name = $name;
		$this->user_name = $user_name;
		$this->id = $id;
	}
	
}
