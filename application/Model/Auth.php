<?php

namespace Mini\Model;

use Mini\Core\Database;
use PDO;
use Mini\Libs\helper;
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

	public static function getRole($role_id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT name FROM roles WHERE id = :role_id";
		$query = $conn->prepare($ssql);
		$parameters = array(':role_id' => $role_id);
		$query->execute($parameters);
		//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();
		return $query->fetchColumn();			
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
				case 'subject':
					if($accion == 'view'){
						if($role != 'admin' && $role != 'teacher') {
							return false;
						}
						return true;
					} else if ($accion == 'edit') {
						if($role != 'admin') {
							return false;
						}
						return true;
					} else if ($accion == 'show') {
						return true;
					}
				break;
				case 'lesson':
					if($accion == 'create') {
						if($role != 'admin' && $role != 'teacher'){
							return false;
						}
						return true;
					}
				break;
				case 'teacher':
					if($accion == 'view') {
						if($role != 'admin') {
							return false;
						}
						return true;
					}
				break;
				}
		}				
	
	else {
		return false;
			}
	}

	

}