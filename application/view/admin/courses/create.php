<?php $this->layout('layouts/admin/layout') ?>
    <section class="content-header">
      <h1>
        Crear curso
        <small>A continuacion podra crear un curso</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Cursos</li>
        <li class="active">Crear</li>
      </ol>
    </section>

          <div class="row">
            </div>

            <div class="col-md-6">
            <div class="box">
                        <div class="box-body">
              
              <form action="//proyecto12.test/courses/store" method="post" class="login">

                  <div class="form-group">

                  <label>Nombre del curso</label>
                  
                  <input type="text" name="name" class="form-control" placeholder="Enter course name"> 
                  <!--Aqui van los errores -->
                  <span class="text-danger"></span>

                </div>


                <div class="form-group {{ $errors->has('courses_id') ? 'has-error' : '' }}">

                  <span class="text-danger"></span>

                </div>
                
                <div class="form-group">

                  <label>Crear un subcurso</label>
                  
                  <select name="course_id" class="form-control">
                  <option value="0">Categoria padre</option> 
                      <?php foreach($courses as $course): ?>
                        <option value="<?=$course->id?>"><?=$course->name?></option>
                      <?php endforeach ?>
                  </select>
                  <span class="text-danger"></span>

                </div>

                <div class="form-group">

                  <button class="btn btn-success">Crear un nuevo curso</button>

                </div>


                </form>
              </div>
            </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">

  $("#tree1 li>a").click(function(){
    $("#curso option").attr("selected" , false);
    var texto = $(this).text();
    $("#curso option").each(function(index) {
        if(texto == $("#curso option:eq("+index+")").text()){
          $("#curso option:eq("+index+")").attr("selected" , true);
        }
    });

  });

</script>
