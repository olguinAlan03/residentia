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

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../controlador/cRegistro.js"></script>
     <!-- daterange picker -->
<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    
</head>

<body class="register-page" style="min-height: 570.781px;">
    <div class="register-box">
        <div class="register-logo">
            <a href="../index2.html"><b>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Pagina de</font>
                    </font>
                </b>
                <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;"> Registro</font>
                </font>
            </a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">AGREGAR RESERVACIÓN</font>
                    </font>
                </p>
                <form>
                    <div class="input-group mb-3">
                        <input id="nombre" type="text" class="form-control" placeholder="Nombre">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select id="select-area_comun" class="form-control">
                            <option id="1" value="1">Salon de eventos</option>
                            <option id="2" value="2">Cancha de Futbol</option>
                            <option id="3" value="3">Piscina</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="fecha" type="text" class="form-control"
                            placeholder="Telefono">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-home"></span>


                            </div>
                        </div>
                    </div>
                    
                    <div class="input-group mb-3">
                        <input id="nombre_privada" type="text" class="form-control"
                            placeholder="Nombre del Conjunto Residencial">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-home"></span>


                            </div>
                        </div>
                    </div>
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
                    <div>
                        

                        <label for="telefono">Teléfono:</label></br>
                        <input type="number" name="telefono" id="telefono" class="cajas"></br>
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


            <script src="../plugins/jquery/jquery.min.js"></script>

            <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

            <script src="../dist/js/adminlte.min.js"></script>


<?php
            include("../includes/footerr.php");
            ?>