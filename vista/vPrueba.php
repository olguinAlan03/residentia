<?php
//include("../includes/top.php");
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RESIDENTIA | Página de registro</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">
    

    <!-- daterange picker -->
<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../controlador/cReserva.js"></script>
</head>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<body class="register-page" style="min-height: 570.781px;">
    <div class="register-box">
        <div class="register-logo">
            <a href="../index2.html"><b>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Pagina de</font>
                    </font>
                </b>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"> Reservación</font>
                </font>
            </a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                              <form>
                <label for="Nombre de Usuario">Área común:</label></br>
                    <div class="input-group mb-3">
                        <select id="select-AreaComun" class="form-control">
                            <option id="3" value="3">Salon de eventos</option>
                            <option id="4" value="4">Cancha de Futbol</option>
                            <option id="5" value="5">Piscina</option>
                        </select>
                    </div>
                    <label for="Nombre de Usuario">Fecha de reservación:</label></br>
                    <!-- Date range -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="reservation">
                        </div>
                    </div>
                    <label for="Nombre de Usuario">Nombre de la privada:</label></br>
                    <div class="input-group mb-3">
                        <input id="privada" type="text" class="form-control">
                        <div class="input-group-append">
                            <div class="input-group-text">
                           


                            </div>
                        </div>
                    </div>
                    <label for="Telefono">Telefono</label></br>
                    <div class="input-group mb-3">
                        <input id="tel" type="text" class="form-control">
                        <div class="input-group-append">
                            <div class="input-group-text">
                               
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                            </div>
                        </div>

                        <div class="col-4">
                            <button id="registra" class="btn btn-primary btn-block">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Registro</font>
                                </font>
                            </button>
                        </div>


                    </div>
            </div>

            <!--</body>-->


            <?php
            include("../includes/footerr.php");
            ?>