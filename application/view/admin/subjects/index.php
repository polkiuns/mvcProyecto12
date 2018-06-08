<?php $this->layout('layouts/admin/layout') ?>
    <section class="content-header">
      <h1>
        Todos los cursos
        <small>A continuacion se mostraran todos los cursos disponibles</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Cursos</li>
      </ol>
    </section>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listado de cursos</h3>
              </div>

            <div class="box-body">
              <table id="cursos-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Pertenece a</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
          
					<?php foreach($subjects as $subject): ?>
                    <tr>
                      <td><?= $subject->id ?></td>
                      <td><?= $subject->name ?></td>
                      <td>
                        <?php if (count($model->courseName($subject->id))) : ?>
                          <?php foreach($model->courseName($subject->id) as $course): ?>
                            | <?= $course->name ?> |
                          <?php endforeach ?>
                        <?php endif ?>
                      </td>
                      <td>
                          
                          <a href="<?php echo URL . 'subjects/edit/' . $subject->url ?>" title="Editar curso" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                         
                          <form method = "POST" action ="<?php echo URL . 'subjects/delete/' ?>" style="display: inline;">
                            <input value="<?=$subject->id?>" type="hidden" name="id">
                          <button onclick = "return confirm('¿Estas seguro de querer borrar este curso?')" title="Eliminar curso" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                          
                          </form>
                      </td>
                    </tr>

					<?php endforeach ?>     
                </tbody>
              </table>
            </div>
          </div>