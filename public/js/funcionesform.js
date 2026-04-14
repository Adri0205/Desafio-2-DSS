function validarFormulario(e) {
  e.preventDefault();

  const nombre = document.getElementById("nombre").value.trim();
  const edad = document.getElementById("edad").value.trim();
  const telefono = document.getElementById("telefono").value.trim();
  const sexo = document.getElementById("sexo").value;
  const ocupacion = document.getElementById("ocupacion").value;
  const fecha = document.getElementById("fecha").value;

  let errores = [];

  if (nombre === "") {
    errores.push("El nombre es requerido");
  } else if (nombre.length < 3) {
    errores.push("El nombre debe contener al menos 3 caracteres");
  } else if (nombre.length > 100) {
    errores.push("El nombre no puede exceder 100 caracteres");
  } else if (!/^[a-záéíóúñA-ZÁÉÍÓÚÑ\s]+$/.test(nombre)) {
    errores.push("El nombre solo debe contener letras");
  }

  if (edad === "") {
    errores.push("La edad es requerida");
  } else if (isNaN(edad)) {
    errores.push("La edad debe ser un número");
  } else if (parseInt(edad) < 1 || parseInt(edad) > 120) {
    errores.push("La edad debe estar entre 1 y 120 años");
  }

  if (telefono === "") {
    errores.push("El teléfono es requerido");
  } else if (!/^[0-9\-\s\+\(\)]+$/.test(telefono)) {
    errores.push("El teléfono contiene caracteres inválidos");
  } else if (telefono.replace(/\D/g, "").length < 7) {
    errores.push("El teléfono debe contener al menos 7 dígitos");
  }

  if (sexo === "" || sexo === "Seleccionar") {
    errores.push("Debe seleccionar un sexo");
  }

  if (ocupacion === "" || ocupacion === "Seleccionar") {
    errores.push("Debe seleccionar una ocupación");
  }

  if (fecha === "") {
    errores.push("La fecha de nacimiento es requerida");
  } else {
    const fechaCaptura = new Date(fecha);
    const hoy = new Date();
    hoy.setHours(0, 0, 0, 0);

    if (fechaCaptura > hoy) {
      errores.push("La fecha de nacimiento no puede ser en el futuro");
    }

    const edad_calculada = hoy.getFullYear() - fechaCaptura.getFullYear();
    if (edad_calculada < 1 || edad_calculada > 120) {
      errores.push(
        "La fecha de nacimiento no es válida (edad debe ser 1-120 años)",
      );
    }
  }

  if (errores.length > 0) {
    Swal.fire({
      icon: "error",
      title: "Errores en el formulario",
      html:
        "<ul style='text-align: left;'>" +
        errores.map((err) => "<li>" + err + "</li>").join("") +
        "</ul>",
      confirmButtonColor: "#dc3545",
    });
    return false;
  }

  document.getElementById("formaPersona").submit();
}

document.addEventListener("DOMContentLoaded", function () {
  const formulario = document.getElementById("formaPersona");
  if (formulario) {
    formulario.addEventListener("submit", validarFormulario);
  }
});

function alerta(id) {
  Swal.fire({
    title: "¿Eliminar persona?",
    text: "Esta acción no se puede deshacer. ¿Está seguro de que desea continuar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
    backdrop: true,
    allowOutsideClick: false,
    allowEscapeKey: false,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href =
        window.location.href.split("Main")[0] + "Main/eliminarPersona/" + id;
    }
  });
}

function modificar(id, nombre, edad, telefono, sexo, ocupacion, fecha) {
  document.getElementById("idpersona").value = id;
  document.getElementById("nombre").value = nombre;
  document.getElementById("edad").value = edad;
  document.getElementById("sexo").value = sexo;
  document.getElementById("telefono").value = telefono;
  document.getElementById("ocupacion").value = ocupacion;
  document.getElementById("fecha").value = fecha;

  // Cambiar la acción del formulario a modificarPersona
  var formulario = document.getElementById("formaPersona");
  var baseUrl = window.location.href.split("Main")[0];
  formulario.action = baseUrl + "Main/modificarPersona";

  // Cambiar el texto del botón
  var btnSubmit = formulario.querySelector("input[type='submit']");
  btnSubmit.value = "Actualizar Persona";

  // Scroll al formulario
  document.querySelector(".form-group").scrollIntoView({ behavior: "smooth" });
}

function generarPDF() {
  const element = document.getElementById("tablaPersonas");

  if (!element) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "No se encontró la tabla de personas",
      confirmButtonColor: "#dc3545",
    });
    return;
  }

  const header =
    '<div style="text-align: center; margin-bottom: 30px;"><h2 style="color: #333; font-weight: bold;">Reporte de Personas</h2><p style="color: #666;">Generado el: ' +
    new Date().toLocaleDateString("es-ES") +
    "</p></div>";

  const opt = {
    margin: 15,
    filename: "reporte_personas_" + new Date().getTime() + ".pdf",
    image: { type: "jpeg", quality: 0.98 },
    html2canvas: { scale: 2, useCORS: true },
    jsPDF: { orientation: "landscape", unit: "mm", format: "a4" },
    pagebreak: { mode: ["avoid-all", "css", "legacy"] },
  };

  // Crear contenedor temporal sin los botones de operaciones
  const tempDiv = document.createElement("div");
  const tablaClone = element.cloneNode(true);

  // Limitar el ancho de las columnas para mejor visualización
  tablaClone.style.width = "100%";
  tablaClone.style.fontSize = "12px";

  tempDiv.innerHTML = header;
  tempDiv.appendChild(tablaClone);
  tempDiv.style.color = "#333";

  html2pdf().set(opt).from(tempDiv).save();

  Swal.fire({
    icon: "success",
    title: "¡PDF generado!",
    html: "<h5>El reporte ha sido descargado exitosamente</h5>",
    confirmButtonColor: "#28a745",
    timer: 3000,
    timerProgressBar: true,
  });
}
