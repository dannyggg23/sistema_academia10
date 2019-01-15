var tabla;

//Función que se ejecuta al inicio
function init() {
    console.log("entra al js");
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
}

//Función limpiar
function limpiar() {
    $("#idcategorias_productos_servicios").val("");
    $("#nombre_categoria_productos").val("");
    $("#descripcion_categoria_productos").val("");
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
            url: '../ajax/categoria_ps.php?op=listar',
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
        url: "../ajax/categoria_ps.php?op=guardaryeditar",
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

function mostrar(idcategorias_productos_servicios) {
    $.post("../ajax/categoria_ps.php?op=mostrar", { idcategorias_productos_servicios: idcategorias_productos_servicios }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idcategorias_productos_servicios").val(data.idcategorias_productos_servicios);
        $("#nombre_categoria_productos").val(data.nombre_categoria_productos);
        $("#descripcion_categoria_productos").val(data.descripcion_categoria_productos);

    })
}

//Función para desactivar registros
function desactivar(idcategorias_productos_servicios) {
    bootbox.confirm("¿Está Seguro de desactivar?", function(result) {
        if (result) {
            $.post("../ajax/categoria_ps.php?op=desactivar", { idcategorias_productos_servicios: idcategorias_productos_servicios }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idcategorias_productos_servicios) {
    bootbox.confirm("¿Está Seguro de activar?", function(result) {
        if (result) {
            $.post("../ajax/categoria_ps.php?op=activar", { idcategorias_productos_servicios: idcategorias_productos_servicios }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}



init();