<?php

namespace Mini\Model;

use Mini\Core\Database;
use PDO;
use Mini\Libs\helper;
use Mini\Libs\Sesion;

class Lesson
{
	public static function all()
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM lessons";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();		
	}

	public static function parents($id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM lessons WHERE lesson_id IS NULL AND subject_id = :subject_id";
		$parameters = array(':subject_id' => $id);
		$query = $conn->prepare($ssql);		
		$query->execute($parameters);
		//
		return $query->fetchAll();		
	}

	public static function childs($lesson_id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM lessons WHERE lesson_id = :lesson_id";
		$query = $conn->prepare($ssql);
		$parameters = array(':lesson_id' => $lesson_id);
		$query->execute($parameters);
		return $query->fetchAll();			
	}

	public function parentName($course_id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT name FROM courses WHERE id = :course_id";
		$query = $conn->prepare($ssql);
		$parameters = array(':course_id' => $course_id);
		$query->execute($parameters);
		return $query->fetchColumn();			
	}

	public function subjects($id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT name , url FROM subjects WHERE id IN (SELECT subject_id FROM course_subject WHERE course_id = :course_id)";
		$query = $conn->prepare($ssql);
		$parameters = array(':course_id' => $id);
		$query->execute($parameters);
		//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();
		return $query->fetchAll();			
	}

	public static function find($lesson)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM lessons WHERE id = :id";
		$query = $conn->prepare($ssql);
		$parameters = array(':id' => $lesson);
		$query->execute($parameters);
		return $query->fetch();
	}

	public static function getTeacher($id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT teacher_id FROM lessons WHERE id = :id";
		$query = $conn->prepare($ssql);
		$parameters = array(':id' => $id);
		$query->execute($parameters);
		$teacher_id = $query->fetchColumn();		

		$ssql = "SELECT id, name FROM teachers WHERE id = :teacher_id";
		$query = $conn->prepare($ssql);
		$parameters = array(':teacher_id' => $teacher_id);
		$query->execute($parameters);
		return $query->fetch();		
	}

	public function subjectName($subject_id)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT name FROM subjects WHERE id = :subject_id";
		$query = $conn->prepare($ssql);
		$parameters = array(':subject_id' => $subject_id);
		$query->execute($parameters);
		return $query->fetch();		
	}
	public static function findUrl($course)
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM courses WHERE url = :url";
		$query = $conn->prepare($ssql);
		$parameters = array(':url' => $course);
		$query->execute($parameters);
		return $query->fetch();
	}

	public static function store($data)
	{
		$conn = Database::getInstance()->getDatabase();
		if($data['lesson_id'] == 0){
			$ssql = "INSERT INTO lessons (name, lesson_id , teacher_id , subject_id , published) VALUES (:name, NULL , :teacher_id , :subject_id , :published)";
			$parameters = array(':name' => $data['name'] , ':teacher_id' => $data['teacher_id'] , ':subject_id' => $data['subject_id'] , ':published' => $data['published']);
		} else {
			$ssql = "INSERT INTO lessons (name, lesson_id , teacher_id , subject_id , published) VALUES (:name, :lesson_id , :teacher_id , :subject_id , :published)";
			$parameters = array(':lesson_id' => $data['lesson_id'] , ':name' => $data['name'] , ':teacher_id' => $data['teacher_id'] , ':subject_id' => $data['subject_id'] , ':published' => $data['published']);
		}
		
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

	public static function update($data)
	{
		$conn = Database::getInstance()->getDatabase();
		if($data['lesson_id'] == 0){
			$ssql = "UPDATE lessons SET name = :name, lesson_id = NULL , subject_id = :subject_id , teacher_id = :teacher_id, published = :published WHERE id = :id";
			$parameters = array(':name' => $data['name'] , ':subject_id' => $data['subject_id'] , ':id' => $data['id'] , ':teacher_id' => $data['teacher_id'] , ':published' => $data['published']);
		} else {
			$ssql = "UPDATE lessons SET name = :name, lesson_id = :lesson_id , subject_id = :subject_id , teacher_id = :teacher_id, published = :published WHERE id = :id";
			$parameters = array(':name' => $data['name'] , ':subject_id' => $data['subject_id'] , ':id' => $data['id'] , ':teacher_id' => $data['teacher_id'] , ':lesson_id' => $data['lesson_id'], ':published' => $data['published']);
		}
		
		$query = $conn->prepare($ssql);
		
		$query->execute($parameters);
		$cuenta = $query->rowCount();
		//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();
		//echo '[ PDO DEBUG ]: ' . Helper::debugPDO($ssql, $parameters);  exit();
		if ($cuenta == 1) {
			Sesion::add('feedback_positive', "Pregunta insertada con éxito, gracias!!!");
			return true;
		}
		return false;
	}

	public static function delete($data)
	{
		$conn = Database::getInstance()->getDatabase();

			$ssql = "DELETE FROM lessons WHERE id = :id";
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