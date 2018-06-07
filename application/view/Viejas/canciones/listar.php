<div class="container">
	<?php foreach ($this->listarCanciones as $cancion) : ?>
		<article class="listadocanciones">
			<header>
				<a href="/canciones/ver/<?= $cancion->id ?>"><?= $cancion->track ?></a>
			</header>
			<p>Artista: <?= $cancion->artist ?></p>
		</article>
	<?php endforeach ?>
</div>