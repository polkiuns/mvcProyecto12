<ul>
<?php foreach($childs as $child): ?>

	<li>

	     <a id="" href="#">	<?= $child->name ?></a>

	<?php if(count($courseModel->childs($child->id))): ?>
			

				<?php $this->insert('tree/courseChild', ['childs' => $courseModel->childs($child->id) , 'courseModel' => $courseModel]) ?>
	

	<?php endif ?>

	<?php if(count($courseModel->subjects($child->id))): ?>
		<?php $this->insert('tree/subjectChild', ['subjects' => $courseModel->subjects($child->id) , 'courseModel' => $courseModel , 'course' => $child]) ?>		
	<?php endif ?>

	</li>


<?php endforeach ?>

</ul>
