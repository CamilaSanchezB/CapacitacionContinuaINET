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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $institucion = $_POST["institucion"];
    $cue = $_POST["cue"];
    $telefono = $_POST["telefono"];
    $localidad = $_POST["localidad"];
    $domicilio = $_POST["domicilio"];
    if (empty($institucion) || empty($cue) || empty($telefono) || empty($localidad) || empty($domicilio) || $localidad == 'Localidad' || $localidad == null) {
        echo '<script>alert("Por favor, complete todos los campos.");</script>';
    } else {
        try {
            $sentenciaSQL = $conexion->prepare("INSERT INTO `usuarios` (`email_usuario`, `contrasena_usuario`, `id_tipo_usuario`) VALUES (:email_usuario, :contrasena_usuario, :id_tipo_usuario)");

            $sentenciaSQL->bindParam(":email_usuario", $_SESSION['usuario_registro']['email_usuario']);
            $sentenciaSQL->bindParam(":contrasena_usuario", $_SESSION['usuario_registro']['contrasena_usuario']);
            $sentenciaSQL->bindParam(":id_tipo_usuario", $_SESSION['usuario_registro']['id_tipo_usuario']);

            $sentenciaSQL->execute();
            $idUsuario = $conexion->lastInsertId();
            echo `id_usuario: ` . $idUsuario;

            $sentenciaSQL = $conexion->prepare("INSERT INTO `representantes_institucionales`
            (`nombre_representante`, `apellido_representante`, `dni_representante`, `telefono_representante`)
            VALUES (:nombre_representante, :apellido_representante, :dni_representante, :telefono_representante)");

            $sentenciaSQL->bindParam(":nombre_representante", $_SESSION["representante_institucional"]["nombre_representante_institucional"]);
            $sentenciaSQL->bindParam(":apellido_representante", $_SESSION["representante_institucional"]["apellido_representante_institucional"]);
            $sentenciaSQL->bindParam(":dni_representante", $_SESSION["representante_institucional"]["dni_representante_institucional"]);
            $sentenciaSQL->bindParam(":telefono_representante", $_SESSION["representante_institucional"]["telefono_representante_institucional"]);

            $sentenciaSQL->execute();
            $idRepresentante = $conexion->lastInsertId();


            $sentenciaSQL = $conexion->prepare("INSERT INTO `instituciones`
            (`nombre_institucion`, `cue_institucion`, `domicilio_institucion`, `id_localidad`, `telefono_institucion`, `id_representante`, `id_usuario`, `estado_validacion_institucion`)
            VALUES (:nombre_institucion, :cue_institucion, :domicilio_institucion, :id_localidad, :telefono_institucion, :id_representante, :id_usuario, '0')");

            $sentenciaSQL->bindParam(":nombre_institucion", $institucion);
            $sentenciaSQL->bindParam(":cue_institucion", $cue);
            $sentenciaSQL->bindParam(":domicilio_institucion", $domicilio);
            $sentenciaSQL->bindParam(":id_localidad", $localidad);
            $sentenciaSQL->bindParam(":telefono_institucion", $telefono);
            $sentenciaSQL->bindParam(":id_representante", $idRepresentante);
            $sentenciaSQL->bindParam(":id_usuario", $idUsuario);

            $sentenciaSQL->execute();

            header('Location: ?t=cuenta&p=iniciarsesion&f=1');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
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
    <div class="container mt-5" style="min-height: 63vh;">
        <div class="card bg-light">
            <article class="card-body mx-auto col-4">
                <h4 class="card-title mt-3 text-center">Datos de la institución</h4>
                <p class="division">
                <p class="bg-light"></p>
                </p><br>
                <form method="post" action="">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <input class="form-control" name="institucion" type="text" required placeholder="Nombre de la institución" />
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="cue" class="form-control" placeholder="CUE" type="text" id="cue" oninput="validarSoloNumeros(this)" required>
                    </div>
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
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control" id="txtHint" name="localidad" id="localidad" required>
                            <option selected disabled>Localidad</option>

                        </select>
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="domicilio" class="form-control" placeholder="Domicilio" type="text" id="Domicilio" required>
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="telefono" class="form-control" placeholder="Teléfono" type="text" id="telefono" oninput="validarSoloNumeros(this)" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Completar</button>
                    </div>
                </form>
            </article>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function validarSoloNumeros(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        var idProvinciaAgregado = false; // Bandera para controlar la adición del parámetro id_provincia
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
    </script>

</body>

</html>