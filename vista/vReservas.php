<?php
//include("../includes/top.php");
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RESIDENTIA | Página de registro</title>
    

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="../dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">

    <link rel="stylesheet" href="../plugins/animate.css/animate.css">

    <link rel="stylesheet" href="../estilos.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../controlador/cReserva.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.min.js"></script>
    <script src="../plugins/sweetAlert2/sweetalert2.all.min.js"></script>
    <script src="../codigo.js"></script>
    
</head>

<body class="hold-transition login-page" style="background-image: url('../dist/img/fondo_reservas.jpg') ;"></body>

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
                    <label for="Nombre de area">Área común:</label></br>
                    <div class="input-group mb-3">
                        <select id="select-AreaComun" class="form-control">
                            <option id="1" value="1">Salon de eventos</option>
                            <option id="2" value="2">Cancha de Futbol</option>
                            <option id="3" value="3">Piscina</option>
                        </select>
                    </div>
                    <label for="Fecha reserva">Fecha de reservación:</label></br>
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
                    <label for="Horario">Horario:</label></br>
                    <div class="form-group">
                        <div class="form-check">
                            <input id="horario" class="form-check-input" type="radio" name="radio1">
                            <label class="form-check-label">9:00am-12:00pm</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" checked="">
                            <label class="form-check-label">01:00pm-04:00pm</label>
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div>
                            <label for="profile_pic">Comprobante de pago:</label>
                            <input type="file" id="id_comprobante_pago" name="profile_pic" accept=".jpg, .jpeg, .png" />
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