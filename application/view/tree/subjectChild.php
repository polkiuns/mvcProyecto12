<ul>
<?php foreach($subjects as $subject): ?>

	<li>

		<a style="color:green;" href="<?php echo URL . 'subjects/show/' . $subject->url ?>"><?= $subject->name ?></a>
		

	</li>


<?php endforeach ?>

</ul>
