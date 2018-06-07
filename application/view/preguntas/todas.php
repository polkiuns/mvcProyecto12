<?php $this->layout('layouts/layout') ?>
<div class="container">
	<?php $this->insert('partials/feedback') ?>
	<h2>Todas las Preguntas</h2>
	<?php if(count($preguntas) == 0): ?>
		<p>No hay preguntas en la Base de Datos</p>
	<?php else: ?>
		<p>Tenemos <?= count($preguntas) ?> preguntas encontradas:</p>
		<?php foreach ($preguntas as $pregunta) : ?>
			<div class="pregunta">
				<h3><?= $pregunta->asunto ?></h3>
				<p><?= $pregunta->cuerpo ?></p>
				<footer>
					<a href="<?php echo URL; ?>preguntas/editar/<?= $pregunta->id ?>">[ Editar ]</a>
				</footer>
			</div>
		<?php endforeach ?>
	<?php endif ?>
</div>