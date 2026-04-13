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
