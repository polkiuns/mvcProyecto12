<?php $this->layout('layouts/admin/layout') ?>

    <section class="content-header">
      <h1>
        Editar un profesor
        <small>A continuacion podra editar un profesor</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Profesores</li>
        <li class="active">Editar</li>
      </ol>
    </section>

            
  <div class="row">
    <form action="//proyecto12.test/teachers/update" method="post" class="login">
    	<input value="<?=$selectedTeacher->id?>" type="hidden" name="id" placeholder="Escriba el nombre del profesor" class="form-control">
    	<input value="<?=$selectedTeacher->user_id?>" type="hidden" name="user_id" placeholder="Escriba el nombre del profesor" class="form-control">      
       <div class="col-md-8">
        <div class="box">
          <div class="box-body">
              <div class="form-group" >
              	<label>Nombre del profesor</label>
					<input value="<?=$selectedTeacher->name?>" type="text" name="name" placeholder="Escriba el nombre del profesor" class="form-control">   
              </div>
              <div class="form-group" >
              	<label>Apellidos del profesor</label>
					<input value="<?=$selectedTeacher->surname?>" type="text" name="surname" placeholder="Escriba los apellidos  del profesor" class="form-control"> 
              </div>

              <div class="form-group" >
              	<label>Telefono de contacto</label>
					<input value="<?=$selectedTeacher->phone?>" type="number" name="phone" placeholder="Escriba el telefono de contacto" class="form-control"> 
              </div>

              <div class="form-group" >
              	<label>Direccion del profesor</label>
					<input value="<?=$selectedTeacher->address?>" type="text" name="address" placeholder="Escriba la direccion del profesor" class="form-control"> 
              </div>
              
              <div class="form-group" >
              	<label>Dni del profesor</label>
					<input value="<?=$selectedTeacher->dni_profesor?>" type="text" name="dni" placeholder="Escriba la direccion del profesor" class="form-control"> 
              </div>


          </div>
        </div>
      </div>

<?php $subjectAssigned = $model->subjectsName($selectedTeacher->id) ?>
<?php $array = ["0"] ?>
<?php foreach($subjectAssigned as $assigned): ?>
<?php $array[] .= $assigned->name ?> 
<?php endforeach ?>



        <div class="col-md-4">
        <div class="box">
          <div class="box-body">
              
                <div class="form-group">

                  <label>Agregar asignaturas al profesor</label>
                  
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
					<input value="<?= $model->getPass($selectedTeacher->user_id) ?>" type="email" name="email" placeholder="Escriba el email del profesor" class="form-control"> 
              </div>
              
              <div class="form-group" >
              	<label>Contraseña de la cuenta profesor</label>
					<input type="password" name="password" placeholder="Escriba la contraseña de la cuenta" class="form-control"> 
              </div>

              <div class="form-group">
                <label></label>
                  <button type="submit" class="btn btn-primary btn-block">Registrar un profesor</button>
              </div>

          </div>
        </div>
      </div>
    </form>
  </div>