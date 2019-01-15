var tabla;

//Función que se ejecuta al inicio
function init() {
    console.log("entra al js");
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });



    $("#imagenmuestra").hide();

}

//Función limpiar
function limpiar() {
    $("#idimagenes_app").val("");
    $("#imagen").val("");
    $("#imagenmuestra").hide();

}

//Función mostrar formulario
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

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [{
                extend: 'pdfHtml5',
                title: 'Imagenes App',
                messageTop: 'Listado de Imagenes ',
                orientation: 'landscape',
                pageSize: 'LEGAL'

            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: '../ajax/imagenes_app.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 50, //Paginación
        "order": [
                [0, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/imagenes_app.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}

function mostrar(idimagenes_app) {
    $.post("../ajax/imagenes_app.php?op=mostrar", { idimagenes_app: idimagenes_app }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);
        $("#idimagenes_app").val(data.idimagenes_app);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/img_app/" + data.imagen);
        $("#imagenactual").val(data.imagen);
    });
}

//Función para desactivar registros
function desactivar(idimagenes_app) {
    bootbox.confirm("¿Está Seguro de desactivar?", function(result) {
        if (result) {
            $.post("../ajax/imagenes_app.php?op=desactivar", { idimagenes_app: idimagenes_app }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idimagenes_app) {
    bootbox.confirm("¿Está Seguro de activar?", function(result) {
        if (result) {
            $.post("../ajax/imagenes_app.php?op=activar", { idimagenes_app: idimagenes_app }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}



init();