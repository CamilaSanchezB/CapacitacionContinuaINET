<?php include('./functions/cerrarsesion.php')?>
<div class="row mt-3 d-flex align-items-center justify-content-start">
    <div class="col-2">
        <form method="POST">
            <button name="eliminar" value="eliminar" type="submit" class="btn btn-block mb-2" style="background-color: rgba(217, 217, 217, 0.42); width: 100%; color: black">
                <i class="fas fa-check"></i> Institución
                <image src="./assets/image/logout.png" class="img-fluid" width="10%" height="10%" />
            </button>
        </form>
    </div>
</div>
<div class="row d-flex align-items-center">
    <div class="col-3">
        <img src="./assets/image/logo-inet.png" class="img-fluid">
    </div>
    <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
        <a href='?t=institucion&p=capacitaciones/capacitacion-instituciones' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(19, 140, 232, 1);  color: white;">
            <i class="fas fa-check"></i> Capacitaciones
        </a>
    </div>
    <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
        <a href='?t=institucion&p=capacitaciones/capacitacion-crear' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(19, 140, 232, 1);  color: white;">
            <i class="fas fa-check"></i> Crear Capacitaciones
        </a>
    </div>
    <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
        <a href='?t=institucion&p=docentes/docentes-validar' class="btn shadow-sm" style="height: 80%;width: 80% ;background-color:  rgba(19, 140, 232, 1);  color: white; ">
            <i class="fas fa-check"></i> Docentes
        </a>
    </div>
</div>
<hr style="border:1.5ch solid rgba(12, 104, 174, 1); opacity: 1;">