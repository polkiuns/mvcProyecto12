    <?php use Mini\Libs\Sesion; ?>
<div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="/">Inicio<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo URL; ?>contact">Contáctenos</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo URL; ?>courses">Cursos</a>
          </li>
          
          <?php if(Sesion::get('logged') && Sesion::get('role') == 'admin'): ?>        
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo URL; ?>admin">Mi perfil</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mis cursos</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
                <!--Mostrar cursos con el dropdown -->
            </div>
          </li>
    <?php endif ?> 
        </ul>
</div>
