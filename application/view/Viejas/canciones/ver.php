<div class="container">
	<h2><?= $this->cancion->track ?></h2>
	<p>Artista:<br><?= $this->cancion->artist ?></p>
	<p>URL:<br>
		<a href="<?= $this->cancion->link ?>"><?= $this->cancion->link ?></a>
	</p>
	<p><br>
		<a href="/canciones/listar/">&lt;== Volver al Listado de Canciones</a>
	</p>
</div>