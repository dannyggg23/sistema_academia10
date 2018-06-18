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
    $.post("../ajax/ficha_entrenador.php?op=selectEntrenador", function(r) {
        $("#entrenador_identrenador").html(r);
        $('#entrenador_identrenador').selectpicker('refresh');

    });

    $.post("../ajax/alumno.php?op=selectSucursal", function(r) {
        $("#sucursal_idsucursal").html(r);
        $('#sucursal_idsucursal').selectpicker('refresh');

    });


}

function cargarCategorias(idsucursal) {

    console.log("entra al ajax");

    $("#idsucursal_categorias").val("");
    $('#idsucursal_categorias').selectpicker('refresh');

    $('#idsucursal_categorias').find('option').remove();


    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');

    $('#categoria_idcategoria').find('option').remove();

    $.post("../ajax/entrenador.php?op=selectCategoria&sucursalCategoria=" + idsucursal, function(r) {
        $("#categoria_idcategoria").html(r);
        $('#categoria_idcategoria').selectpicker('refresh');

    });

}

function cargarHorario(idcategoria) {
    var idsucursal = $('#sucursal_idsucursal').val();

    $("#idsucursal_categorias").val("");
    $('#idsucursal_categorias').selectpicker('refresh');

    $('#idsucursal_categorias').find('option').remove();

    $.post("../ajax/entrenador.php?op=selectHorario&sucursalCategoria=" + idsucursal + "&horarioCategoria=" + idcategoria, function(r) {
        $("#idsucursal_categorias").html(r);
        $('#idsucursal_categorias').selectpicker('refresh');

    });

}

//Función limpiar
function limpiar() {
    $("#idficha_entrenador").val("");

    $("#entrenador_identrenador").val("");
    $('#entrenador_identrenador').selectpicker('refresh');

    $("#sucursal_idsucursal").val("");
    $('#sucursal_idsucursal').selectpicker('refresh');

    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');

    $("#idsucursal_categorias").val("");
    $('#idsucursal_categorias').selectpicker('refresh');

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
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/ficha_entrenador.php?op=listar',
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
        url: "../ajax/ficha_entrenador.php?op=guardaryeditar",
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

function mostrar(idficha_entrenador) {
    $.post("../ajax/ficha_entrenador.php?op=mostrar", { idficha_entrenador: idficha_entrenador }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idficha_entrenador").val(data.idficha_entrenador);
        $("#numeroFicha_entrenador").val(data.numeroFicha_entrenador);
        $("#fechaApertura_entrenador").val(data.fechaApertura_entrenador);
        $("#entrenador_identrenador").val(data.entrenador_identrenador);
        $('#entrenador_identrenador').selectpicker('refresh');
        $("#categoria_idcategoria").val(data.categoria_idcategoria);
        $('#categoria_idcategoria').selectpicker('refresh');


    })
}

//Función para desactivar registros
function desactivar(idficha_entrenador, idsucursal_categorias) {
    console.log(idsucursal_categorias);
    bootbox.confirm("¿Está Seguro de desactivar?", function(result) {
        if (result) {
            $.post("../ajax/ficha_entrenador.php?op=desactivar", { idficha_entrenador: idficha_entrenador, idsucursal_categorias: idsucursal_categorias }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idficha_entrenador, idsucursal_categorias) {
    console.log(idsucursal_categorias);

    bootbox.confirm("¿Está Seguro de activar?", function(result) {
        if (result) {
            $.post("../ajax/ficha_entrenador.php?op=activar", { idficha_entrenador: idficha_entrenador, idsucursal_categorias: idsucursal_categorias }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}



init();