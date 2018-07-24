var tabla;

//Función que se ejecuta al inicio
function init() {
    console.log("entra al js");
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    $.post("../ajax/productos_servicios.php?op=selectCategoria_ps", function(r) {
        $("#categorias_productos_servicios_idcategorias_productos_servicios").html(r);
        $('#categorias_productos_servicios_idcategorias_productos_servicios').selectpicker('refresh');

    });
}

//Función limpiar
function limpiar() {
    $("#idproductos_servicios").val("");
    $("#nombre_productos_servicios").val("");
    $("#precio_productos_servicios").val("");
    $("#descripcion_productos_servicios").val("");
    $("#categorias_productos_servicios_idcategorias_productos_servicios").val("");
    $('#categorias_productos_servicios_idcategorias_productos_servicios').selectpicker('refresh');

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

                title: 'Categorías Productos-Servicios'

            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5'
        ],
        "ajax": {
            url: '../ajax/productos_servicios.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 20, //Paginación
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
        url: "../ajax/productos_servicios.php?op=guardaryeditar",
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

function mostrar(idproductos_servicios) {
    $.post("../ajax/productos_servicios.php?op=mostrar", { idproductos_servicios: idproductos_servicios }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idproductos_servicios").val(data.idproductos_servicios);
        $("#nombre_productos_servicios").val(data.nombre_productos_servicios);
        $("#precio_productos_servicios").val(data.precio_productos_servicios);
        $("#descripcion_productos_servicios").val(data.descripcion_productos_servicios);
        $("#categorias_productos_servicios_idcategorias_productos_servicios").val(data.categorias_productos_servicios_idcategorias_productos_servicios);
        $('#categorias_productos_servicios_idcategorias_productos_servicios').selectpicker('refresh');

    })
}

//Función para desactivar registros
function desactivar(idproductos_servicios) {
    bootbox.confirm("¿Está Seguro de desactivar?", function(result) {
        if (result) {
            $.post("../ajax/productos_servicios.php?op=desactivar", { idproductos_servicios: idproductos_servicios }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idproductos_servicios) {
    bootbox.confirm("¿Está Seguro de activar?", function(result) {
        if (result) {
            $.post("../ajax/productos_servicios.php?op=activar", { idproductos_servicios: idproductos_servicios }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}



init();