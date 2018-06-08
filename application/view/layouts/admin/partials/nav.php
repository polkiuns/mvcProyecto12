      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navegacion</li>
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href="<?php echo URL; ?>"><i class="fa fa-home"></i> <span>Pagina principal</span></a></li>

        <li class=""><a href="<?php echo URL; ?>admin"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <!--Comprobar si es root -->
        <li class="treeview">
          <a href="#"><i class="fa fa-bars"></i> <span>Cursos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?php echo URL; ?>admin/courses"><i class="fa fa-eye"></i>Ver todos los cursos</a></li>
            <li><a href="<?php echo URL; ?>courses/create"><i class="fa fa-pencil"></i>Crear un curso</a></li>
          </ul>
        </li>
        <!--dejar Comprobar si es root -->
        <!-- Comprobar si es root o profesor-->
        <li class="treeview">
          <a href="#"><i class="fa fa-bars"></i> <span>Asignaturas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?php echo URL; ?>admin/subjects"><i class="fa fa-eye"></i>Ver todos las asignaturas</a></li>
        <!-- Comprobar si es root -->
            <li><a href="<?php echo URL; ?>subjects/create"><i class="fa fa-pencil"></i>Crear una asignatura</a></li>
        <!-- dejar Comprobar si es root o profesor-->
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-bars"></i> <span>Lecciones</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?php echo URL; ?>admin/lessons"><i class="fa fa-eye"></i>Mostrar todas las lecciones</a></li>
            <li><a href="<?php echo URL; ?>lessons/create"><i class="fa fa-pencil"></i>Crear una nueva leccion</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-bars"></i> <span>Clases</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?php echo URL; ?>admin/clases"><i class="fa fa-eye"></i>Mostrar todas las clases</a></li>
            <li><a href="<?php echo URL; ?>clases/create"><i class="fa fa-pencil"></i>Crear una nueva clase</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-bars"></i> <span>Profesores</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?php echo URL; ?>admin/teachers"><i class="fa fa-eye"></i>Listado de profesores</a></li>
            <li><a href="<?php echo URL; ?>teachers/create"><i class="fa fa-pencil"></i>Registrar un profesor</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-bars"></i> <span>Alumnos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?php echo URL; ?>admin/students"><i class="fa fa-eye"></i>Listado de alumnos</a></li>
            <li><a href="<?php echo URL; ?>students/create"><i class="fa fa-pencil"></i>Registrar un Alumno</a></li>
          </ul>
        </li>
      </ul>