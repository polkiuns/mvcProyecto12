<?php $this->layout('layouts/admin/layout') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    <section class="content-header">
      <h1>
        Crear una nueva leccion
        <small>A continuacion podra crear una leccion</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Leccion</li>
        <li class="active">Crear</li>
      </ol>
    </section>
          <div class="row">
            <div class="col-md-6">
            <div class="box">
                        <div class="box-body">
              
                <form action="//proyecto12.test/lessons/store" method="post" class="login">

                  <div class="form-group">

                  <label>Nombre de la leccion</label>
                  
                  <input type="text" name="name" class="form-control" placeholder="Enter subject name"> 
                  <!--Aqui van los errores -->
                  <span class="text-danger"></span>

                </div>
              
                <div class="form-group">

                  <label>Asignatura de la leccion</label>
                  
                  <select id="subject" name="subject_id" class="form-control" required>
						<?php foreach($subjects as $subject): ?>

							<option value="<?=$subject->id?>"><?=$subject->name?>

						<?php endforeach ?>
                  </select>
                  <span class="text-danger"></span>

                </div>

                <div class="form-group">

                  <label>¿Desea crear un subtema?</label>
                  
                  <select id="lesson" name="lesson_id" class="form-control" required>

                  </select>
                  <span class="text-danger"></span>

                </div>

                <div class="form-group">

                  <label>Profesor de la leccion</label>
                  
                  <select id="teacher" name="teacher_id" class="form-control" required>

                  </select>
                  <span class="text-danger"></span>

                </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="published">Publicar
                </label>
              </div>

                <div class="form-group">

                  <button class="btn btn-success">Registrar leccion</button>

                </div>


                </form>
              </div>
            </div>
<script type="text/javascript">
  $(document).ready(function() {
      $("#subject").change(function() {
        console.log("ok");
          $("#subject option:selected").each(function() {
        console.log($(this).val());
              id_subject = $(this).val();
              $.post("http://proyecto12.test/dynamicselects/getLesson/" , {id_subject : id_subject} , function(data) {
                  console.log(data);
                  $("#lesson").html(data);
                  if($("#lesson option:selected").val() == 0)
                  {
                    $.post("http://proyecto12.test/dynamicselects/getTeachers/" , {id_subject : id_subject} , function(data) {
                      console.log(data);
                      $("#teacher").html(data);
                  });
                  } else {
                    $('#lesson').append('<option value="0">No subtema</option>');
                    $("#lesson").change(function() {
                        id_lesson = $(this).val();
                        $.post("http://proyecto12.test/dynamicselects/getTeacher/" , {id_lesson : id_lesson} , function(data){
                            console.log(data);
                            $("#teacher").html(data);
                        });
                    });
            
                  }
              });
          });
      });
  });
</script>
