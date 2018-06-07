<?php

namespace Mini\Model;

use Mini\Core\Database;
use PDO;
use Mini\Libs\Sesion;

class Pregunta
{
	public function getAll()
	{
		$conn = Database::getInstance()->getDatabase();
		$ssql = "SELECT * FROM preguntas";
		$query = $conn->prepare($ssql);
		$query->execute();
		return $query->fetchAll();
	}

	public static function insert($datos)
	{
		$conn = Database::getInstance()->getDatabase();

		$errores_validacion = false;
		if (empty($datos['asunto'])) {
			Sesion::add('feedback_negative', "No he recibido el asunto de la pregunta");
			$errores_validacion = true;
		}
		if (empty($datos['cuerpo'])) {
			Sesion::add('feedback_negative', "No he recibido el cuerpo de la pregunta");
			$errores_validacion = true;
		}
		if ($errores_validacion) {
			return false;
		}

		$params = [':asunto' => $datos['asunto'],
				   ':cuerpo' => $datos['cuerpo']
				  ];
		$ssql = "INSERT INTO preguntas (asunto, cuerpo) VALUES (:asunto, :cuerpo)";
		$query = $conn->prepare($ssql);
		$query->execute($params);
		$cuenta = $query->rowCount();
		if ($cuenta == 1) {
			Sesion::add('feedback_positive', "Pregunta insertada con éxito, gracias!!!");
			return $conn->lastInsertId();
		}
		return false;
	}

	public static function getId($id)
	{
		$conn = Database::getInstance()->getDatabase();

		$id = (int) ($id);

		if ($id == 0) {
			return false;
		}

		$ssql = "SELECT * FROM preguntas WHERE id = :id";
		$query = $conn->prepare($ssql);
		$query->bindValue(":id", $id, PDO::PARAM_INT);
		$query->execute();
		return $query->fetch();
	}

	public static function edit($datos)
	{
		$conn = Database::getInstance()->getDatabase();

		$errores_validacion = false;
		if (empty($datos['id'])) {
			Sesion::add('feedback_negative', "No he recibido la pregunta");
			$errores_validacion = true;
		}
		if (empty($datos['asunto'])) {
			Sesion::add('feedback_negative', "No he recibido el asunto de la pregunta");
			$errores_validacion = true;
		}
		if (empty($datos['cuerpo'])) {
			Sesion::add('feedback_negative', "No he recibido el cuerpo de la pregunta");
			$errores_validacion = true;
		}
		if ($errores_validacion) {
			return false;
		}
		

		$ssql = "UPDATE preguntas 
				 SET asunto=:asunto, cuerpo=:cuerpo 
				 WHERE id=:id";
		$query = $conn->prepare($ssql);
		$parametros = [':asunto'	=>	$datos['asunto'],
					   ':cuerpo'	=>	$datos['cuerpo'],
					   ':id'		=>	$datos['id']
					  ];
		$query->execute($parametros);
		$count = $query->rowCount();
		if ($count == 1) {
			Sesion::add('feedback_positive', "Editado con éxito, gracias!!!");
			return true;
		}
		Sesion::add('feedback_positive', "Actualizadas 0  preguntas");
		return true;

	}
}








