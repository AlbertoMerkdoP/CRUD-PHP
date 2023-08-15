function ValidarRegistro() {
  const username = document.getElementById("emailregis").value;
  const password = document.getElementById("pwd").value;
  const nombres = document.getElementById("nombres").value;
  const apellidos = document.getElementById("apellidos").value;
  const confirmPassword = document.getElementById("confirmPassword").value;
  const identificacion = document.getElementById("identificacion").value;

  let mensajes = "";

  if (identificacion == "")
    mensajes += "<li>Debes agregar un número de identificación</li>";
  if (nombres == "") mensajes += "<li>Debes agregar tus nombres</li>";
  if (apellidos == "") mensajes += "<li>Debes agregar tus apellidos</li>";
  if (username == "")
    mensajes += "<li>Debes agregar un correo electronico</li>";
  if (password == "") mensajes += "<li>Debes agregar una contraseña</li>";
  if (confirmPassword == "")
    mensajes += "<li>Debes confirmar la contraseña</li>";
  if (password != confirmPassword)
    mensajes += "<li>Ambas contraseñas deben ser iguales</li>";

  if (mensajes != "") {
    document.getElementById(
      "mensaje"
    ).innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`;
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  } else {
    document.forregistro.submit();
  }
}

function ValidarRoles() {
  let nombre = document.getElementById("nombre").value;
  let mensajes = "";

  if (nombre == "") mensajes += "<li>Debes ingresar nombre del rol</li>";

  if (mensajes != "") {
    document.getElementById(
      "mensaje"
    ).innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`;
  } else {
    document.forrol.submit();
  }
}

function ValidarEstudiantes() {
  const identificacion = document.getElementById("identificacion").value;
  const fnacimiento = document.getElementById("fnacimiento").value;
  const nombres = document.getElementById("nombres").value;
  const apellidos = document.getElementById("apellidos").value;
  const email = document.getElementById("email").value;
  const telefono = document.getElementById("telefono").value;
  const direccion = document.getElementById("direccion").value;

  let mensajes = "";

  if (identificacion == "")
    mensajes += "<li>Debes agregar una identificación</li>";
  if (fnacimiento == "")
    mensajes += "<li>Debe agregar una fecha de nacimiento</li>";
  if (nombres == "") mensajes += "<li>Debes agregar los nombres</li>";
  if (apellidos == "") mensajes += "<li>Debes agregar los apellidos</li>";
  if (email == "") mensajes += "<li>Debes agregar un correo electrónico</li>";
  if (telefono == "")
    mensajes += "<li>Debes agregar un número de telefono</li>";
  if (direccion == "")
    mensajes += "<li>Debes agregar una dirección de residencia</li>";

  if (mensajes != "") {
    document.getElementById(
      "mensaje"
    ).innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`;
    window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
  } else {
    document.forestudiantes.submit();
  }
}

function ValidarMaterias() {
  const nombre = document.getElementById("nombre").value;
  const hora = document.getElementById("hora").value;
  const docente = document.getElementById("docente").value;
  let mensajes = "";

  if (nombre == "") mensajes += "<li>Debes ingresar el nombre de la materia</li>";
  if (hora == "")
    mensajes += "<li>Debes ingresar la hora de la materia</li>";
  if (docente == "")
    mensajes += "<li>Debes ingresar el nombre del docente</li>";

  if (mensajes != "") {
    document.getElementById(
      "mensaje"
    ).innerHTML = `<div class='alert alert-danger' role='alert'> ${mensajes} </div>`;
    window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
  } else {
    document.formateria.submit();
  }
}
