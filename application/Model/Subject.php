<?php

namespace Mini\Model;

use Mini\Core\Database;
use PDO;
use Mini\Libs\helper;
use Mini\Libs\Sesion;

class Subject
{
	public static function all()
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM subjects";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();		
	}

	public function courseName($id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT name FROM courses WHERE id IN (SELECT course_id FROM course_subject WHERE subject_id = :subject_id)";
		$parameters = array(':subject_id' => $id);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
		//
		return $query->fetchAll();		
	}

	public static function getLessons($id)
	{

		$rawdata = array();
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM lessons WHERE subject_id = :id";
		$parameters = array(':id' => $id);
		$query = $conn->prepare($ssql);

		$query->execute($parameters);
		$i=0;

    while($row = $query->fetch())
    {
        $rawdata[$i] = $row;
        $i++;
    }

//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();
		return $rawdata;		
	}



	public static function findUrl($url)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM subjects WHERE url = :url";
		$query = $conn->prepare($ssql);
		$parameters = array(':url' => $url);
		$query->execute($parameters);
		return $query->fetch();
	}

	public static function find($id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM subjects WHERE id = :id";
		$query = $conn->prepare($ssql);
		$parameters = array(':id' => $id);
		$query->execute($parameters);
		return $query->fetch();
	}

	public static function store($data)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "INSERT INTO subjects (name, description , url) VALUES (:name, :description , :url)";
		$parameters = array(':description' => $data['description'] , ':name' => $data['name'] , ':url' => $data['url']);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
		$cuenta = $query->rowCount();

		$ssql = "SELECT id FROM subjects ORDER BY id DESC LIMIT 1";
		$parameters = array(':description' => $data['description'] , ':name' => $data['name'] , ':url' => $data['url']);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
		$id = $query->fetchColumn();

		for($i = 0 ; $i < count($data['courses_id']) ; $i++){
		$ssql = "INSERT INTO course_subject (course_id, subject_id) VALUES (:course_id, :subject_id)";
		$parameters = array(':course_id' => $data['courses_id'][$i] , ':subject_id' => $id);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);			
		}


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
		$ssql = "UPDATE subjects SET name = :name, description = :description , url = :url WHERE id = :id";
		$parameters = array(':description' => $data['description'] , ':name' => $data['name'] , ':url' => $data['url'] , ':id' => $data['id']);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
		$cuenta = $query->rowCount();

		$ssql = "DELETE FROM course_subject WHERE subject_id= :id";
		$parameters = array(':id' => $data['id']);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);


		for($i = 0 ; $i < count($data['courses_id']) ; $i++){
		$ssql = "INSERT INTO course_subject (course_id, subject_id) VALUES (:course_id, :subject_id)";
		$parameters = array(':course_id' => $data['courses_id'][$i] , ':subject_id' => $data['id']);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);	
		//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();		
		}


		//
		if ($cuenta == 1) {
			Sesion::add('feedback_positive', "Pregunta insertada con éxito, gracias!!!");
			return true;
		}
		return false;
	}

	public static function delete($data)
	{
		$conn = Database::getInstance()->getDatabase();

		$ssql = "DELETE FROM subjects WHERE id = :id";
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