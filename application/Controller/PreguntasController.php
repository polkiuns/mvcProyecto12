<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Pregunta;

class PreguntasController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->view->addData(['titulo' => 'Preguntas']);
	}

	public function todas()
	{
		$pregunta = new Pregunta();
		$preguntas = $pregunta->getAll();
		echo $this->view->render('preguntas/todas',
						['preguntas' => $preguntas
						]);
	}

	public function crear()
	{
		if ( ! $_POST) {
			echo $this->view->render('preguntas/formulariopregunta');
		} else {
			if ( ! isset($_POST["asunto"])){
				$_POST["asunto"] = "";
			}
			if ( ! isset($_POST["cuerpo"])) {
				$_POST["cuerpo"] = "";
			}

			$datos = ['asunto' => $_POST["asunto"],
					  'cuerpo' => $_POST["cuerpo"]
					 ];

			if (Pregunta::insert($datos)) {
				$this->todas();
			} else {
				echo $this->view->render('preguntas/formulariopregunta',
						['errores' => ['Error al insertar'],
 						 'datos' => $_POST
						]);
			}
		}
	}

	public function editar($id = 0) 
	{
		if ( ! $_POST) {
			$pregunta = Pregunta::getId($id);
			if ($pregunta) {
				echo $this->view->render('preguntas/formulariopregunta',
					['datos'	=>	get_object_vars($pregunta),
					 'accion'	=>	'editar'
					]);
			} else {
				header("location: /preguntas/todas");
			}
		} else {
			$datos = ['asunto'	=>	(isset($_POST['asunto'])) ? $_POST['asunto'] : "",
					  'cuerpo'	=>	(isset($_POST['cuerpo'])) ? $_POST['cuerpo'] : "",
					  'id'		=>	(isset($_POST['id'])) ? $_POST['id'] : ""

					 ];
			if (Pregunta::edit($datos)) {
				header("location: /preguntas/todas");
			} else {
				echo $this->view->render('preguntas/formulariopregunta',[
					'errores'	=>	['Error al editar'],
					'datos'		=>	$_POST,
					'accion'	=>	'editar'
					]);
			}
		}
	}

	 





}