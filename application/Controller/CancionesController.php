<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Song;


class CancionesController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->titulo = "Canciones";
	}

	public function index()
	{
		$this->view->render("canciones/index", ['titulo' => $this->titulo]);
	}

	public function listar()
	{
		$canciones = new Song();
		$listarCanciones = $canciones->getAllSongs();
		$this->view->render("canciones/listar", ['listarCanciones' => $listarCanciones, 'titulo' => $this->titulo]);
	}

	public function ver($id = 0)
	{
		$canciones = new Song();
		$id = (int) $id;
		if ($id == 0) {
			header("location: /canciones/listar");
		} else {
			$cancion = $canciones->getSong($id);
			$this->view->render("canciones/ver", 
				['cancion' => $cancion, 
				 'titulo' => $this->titulo
				]);
		}
	}

}