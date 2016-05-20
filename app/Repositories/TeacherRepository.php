<?php

namespace App\Repositories;


use App\Domain\Teacher;

class TeacherRepository extends UserRepository{
	
	private $userModel;
	
	public function __construct()
	{
		
	}	
	
	public function createUser($row)
	{
		return new Teacher($row->id, $row->name, $row->user_name);
	}
	
	
}