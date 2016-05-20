<?php

namespace App\Repositories;

use App\User as UserModel;

abstract class UserRepository{
	
	
	public function findByUserName($userName)
	{
		return $this->createUser(UserModel::where('user_name', $userName)->first());
	}
	
	public function findById($userId)
	{
		return $this->createUser(UserModel::find($userId));
	}
	
	abstract function createUser($row);		
	
}