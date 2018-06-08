<?php $this->layout('layouts/admin/layout') ?>

    <section class="content-header">
      <h1>
        Editar un estudiante
        <small>A continuacion podra editar un estudiante</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>estudiantees</li>
        <li class="active">Editar</li>
      </ol>
    </section>

            
  <div class="row">
    <form action="//proyecto12.test/students/update" method="post" class="login">
    	<input value="<?=$selectedStudent->id?>" type="hidden" name="id" placeholder="Escriba el nombre del estudiante" class="form-control">
    	<input value="<?=$selectedStudent->user_id?>" type="hidden" name="user_id" placeholder="Escriba el nombre del estudiante" class="form-control">      
       <div class="col-md-8">
        <div class="box">
          <div class="box-body">
              <div class="form-group" >
              	<label>Nombre del estudiante</label>
					<input value="<?=$selectedStudent->name?>" type="text" name="name" placeholder="Escriba el nombre del estudiante" class="form-control">   
              </div>
              <div class="form-group" >
              	<label>Apellidos del estudiante</label>
					<input value="<?=$selectedStudent->surname?>" type="text" name="surname" placeholder="Escriba los apellidos  del estudiante" class="form-control"> 
              </div>

              <div class="form-group" >
              	<label>Telefono de contacto</label>
					<input value="<?=$selectedStudent->phone?>" type="number" name="phone" placeholder="Escriba el telefono de contacto" class="form-control"> 
              </div>

              <div class="form-group" >
              	<label>Direccion del estudiante</label>
					<input value="<?=$selectedStudent->address?>" type="text" name="address" placeholder="Escriba la direccion del estudiante" class="form-control"> 
              </div>
              
              <div class="form-group" >
              	<label>Dni del estudiante</label>
					<input value="<?=$selectedStudent->dni_alumno?>" type="text" name="dni" placeholder="Escriba la direccion del estudiante" class="form-control"> 
              </div>


          </div>
        </div>
      </div>

<?php $subjectAssigned = $model->subjectsName($selectedStudent->id) ?>
<?php $array = ["0"] ?>
<?php foreach($subjectAssigned as $assigned): ?>
<?php $array[] .= $assigned->name ?> 
<?php endforeach ?>



        <div class="col-md-4">
        <div class="box">
          <div class="box-body">
              
                <div class="form-group">

                  <label>Agregar asignaturas al estudiante</label>
                  
                  <select name="subject_id[]" class="form-control" multiple="true" required>
                      <?php foreach($subjects as $subject): ?>
                       <?php if(array_search($subject->name, $array)) : ?>
                       	<option value="<?=$subject->id?>" selected><?=$subject->name?></option>
                       	<?php else: ?>
                        <option value="<?=$subject->id?>"><?=$subject->name?></option>
                        <?php endif ?>
                      <?php endforeach ?>
                  </select>
                  <span class="text-danger"></span>

                </div>
             
              <div class="form-group" >
              	<label>Email de creacion de cuenta</label>
					<input value="<?= $model->getPass($selectedStudent->user_id) ?>" type="email" name="email" placeholder="Escriba el email del estudiante" class="form-control"> 
              </div>
              
              <div class="form-group" >
              	<label>Contraseña de la cuenta estudiante</label>
					<input type="password" name="password" placeholder="Escriba la contraseña de la cuenta" class="form-control"> 
              </div>

              <div class="form-group">
                <label></label>
                  <button type="submit" class="btn btn-primary btn-block">Registrar un estudiante</button>
              </div>

          </div>
        </div>
      </div>
    </form>
  </div>