var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    $.post("../ajax/imagenes.php?op=selectNoticia", function(r) {
        $("#noticias_idnoticias").html(r);
        $('#noticias_idnoticias').selectpicker('refresh');

    });


    $("#imagenmuestra").hide();


}

//Función limpiar
function limpiar() {
    $("#idimagenes").val("");
    $("#imagen").val("");
    $("#noticias_idnoticias").val("");
    $('#noticias_idnoticias').selectpicker('refresh');
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
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
                extend: 'pdfHtml5'
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: '../ajax/imagenes.php?op=listar',
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
        url: "../ajax/imagenes.php?op=guardaryeditar",
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

function mostrar(idimagenes) {
    $.post("../ajax/imagenes.php?op=mostrar", { idimagenes: idimagenes }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);


        $("#idimagenes").val(data.idimagenes);
        $("#fecha").val(data.fecha);
        $("#noticias_idnoticias").val(data.noticias_idnoticias);
        $('#noticias_idnoticias').selectpicker('refresh');

        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/imagenes/" + data.imagen);
        $("#imagenactual").val(data.imagen);

    })
}

//Función para desactivar registros
function desactivar(idimagenes) {
    bootbox.confirm("¿Está Seguro de desactivar los datos?", function(result) {
        if (result) {
            $.post("../ajax/imagenes.php?op=desactivar", { idimagenes: idimagenes }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idimagenes) {
    bootbox.confirm("¿Está Seguro de activar lod datos?", function(result) {
        if (result) {
            $.post("../ajax/imagenes.php?op=activar", { idimagenes: idimagenes }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}


init();