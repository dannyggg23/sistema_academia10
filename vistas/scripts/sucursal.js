var tabla;

//Función que se ejecuta al inicio
function init() {
    console.log("entra al js");
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    //Cargamos los items al select categoria
    $.post("../ajax/sucursal.php?op=selectCiudad", function(r) {
        $("#ciudad_idCiudad").html(r);
        $('#ciudad_idCiudad').selectpicker('refresh');

    });

    $("#imagenmuestra").hide();

}

//Función limpiar
function limpiar() {
    $("#idsucursal").val("");
    $("#nombre_sucursal").val("");
    $("#direrccion_ducursal").val("");
    $("#telefono_sucursal").val("");
    $("#encargado_sucursal").val("");
    $("#ciudad_idCiudad").val("0");
    $('#ciudad_idCiudad').selectpicker('refresh');
    $("#imagenmuestra").attr("src", "");
    $("#imagenmuestra").val("");
    $("#imagenactual").val("");
    $("#imagen").val("");

    $("#latitud_sucursal").val("");
    $("#longitud_sucursal").val("");

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
                title: 'Sucursales',
                messageTop: 'Listado de sucursales ',
                orientation: 'landscape',
                pageSize: 'LEGAL'

            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: '../ajax/sucursal.php?op=listar',
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
        url: "../ajax/sucursal.php?op=guardaryeditar",
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

function mostrar(idsucursal) {
    $.post("../ajax/sucursal.php?op=mostrar", { idsucursal: idsucursal }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idsucursal").val(data.idsucursal);
        $("#nombre_sucursal").val(data.nombre_sucursal);
        $("#direrccion_ducursal").val(data.direrccion_ducursal);
        $("#telefono_sucursal").val(data.telefono_sucursal);
        $("#encargado_sucursal").val(data.encargado_sucursal);
        $("#ciudad_idCiudad").val(data.ciudad_idCiudad);
        $('#ciudad_idCiudad').selectpicker('refresh');
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/sucursales/" + data.imagen);
        $("#imagenactual").val(data.imagen);
        $("#latitud_sucursal").val(data.latitud_sucursal);
        $("#longitud_sucursal").val(data.longitud_sucursal);


    })
}

//Función para desactivar registros
function desactivar(idsucursal) {
    bootbox.confirm("¿Está Seguro de desactivar?", function(result) {
        if (result) {
            $.post("../ajax/sucursal.php?op=desactivar", { idsucursal: idsucursal }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idsucursal) {
    bootbox.confirm("¿Está Seguro de activar?", function(result) {
        if (result) {
            $.post("../ajax/sucursal.php?op=activar", { idsucursal: idsucursal }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}



init();