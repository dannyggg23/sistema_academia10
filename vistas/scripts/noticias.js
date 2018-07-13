var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })


    $("#imagenmuestra").hide();


}

//Función limpiar
function limpiar() {
    $("#idnoticias").val("");
    $("#titulo").val("");
    $("#fecha").val("");
    $("#descripcion").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#imagen").val("");


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
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: '../ajax/noticias.php?op=listar',
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
        url: "../ajax/noticias.php?op=guardaryeditar",
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

function mostrar(idnoticias) {
    $.post("../ajax/noticias.php?op=mostrar", { idnoticias: idnoticias }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);


        $("#idnoticias").val(data.idnoticias);
        $("#titulo").val(data.titulo);
        $("#fecha").val(data.fecha);
        $("#descripcion").val(data.descripcion);

        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/noticias/" + data.imagen);
        $("#imagenactual").val(data.imagen);

    })
}

//Función para desactivar registros
function desactivar(idnoticias) {
    bootbox.confirm("¿Está Seguro de desactivar los datos?", function(result) {
        if (result) {
            $.post("../ajax/noticias.php?op=desactivar", { idnoticias: idnoticias }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idnoticias) {
    bootbox.confirm("¿Está Seguro de activar lod datos?", function(result) {
        if (result) {
            $.post("../ajax/noticias.php?op=activar", { idnoticias: idnoticias }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}


init();