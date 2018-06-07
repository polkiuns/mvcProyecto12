<?php

namespace Mini\Model;

use Mini\Core\Database;
use PDO;
use Mini\Libs\Sesion;

class Auth
{
	public static function user()
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM users WHERE email = :email AND password = :password";
		$query = $conn->prepare($ssql);
		$parameters = array(':email' => $_POST['email'], ':password' => $_POST['password']);
		$query->execute($parameters);
		return $query->fetch();		
	}

	public static function authorice($role,$accion,$model)
	{
		
	if(Sesion::get('role')){
		switch ($model) {
			case 'course':
				if($role != 'admin'){
				return false;					
				}
				return true;
			break;
			default:
				# code...
				break;
		}				
	} 
	else {
		return false;
			}
	}

	

}