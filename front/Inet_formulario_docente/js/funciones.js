function calcular(params) {
  var msg = "0%";
  var cont = 0;
  if (document.getElementById("radio3").checked) {
    cont++;
  }
  if (document.getElementById("radio7").checked) {
    cont++;
  }
  if (document.getElementById("radio9").checked) {
    cont++;
  }
  if (document.getElementById("radio12").checked) {
    cont++;
  }

  if (document.getElementById("customRadio2").checked) {
    cont++;
  }

  if (document.getElementById("customRadio4").checked) {
    cont++;
  }

  if (document.getElementById("customRadio6").checked) {
    cont++;
  }
  if (document.getElementById("customRadio7").checked) {
    cont++;
  }
  if (document.getElementById("customRadio10").checked) {
    cont++;
  }
  if (document.getElementById("customRadio11").checked) {
    cont++;
  }

  if (cont == 1) {
    msg = "10%";
  }
  if (cont == 2) {
    msg = "20%";
  }
  if (cont == 3) {
    msg = "30%";
  }
  if (cont == 4) {
    msg = "40%";
  }
  if (cont == 5) {
    msg = "50%";
  }
  if (cont == 6) {
    msg = "60%";
  }
  if (cont == 7) {
    msg = "70%";
  }
  if (cont == 8) {
    msg = "80%";
  }
  if (cont == 9) {
    msg = "90%";
  }
  if (cont == 10) {
    msg = "100%";
  }

  alert("usted obtuvo el " + msg);

  alert("Total de preguntas correctas " + cont);
}
