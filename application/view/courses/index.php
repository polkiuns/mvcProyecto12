<?php $this->layout('layouts/layoutCourses') ?>
<br/><br/><br/><br/><br/><br/>
	<div class="container">     
<?php $this->insert('partials/feedback') ?>
		<div class="panel panel-primary">

			<div class="panel-heading"></div>

	  		<div class="panel-body">

	  			<div class="row">

	  				<div class="col-md-12">

	  					<h3 style="text-align: center;">Lista de cursos</h3>

				        <div id="tree1">

								<?php foreach($courses as $course): ?>
								
								<h3>
				                <li>

				                   <?= $course->name ?>

				                    <?php if(count($courseModel->childs($course->id))): ?>

				                        <?php $this->insert('tree/courseChild', ['childs' => $courseModel->childs($course->id) , 'courseModel' => $courseModel]) ?>

									<?php endif ?>

				                </li>
				                </h3>

						<?php endforeach ?>

				        </div>

	  				</div>


	  			</div>


	  			

	  		</div>

        </div>

    </div>
    <script src="<?php echo URL; ?>js/treeview.js"></script>

