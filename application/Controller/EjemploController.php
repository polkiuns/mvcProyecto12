<?php

namespace Mini\Controller;

class EjemploController 
{
	public function index()
	{
		echo "<h2>Estoy en mi propio controlador</h2>";
	}

	public function create()
	{
		echo "<h2>Estoy en el método create de Ejemplo</h2>";
	}
}