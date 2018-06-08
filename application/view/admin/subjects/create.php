<?php $this->layout('layouts/admin/layout') ?>
    <section class="content-header">
      <h1>
        Crear una asignatura
        <small>A continuacion podra crear una asignatura</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Cursos</li>
        <li class="active">Crear</li>
      </ol>
    </section>
          <div class="row">
            <div class="col-md-6">
            <div class="box">
                        <div class="box-body">
              
                <form action="//proyecto12.test/subjects/store" method="post" class="login">

                  <div class="form-group">

                  <label>Nombre de la asignatura</label>
                  
                  <input type="text" name="name" class="form-control" placeholder="Enter subject name"> 
                  <!--Aqui van los errores -->
                  <span class="text-danger"></span>

                </div>

                <div class="form-group">

                  <label>Descripcion de la asignatura</label>
                  
                  <input type="textarea" name="description" class="form-control" placeholder="Enter subject description"> 
                  <!--Aqui van los errores -->
                  <span class="text-danger"></span>

                </div>               

                <div class="form-group">

                  <label>Crear un subcurso</label>
                  
                  <select name="course_id[]" class="form-control" multiple="true" required>
                      <?php foreach($courses as $course): ?>
                        <option value="<?=$course->id?>"><?=$course->name?></option>
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
