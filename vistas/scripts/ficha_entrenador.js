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

    $.post("../ajax/ficha_entrenador.php?op=selectCategoria", function(r) {
        $("#categoria_idcategoria").html(r);
        $('#categoria_idcategoria').selectpicker('refresh');

    });

}

//Función limpiar
function limpiar() {
    $("#idficha_entrenador").val("");
    $("#numeroFicha_entrenador").val("");
    $("#fechaApertura_entrenador").val("");
    $("#entrenador_identrenador").val("");
    $("#categoria_idcategoria").val("");

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
function desactivar(idficha_entrenador) {
    bootbox.confirm("¿Está Seguro de desactivar?", function(result) {
        if (result) {
            $.post("../ajax/ficha_entrenador.php?op=desactivar", { idficha_entrenador: idficha_entrenador }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idficha_entrenador) {
    bootbox.confirm("¿Está Seguro de activar?", function(result) {
        if (result) {
            $.post("../ajax/ficha_entrenador.php?op=activar", { idficha_entrenador: idficha_entrenador }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}



init();