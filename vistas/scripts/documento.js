

var tabla;

function init() {
    console.log("entra al js");
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    $("#imagenmuestra").hide();
}

function limpiar() {
  $("#id_documento").val("");$("#nombre").val("");$("#descripcion").val("");$("#tipo").val("");$("#imagenactual").val("");$("#imagenmuestra").attr("src", "");$("#imagenmuestra").hide();$("#imagen").val("");
}

function mostrarform(flag) {
  limpiar();
  if (flag) {
      $("#listadoregistros").hide();
      $("#formularioregistros").show();
      $("#btnGuardar").prop("disabled", false);
      $("#btnagregar").hide();
  } else {
      $("#listadoregistros").show();
      $("#formularioregistros").hide();
      $("#btnagregar").show();
  }
}

function cancelarform() {
  limpiar();
  mostrarform(false);
}

function listar() {
  tabla = $("#tbllistado").dataTable({
      "aProcessing": true, 
      "aServerSide": true, 
      dom: "Bfrtip", 
      buttons: [{
              extend: "pdfHtml5",
              title: "Documento"
          },
          "copyHtml5",
          "excelHtml5",
          "csvHtml5"
      ],
      "ajax": {
          url: "../ajax/documento.php?op=listar",
          type: "get",
          dataType: "json",
          error: function(e) {
              console.log(e.responseText);
          }
      },
      "bDestroy": true,
      "iDisplayLength": 20, 
      "order": [
              [0, "desc"]
          ]
  }).DataTable();
}

function guardaryeditar(e) {
  e.preventDefault();
  $("#btnGuardar").prop("disabled", true);
  var formData = new FormData($("#formulario")[0]);
  $.ajax({
      url: "../ajax/documento.php?op=guardaryeditar",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(datos) {
          if (datos) {
              swal("GUARDADO", "Sus datos han sido guardado", "success");
              mostrarform(false);
              tabla.ajax.reload();
          } else {
              swal("ERROR", "Revise los datos", "error");
              mostrarform(false);
              tabla.ajax.reload();
          }
      }
  });
  limpiar();
}

function mostrar(id_documento) {
  $.post("../ajax/documento.php?op=mostrar", { id_documento: id_documento }, function(data, status) {
      data = JSON.parse(data);
      mostrarform(true);
    $("#id_documento").val(data.id_documento);$("#nombre").val(data.nombre);$("#descripcion").val(data.descripcion);$("#tipo").val(data.tipo);$("#imagenmuestra").show();$("#imagenmuestra").attr("src", "../files/documento/" + data.imagen);$("#imagenactual").val(data.imagen);
  });
}

function desactivar(id_documento) {
  swal({
          title: "Desactivar!",
          text: "¿Está Seguro de desactivar?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              $.post("../ajax/documento.php?op=desactivar", { id_documento: id_documento }, function(e) {
                  if (e) {
                      swal("Desactivado", "Sus datos han sido Desactivados", "success");
                      mostrarform(false);
                      tabla.ajax.reload();
                  } else {
                      swal("ERROR", "Revise los datos", "error");
                      mostrarform(false);
                      tabla.ajax.reload();
                  }
              });
          } else {
          }
      });
}

function activar(id_documento) {
  swal({
          title: "Activar!",
          text: "¿Está Seguro de activar?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              $.post("../ajax/documento.php?op=activar", { id_documento: id_documento }, function(e) {
                  if (e) {
                      swal("Activado", "Sus datos han sido Desactivados", "success");
                      mostrarform(false);
                      tabla.ajax.reload();
                  } else {
                      swal("ERROR", "Revise los datos", "error");
                      mostrarform(false);
                      tabla.ajax.reload();
                  }
              });
          } else {}
      });
}
init();

