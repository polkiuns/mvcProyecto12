<?php

namespace Mini\Model;

use Mini\Core\Database;
use PDO;
use Mini\Libs\helper;
use Mini\Libs\Sesion;

class Student
{
	public static function all()
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM students";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();		
	}

	public function getSubjects($id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT name FROM subjects WHERE id IN (SELECT subject_id FROM student_subject WHERE student_id = :student_id)";
		$parameters = array(':student_id' => $id);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();
		return $query->fetchAll();				
	}

	public function subjectsName($id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT name FROM subjects WHERE id IN (SELECT subject_id FROM student_subject WHERE student_id = :student_id)";
		$parameters = array(':student_id' => $id);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
		//
		return $query->fetchAll();		
	}

	public static function find($id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM students WHERE id = :id";
		$query = $conn->prepare($ssql);
		$parameters = array(':id' => $id);
		$query->execute($parameters);
		return $query->fetch();
	}

	public static function findUser($id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM users WHERE id = :id";
		$query = $conn->prepare($ssql);
		$parameters = array(':id' => $id);
		$query->execute($parameters);
		return $query->fetch();
	}

	public function getPass($id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT email FROM users WHERE id = :id";
		$query = $conn->prepare($ssql);
		$parameters = array(':id' => $id);
		$query->execute($parameters);
		return $query->fetchColumn();		
	}

	public static function store($data)
	{
		$conn = Database::getInstance()->getDatabase();


		$ssql = "SELECT id FROM roles WHERE name='student'";
		$query = $conn->prepare($ssql);		
		$query->execute();
		$role_id = $query->fetchColumn();		

		$ssql = "INSERT INTO users (name, email , password, role_id) VALUES (:name, :email , :password, :role_id)";
		$parameters = array(':name' => $data['name'] , ':email' => $data['email'] , ':password' => $data['password'] , ':role_id' => $role_id);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);

	
		$ssql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
		$user_id = $query->fetchColumn();		


		$ssql = "INSERT INTO students (name, surname , phone, address, dni_alumno, user_id) VALUES (:name, :surname , :phone, :address, :dni , :user_id)";
		$parameters = array(':name' => $data['name'] , ':surname' => $data['surname'] , ':phone' => $data['phone'] , ':address' => $data['address'], ':dni' => $data['dni'] , ':user_id' => $user_id);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
		$cuenta = $query->rowCount();


		$ssql = "SELECT id FROM students ORDER BY id DESC LIMIT 1";
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
		$student_id = $query->fetchColumn();

		for($i = 0 ; $i < count($data['subjects_id']) ; $i++){
		$ssql = "INSERT INTO student_subject (student_id, subject_id) VALUES (:student_id, :subject_id)";
		$parameters = array(':subject_id' => $data['subjects_id'][$i] , ':student_id' => $student_id);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);			
		}
		$cuenta = $query->rowCount();
		//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();
		
		if ($cuenta == 1) {
			Sesion::add('feedback_positive', "Pregunta insertada con éxito, gracias!!!");
			return true;
		}
		return false;
	}

	public static function update($data)
	{

		$conn = Database::getInstance()->getDatabase();
		if(count($data['password'])) {
		$ssql = "UPDATE users SET name = :name, email = :email , password = :password WHERE id = :user_id";
		$parameters = array(':name' => $data['name'] , ':email' => $data['email'] , ':password' => $data['password'] , ':user_id' => $data['user_id']);			
		} else {
		$ssql = "UPDATE users SET name = :name, email = :email WHERE id = :user_id";
		$parameters = array(':name' => $data['name'] , ':email' => $data['email'] , ':user_id' => $data['user_id']);			
		}
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
	
		$ssql = "UPDATE students SET name = :name, surname = :surname , phone = :phone , address = :address , dni_alumno = :dni WHERE id = :id";
		$parameters = array(':name' => $data['name'] , ':surname' => $data['surname'] , ':phone' => $data['phone'] , ':address' => $data['address'], ':dni' => $data['dni'] , ':id' => $data['id']);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
		$cuenta = $query->rowCount();

		$ssql = "DELETE FROM student_subject WHERE student_id = :id";
		$parameters = array(':id' => $data['id']);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);


		for($i = 0 ; $i < count($data['subjects_id']) ; $i++){
		$ssql = "INSERT INTO student_subject (subject_id, student_id) VALUES (:subject_id, :student_id)";
		$parameters = array(':subject_id' => $data['subjects_id'][$i] , ':student_id' => $data['id']);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);	
		//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();		
		}
//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();

		$cuenta = $query->rowCount();
		if ($cuenta == 1) {
			Sesion::add('feedback_positive', "Pregunta insertada con éxito, gracias!!!");
			return true;
		}
		return false;
	}

	public static function delete($data)
	{
		$conn = Database::getInstance()->getDatabase();

		$ssql = "DELETE FROM users WHERE id = :id";
		$parameters = array(':id' => $data['id']);
		
		$query = $conn->prepare($ssql);
		
		$query->execute($parameters);
		$cuenta = $query->rowCount();
		//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();
		if ($cuenta == 1) {
			Sesion::add('feedback_positive', "Pregunta insertada con éxito, gracias!!!");
			return true;
		}
		return false;
	}

}