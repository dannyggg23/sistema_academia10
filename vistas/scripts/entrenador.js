var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })


    $.post("../ajax/entrenador.php?op=selectSucursal", function(r) {
        $("#sucursal_idsucursal").html(r);
        $('#sucursal_idsucursal').selectpicker('refresh');

    });
    $("#imagenmuestra").hide();
}

//Función limpiar
function limpiar() {
    $("#identrenador").val("");
    $("#cedula_entrenador").val("");
    $("#nombre_entrenador").val("");
    $("#apellido_entrenador").val("");
    $("#email_entrenador").val("");
    $("#telefono_entrenador").val("");
    $("#celular_entrenador").val("");
    $("#direccion_entrenador").val("");
    $("#sucursal_idsucursal").val("");
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
            url: '../ajax/entrenador.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //Paginación
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
        url: "../ajax/entrenador.php?op=guardaryeditar",
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

function mostrar(identrenador) {
    $.post("../ajax/entrenador.php?op=mostrar", { identrenador: identrenador }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);



        $("#sucursal_idsucursal").val(data.sucursal_idsucursal);
        $('#sucursal_idsucursal').selectpicker('refresh');

        $("#identrenador").val(data.identrenador);
        $("#cedula_entrenador").val(data.cedula_entrenador);
        $("#nombre_entrenador").val(data.nombre_entrenador);
        $("#apellido_entrenador").val(data.apellido_entrenador);



        $("#email_entrenador").val(data.email_entrenador);
        $("#telefono_entrenador").val(data.telefono_entrenador);

        $("#celular_entrenador").val(data.celular_entrenador);
        $("#direccion_entrenador").val(data.direccion_entrenador);

        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/entrenadores/" + data.imagen_entrenador);
        $("#imagenactual").val(data.imagen_entrenador);

    })
}

//Función para desactivar registros
function desactivar(identrenador) {
    bootbox.confirm("¿Está Seguro de desactivar los datos?", function(result) {
        if (result) {
            $.post("../ajax/entrenador.php?op=desactivar", { identrenador: identrenador }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(identrenador) {
    bootbox.confirm("¿Está Seguro de activar el Artículo?", function(result) {
        if (result) {
            $.post("../ajax/entrenador.php?op=activar", { identrenador: identrenador }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}


init();