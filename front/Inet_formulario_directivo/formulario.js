document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const vectorRespuestas = new Array(7).fill(0);

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        // Obtener respuestas de los nuevos select
        const institucion = document.getElementById("institucion").value;
        const especialidad = document.getElementById("especialidad").value;

        // Mapear respuestas de los nuevos select a valores
        const respuestasNuevoSelect = {
            "institucion1": 1,
            "institucion2": 2,
            "institucion3": 3,
            "esp1": 1,
            "esp2": 2,
            "esp3": 3,
        };

        // Asignar valores de los nuevos select al vector de respuestas
        vectorRespuestas[0] = respuestasNuevoSelect[institucion];
        vectorRespuestas[1] = respuestasNuevoSelect[especialidad];

        // Obtener respuestas de los radio buttons y el select
        const replicador = document.querySelector('input[name="replicador"]:checked').value;
        const impactoPedagogico = document.querySelector('input[name="impacto_pedagogico"]:checked').value;
        const continuarCapacitacion = document.querySelector('input[name="continuar_capacitacion"]:checked').value;
        const sugerirCambios = document.getElementById("sugerir_cambios").value;
        const replicaInstitucion = document.querySelector('input[name="replica_institucion"]:checked').value;

        // Mapear respuestas a valores
        const respuestas = {
            "no": -2,
            "probablemente_no": -1,
            "indeciso": 0,
            "probablemente_si": 1,
            "si": 2,
        };

        // Asignar valores al vector de respuestas
        vectorRespuestas[2] = respuestas[replicador];
        vectorRespuestas[3] = respuestas[impactoPedagogico];
        vectorRespuestas[4] = respuestas[continuarCapacitacion];

        // Mapear respuestas del select a valores
        const respuestasSelect = {
            "ninguno": 0,
            "cambio_capacitacion": 1,
            "profundizar_contenidos": 2,
            "aumentar_cupos": 3,
        };

        // Asignar valor del select al vector de respuestas
        vectorRespuestas[5] = respuestasSelect[sugerirCambios];

        // Mapear respuestas de la nueva pregunta a valores
        vectorRespuestas[6] = respuestas[replicaInstitucion];

        // Mostrar el Vector en Alertas
        alert(vectorRespuestas);
        //Aca ya se puede subir el vector
    });
});
