<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <hr class="mt-0" style="border:2ch solid rgba(125, 125, 125, 1); opacity: 1;">
    <div class="container">
        <div class="row mt-3 d-flex align-items-center justify-content-end">
            <div class="col-2">
                <button type="button" class="btn btn-block" style="background-color: rgba(19, 140, 232, 1);  color: rgba(77, 74, 74, 1);width: 100%;">
                    <i class="fas fa-check"></i> Institución
                </button>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-3">
                <img src='./assets/image/logo-inet.png' class="img-fluid">
            </div>
            <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <button type="button" class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
                    <i class="fas fa-check"></i> Capacitaciones
                </button>
            </div>
            <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <button type="button" class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
                    <i class="fas fa-check"></i> Crear Capacitaciones
                </button>
            </div>
            <div class="col-3 d-flex justify-content-end align-items-center" style="height: 6ch;">
                <button type="button" class="btn shadow-sm" style="height: 80%;width: 80% ;background-color: rgba(217, 217, 217, 0.42);  color: rgba(188, 182, 182, 1);">
                    <i class="fas fa-check"></i> Docentes
                </button>
            </div>
        </div>
        <hr style="border:2ch solid rgba(12, 104, 174, 1); opacity: 1;">
        <h1 style="color: rgba(129, 129, 129, 1);font-weight: normal; ">Crear capacitación</h1>
        <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
            <label for="nombre" class="col-sm-3 col-form-label text-secondary d-flex align-items-center" style="font-size: 35px;">Nombre Capacitación</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="nombre" style="height: 6ch;">
            </div>
        </div>
        <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
            <label for="seleccion" class="col-sm-3 col-form-label text-secondary d-flex align-items-center" style="font-size: 35px;">Tipo de educación</label>
            <div class="col-sm-6">
                <select class="form-control col-6" id="seleccion" style="height: 6ch;">
                    <option value="opcion1">Opción 1</option>
                    <option value="opcion2">Opción 2</option>
                    <option value="opcion3">Opción 3</option>
                </select>
            </div>
        </div>
        <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
            <label for="nombre" class="col-sm-3 col-form-label text-secondary d-flex align-items-center" style="font-size: 35px;">Fecha de inicio</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" id="nombre" style="height: 6ch;">
            </div>
        </div>
        <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
            <label for="nombre" class="col-sm-3 col-form-label text-secondary d-flex align-items-center" style="font-size: 35px;">Fecha de finalización</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" min="" id="nombre" style="height: 6ch;">
            </div>
        </div>
        <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
            <label for="seleccion" class="col-sm-3 col-form-label text-secondary d-flex align-items-center" style="font-size: 35px;">Dias y horarios</label>
            <div class="col-sm-6">
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="nombre" style="height: 6ch;">
                </div>
            </div>
        </div>
        <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
            <label for="seleccion" class="col-sm-3 col-form-label text-secondary d-flex align-items-center" style="font-size: 35px;">Modalidad</label>
            <div class="col-sm-6">
                <select class="form-select" id="seleccion" style="height: 6ch;">
                    <option value="opcion1">Virtual</option>
                    <option value="opcion2">Presencial</option>
                    <option value="opcion3">Híbrido</option>
                </select>
            </div>
        </div>
        <div class="form-group row mt-4 d-flex align-items-center justify-content-start">
            <label for="seleccion" class="col-sm-3 col-form-label text-secondary d-flex align-items-center" style="font-size: 35px;">Lugar/Plataforma</label>
            <div class="col-sm-6">
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="nombre" style="height: 6ch;">
                </div>
            </div>
        </div>
        
        <div class="col-12 d-flex justify-content-center align-items-center mt-5" style="height: 6ch;">
        <button type="button" class="btn btn-primary btn-lg">Crear capacitación</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>