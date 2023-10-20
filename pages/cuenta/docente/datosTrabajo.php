<?php
require('./config/db-connection.php');
session_start();
try {
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `provincias`");
    $sentenciaSQL->execute();
    $provincias = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
try {
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `especialidades`");
    $sentenciaSQL->execute();
    $especialidades = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include ('./functions/insertarDetalleDocente.php');
    if (isset($_POST["institucion1"]) && $_POST["especialidad1"]) {
        
        try {
            $sentenciaSQL = $conexion->prepare("INSERT INTO `usuarios` (`email_usuario`, `contrasena_usuario`, `id_tipo_usuario`) VALUES (:email_usuario, :contrasena_usuario, :id_tipo_usuario)");

            $sentenciaSQL->bindParam(":email_usuario", $_SESSION['usuario_registro']['email_usuario']);
            $sentenciaSQL->bindParam(":contrasena_usuario", $_SESSION['usuario_registro']['contrasena_usuario']);
            $sentenciaSQL->bindParam(":id_tipo_usuario", $_SESSION['usuario_registro']['id_tipo_usuario']);

            $sentenciaSQL->execute();
            $idUsuario = $conexion->lastInsertId();

            $sentenciaSQL = $conexion->prepare("INSERT INTO `docentes`
            (`nombre_docente`, `apellido_docente`, `dni_docente`, `id_usuario`) 
            VALUES (:nombre_docente, :apellido_docente, :dni_docente, :id_usuario)");
            $sentenciaSQL->bindParam(":nombre_docente", $_SESSION['docente']['nombre_docente']);
            $sentenciaSQL->bindParam(":apellido_docente", $_SESSION['docente']['apellido_docente']);
            $sentenciaSQL->bindParam(":dni_docente", $_SESSION['docente']['dni_docente']);
            $sentenciaSQL->bindParam(":id_usuario", $idUsuario);

            $sentenciaSQL->execute();
            $idDocente = $conexion->lastInsertId();

            insertarDetalleDocente($idDocente, $_POST["institucion1"], $_POST["especialidad1"]);
            for ($i = 2; $i <= 5; $i++) {
                $institucion = $_POST["institucion$i"];
                $especialidad = $_POST["especialidad$i"];
            
                if (isset($institucion) && isset($especialidad) && $institucion != 'Institucion' && $especialidad != 'Especialidad') {
                    insertarDetalleDocente($idDocente, $institucion, $especialidad);
                }
            }
            header('Location: ?t=cuenta&p=iniciarsesion&f=1');
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    } else {
        echo '<script>alert("Por favor, complete los campos obligatorios.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="../elementos/estilos.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <img src="./assets/image/logo-inet.png" alt="Imagen de encabezado" style="width: 20%; margin-left: 40%; margin-top: 70px;">
    <div class="container mt-5" style="min-height:63vh;">
        <div class="card bg-light">
            <article class="card-body mx-auto col-8">
                <h4 class="card-title mt-3 text-center">Datos laborales</h4>
                <h6 class="card-title mt-3 text-center text-danger">Rellene sólo los campos necesarios</h6>
                <p class="division">
                <p class="bg-light"></p>
                </p><br>
                <form method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="provincia" id="provincia" onchange="showUser(this.value)" required>
                            <option selected disabled>Provincia</option>
                            <?php foreach ($provincias as $provincia) {
                                echo "<option value='{$provincia['id_provincia']}'>" . $provincia['nombre_provincia'] . "</option>";
                            } ?>
                        </select>
                        <div class="col-1"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" id="txtHint" name="localidad" id="localidad" onchange="CambiarInstitucion(this.value)" required>
                            <option selected disabled>Localidad</option>

                        </select>
                    </div>
                    <small>Institución 1 <span class="text-danger">*</span></small>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="institucion1" id="institucion1" required>
                            <option selected disabled>Institución</option>
                        </select>
                        <div class="col-1"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="especialidad1" id="especialidad" required>
                            <option selected disabled>Especialidad</option>
                            <?php foreach ($especialidades as $especialidad) {
                                echo "<option value='{$especialidad['id_especialidad']}'>" . $especialidad['nombre_especialidad'] . "</option>";
                            } ?>
                        </select>
                    </div>
                    <small>Institución 2</small>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="institucion2" id="institucion2">
                            <option selected disabled>Institucion</option>
                        </select>
                        <div class="col-1"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="especialidad2" id="especialidad">
                            <option selected >Especialidad</option>
                            <?php foreach ($especialidades as $especialidad) {
                                echo "<option value='{$especialidad['id_especialidad']}'>" . $especialidad['nombre_especialidad'] . "</option>";
                            } ?>
                        </select>
                    </div>
                    <small>Institución 3</small>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="institucion3" id="institucion3">
                            <option selected disabled>Institucion</option>
                        </select>
                        <div class="col-1"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="especialidad3" id="especialidad">
                            <option selected >Especialidad</option>
                            <?php foreach ($especialidades as $especialidad) {
                                echo "<option value='{$especialidad['id_especialidad']}'>" . $especialidad['nombre_especialidad'] . "</option>";
                            } ?>
                        </select>
                    </div>
                    <small>Institución 4</small>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="institucion4" id="institucion4">
                            <option selected disabled>Institucion</option>
                        </select>
                        <div class="col-1"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="especialidad4" id="especialidad">
                            <option selected >Especialidad</option>
                            <?php foreach ($especialidades as $especialidad) {
                                echo "<option value='{$especialidad['id_especialidad']}'>" . $especialidad['nombre_especialidad'] . "</option>";
                            } ?>
                        </select>
                    </div>
                    <small>Institución 5</small>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="institucion5" id="institucion5">
                            <option selected disabled>Institucion</option>
                        </select>
                        <div class="col-1"></div>
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" name="especialidad5" id="especialidad">
                            <option selected >Especialidad</option>
                            <?php foreach ($especialidades as $especialidad) {
                                echo "<option value='{$especialidad['id_especialidad']}'>" . $especialidad['nombre_especialidad'] . "</option>";
                            } ?>
                        </select>
                    </div>

                    <p><span class="text-danger">*</span>Campo obligatorio</p>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Completar</button>
                    </div>
                </form>
            </article>
        </div>
    </div>
    <script>
        function validarSoloNumeros(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var card = document.querySelector(".card");
            card.classList.add("show");
        });
    </script>
    <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "./functions/obtenerLocalidades.php?id_provincia=" + str, true);
                xmlhttp.send();
            }
        }
        var select = document.getElementById('localidad');
        console.log(select);
        select.addEventListener('change', function() {
            var selectedValue = select.value;
            // Aquí puedes realizar acciones basadas en la opción seleccionada.
            console.log('Opción seleccionada:', selectedValue);
        });

        function CambiarInstitucion(str) {
            if (str == "") {
                document.getElementById("institucion1").innerHTML = "";
                document.getElementById("institucion2").innerHTML = "";
                document.getElementById("institucion3").innerHTML = "";
                document.getElementById("institucion4").innerHTML = "";
                document.getElementById("institucion5").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("institucion1").innerHTML = this.responseText;
                        document.getElementById("institucion2").innerHTML = this.responseText;
                        document.getElementById("institucion3").innerHTML = this.responseText;
                        document.getElementById("institucion4").innerHTML = this.responseText;
                        document.getElementById("institucion5").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "./functions/obtenerInstituciones.php?id_localidad=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</body>

</html>