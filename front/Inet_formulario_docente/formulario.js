document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const vectorRespuestas = new Array(5).fill(0);

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        // Obtener respuestas de los radio buttons
        const contribucion = document.querySelector('input[name="contribucion"]:checked').value;
        const calidadMaterial = document.querySelector('input[name="calidad_material"]:checked').value;
        const multiplicador = document.querySelector('input[name="multiplicador"]:checked').value;
        const acompanamiento = document.querySelector('input[name="acompanamiento"]:checked').value;

        // Obtener respuesta del select
        const capacitacion = document.getElementById("capacitacion").value;

        // Mapear respuestas a valores
        const respuestas = {
            "no": -2,
            "probablemente_no": -1,
            "indeciso": 0,
            "probablemente_si": 1,
            "si": 2,
            "robotica":1,
            "matematica":2,
            "bigdata":3,
            "impresion3d":4,
            "ia":5,
        };

        // Asignar valores al vector de respuestas
        vectorRespuestas[0] = respuestas[capacitacion];
        vectorRespuestas[1] = respuestas[contribucion];
        vectorRespuestas[2] = respuestas[calidadMaterial ];
        vectorRespuestas[3] = respuestas[multiplicador];
        vectorRespuestas[4] = respuestas[acompanamiento];
        

        // Mostrar el Vector en Alertas
        alert(vectorRespuestas);
      
    });
});