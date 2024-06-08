<?php
//include("../includes/top.php");
?>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{metaTags.title}}</title>
    <meta name="description" content="{{metaTags.description}}">
    <meta name="keywords" content="{{metaTags.keywords}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../controlador/bookings.js"></script>
    <script src="../controlador/saveBooking.js"></script>
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

<div class="container">
    <div class="title-container">
        <h1>Sistema de reservas</h1>
        <p>Llene el formulario para ejecutar la reserva correctamente</p>
    </div>
    <form class="form-container">
        <label class="validate-text-inactive" id="validate-name">El nombre es obligatorio</label>
        <input type="text" name="name" placeholder="Nombre" id="name">
        <label class="validate-text-inactive" id="validate-lastName">El apellido es obligatorio</label>
        <input type="text" name="lastName" placeholder="Apellido" id="lastName">
        <label class="validate-text-inactive" id="validate-phone">El teléfono es obligatorio</label>
        <input type="text" name="phone" placeholder="Teléfono" id="phone">
        <label class="validate-text-inactive" id="validate-email">El email es obligatorio</label>
        <input type="email" name="email" placeholder="Email" id="email">
        <label class="validate-text-inactive" id="validate-date">La fecha es obligatoria</label>
        <input placeholder="Date" type="text" onfocus="(this.type='date')" id="date">
        <label class="validate-text-inactive" id="validate-time">La hora es obligatoria</label>
        <input placeholder="Time" type="text" onfocus="(this.type='time')" id="time">
    </form>
    <div class="button-container">
        <button id="action" class="btnReserve" type="submit">Reservar</button>
    </div>
</div>

<?php
include("../includes/footerr.php");
?>