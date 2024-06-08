<?php
include("../includes/top.php");
session_start();
//$nombre = $_SESSION["nombre"];
//$nombre = strtoupper($nombre);
?>

<!--<script src=""></script>
<h1>Hola
  <?php echo $nombre; ?>
  </h1>-->

  
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<section class="content">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h5 class="card-title m-0">MENÚ</h5>

    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-3 col-6">

          <div class="small-box bg-info">
            <div class="inner">
              <h3>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">USUARIOS</font>
                </font>
              </h3>
              <p>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">Consulta de usuarios</font>
                </font>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="vTabla.php" class="small-box-footer">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Más información</font>
              </font><i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">

          <div class="small-box bg-success">
            <div class="inner">
              <h3>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">EVENTOS</font>
                </font><sup style="font-size: 20px">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"></font>
                  </font>
                </sup>
              </h3>
              <p>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">Consulta de reservas</font>
                </font>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
             <a href="vTabReserva.php" class="small-box-footer">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Más información</font>
              </font><i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div> 
        <div class="col-lg-3 col-6">

          <div class="small-box bg-info">
            <div class="inner">
              <h3>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">ALTA DE AREA</font>
                </font>
              </h3>
              <p>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">Consulta de usuarios</font>
                </font>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="vTabla.php" class="small-box-footer">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Más información</font>
              </font><i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-6">

          <div class="small-box bg-info">
            <div class="inner">
              <h3>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">RESERVACION</font>
                </font>
              </h3>
              <p>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">Consulta de usuarios</font>
                </font>
              </p> 
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="vTabla.php" class="small-box-footer">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Más información</font>
              </font><i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-6">

          <div class="small-box bg-info">
            <div class="inner">
              <h3>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">AGENDA</font>
                </font>
              </h3>
              <p>
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">Consulta de usuarios</font>
                </font>
              </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="vTabla.php" class="small-box-footer">
              <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">Más información</font>
              </font><i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
</section>
</div>
</div>

<?php
include("../includes/footer.php");
?>