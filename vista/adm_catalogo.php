<?php
session_start();
if($_SESSION['us_tipo']==1 ||$_SESSION['us_tipo']==2 ||$_SESSION['us_tipo']==4){//comprovamos q el usuario se de tipo administrador para q nos permita entrar a la pagina
    include_once'layouts/header.php';
?>
  <title>Adm | Catalogo</title>
  <?php
  include_once'layouts/nav.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Blank Page</h1>
          </div>

          <div class="section-body">
          </div>
        </section>
  </div>
  <!-- /.content-wrapper -->
 <?php
 include_once'layouts/footer.php';
 ?>

<?php
}else{//si no es q me mande al index de nuevo en este caso al login
    header('Location:../index.php');
}
?>