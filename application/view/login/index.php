<?php $this->layout('layouts/layout') ?>

<div class="container">
  <h2>Login de usuarios</h2>  
  <?php $this->insert('partials/feedback') ?>   
  <form action="//mini3.dev/login/dologin" method="post" class="login">
    <section>
      <label>Email:</label> <input type="text" name="email">
      <br />
      <label>Clave:</label> <input type="password" name="clave">
      <br />
      <label>Recordarme:</label> <input type="checkbox" name="recordarme" value="1">
      <br />
      <label>&nbsp;</label> <input type="submit" value="Acceder">
    </section>
  </form>
</div>