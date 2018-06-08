<?php $this->layout('layouts/admin/layout') ?>
    <section class="content-header">
      <h1>
        Editar una asignatura
        <small>A continuacion podra editar una asignatura</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Asignatura</li>
        <li class="active">Editar</li>
      </ol>
    </section>
          <div class="row">
            <div class="col-md-6">
            <div class="box">
                        <div class="box-body">
              
                <form action="//proyecto12.test/subjects/update" method="post" class="login">
				<input type="hidden" name="id" value="<?= $selectedSubject->id ?>">
                  <div class="form-group">

                  <label>Nombre de la asignatura</label>
                  <input value="<?= $selectedSubject->name ?>" type="text" name="name" class="form-control" placeholder="Enter subject name"> 
                  <!--Aqui van los errores -->
                  <span class="text-danger"></span>

                </div>

                <div class="form-group">

                  <label>Descripcion de la asignatura</label>
                  
                  <input value="<?= $selectedSubject->description ?>" type="textarea" name="description" class="form-control" placeholder="Enter subject description"> 
                  <!--Aqui van los errores -->
                  <span class="text-danger"></span>

                </div>               
<?php $courseAssigned = $model->courseName($selectedSubject->id) ?>
<?php $array = ["0"] ?>
<?php foreach($courseAssigned as $assigned): ?>
<?php $array[] .= $assigned->name ?> 
<?php endforeach ?>

                <div class="form-group">

                  <label>Asignar a un curso</label>
                  
                  <select name="course_id[]" class="form-control" multiple="true">
                      <?php foreach($courses as $course): ?>
                      	<?php if(array_search($course->name, $array)) : ?>
								<option value="<?=$course->id?>" selected><?=$course->name?></option>
						<?php else: ?>
							<option value="<?=$course->id?>"><?=$course->name?></option>
                      	<?php endif ?>	
                      <?php endforeach ?>

                  </select>
                  <span class="text-danger"></span>

                </div>

                
                <div class="form-group">

                  <button class="btn btn-success">Registrar asignatura</button>

                </div>


                </form>
              </div>
            </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
