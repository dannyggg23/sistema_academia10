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
    $.post("../ajax/ficha_alumno.php?op=selectAlumno", function(r) {
        $("#alumno_idalumno").html(r);
        $('#alumno_idalumno').selectpicker('refresh');
    });

    $.post("../ajax/ficha_alumno.php?op=selectSucursal", function(r) {
        $("#sucursal_idsucursal").html(r);
        $('#sucursal_idsucursal').selectpicker('refresh');
    });

    $.post("../ajax/ficha_alumno.php?op=selectCategorias", function(r) {
        $("#categoria_idcategoria").html(r);
        $('#categoria_idcategoria').selectpicker('refresh');

    });

    $.post("../ajax/ficha_alumno.php?op=selectHorarios", function(r) {
        $("#sucursal_categorias_idsucursal_categorias").html(r);
        $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');
    });

}


$("#alumno_idalumno").change(function() {
    var numeroficha = $('select[name="alumno_idalumno"] option:selected').text();
    console.log(numeroficha);
    if (numeroficha == "--Seleccione--") {
        $('#numeroFicha_alumno').val("");
    } else {
        $('#numeroFicha_alumno').val(numeroficha);
    }

});

$("#sucursal_idsucursal").change(function() {
    var idsucursal = $('#sucursal_idsucursal').val();

    console.log("entra al ajax");

    $("#sucursal_categorias_idsucursal_categorias").val("");
    $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');

    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');

    $('#categoria_idcategoria').find('option').remove();





    $.post("../ajax/ficha_alumno.php?op=selectCategoria&sucursalCategoria=" + idsucursal, function(r) {
        $("#categoria_idcategoria").html(r);
        $('#categoria_idcategoria').selectpicker('refresh');

    });
});

$("#categoria_idcategoria").change(function() {
    var idsucursal = $('#sucursal_idsucursal').val();
    var idcategoria = $('#categoria_idcategoria').val();

    $("#sucursal_categorias_idsucursal_categorias").val("");
    $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');



    $.post("../ajax/ficha_alumno.php?op=selectHorario&sucursalCategoria=" + idsucursal + "&horarioCategoria=" + idcategoria, function(r) {
        $("#sucursal_categorias_idsucursal_categorias").html(r);
        $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');

    });
});

//Función limpiar
function limpiar() {
    $("#idficha_alumno").val("");
    $("#numeroFicha_alumno").val("");
    $("#fechaApertura_alumno").val("");
    $("#descuento_ficha_alumno").val("");

    $("#alumno_idalumno").val("");
    $('#alumno_idalumno').selectpicker('refresh');


    $("#sucursal_idsucursal").val("");
    $('#sucursal_idsucursal').selectpicker('refresh');

    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');

    $("#sucursal_categorias_idsucursal_categorias").val("");
    $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');


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
            'csvHtml5'
        ],
        "ajax": {
            url: '../ajax/ficha_alumno.php?op=listar',
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
        url: "../ajax/ficha_alumno.php?op=guardaryeditar",
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

function mostrar(idficha_alumno) {
    $.post("../ajax/ficha_alumno.php?op=mostrar", { idficha_alumno: idficha_alumno }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#idficha_alumno").val(data.idficha_alumno);
        $("#numeroFicha_alumno").val(data.numeroFicha_alumno);
        $("#fechaApertura_alumno").val(data.fechaApertura_alumno);
        $("#descuento_ficha_alumno").val(data.descuento_ficha_alumno);

        $("#alumno_idalumno").val(data.alumno_idalumno);
        $('#alumno_idalumno').selectpicker('refresh');

        $("#sucursal_idsucursal").val(data.sucursal_idsucursal);
        $('#sucursal_idsucursal').selectpicker('refresh');

        $("#categoria_idcategoria").val(data.categoria_idcategoria);
        $('#categoria_idcategoria').selectpicker('refresh');


        $("#sucursal_categorias_idsucursal_categorias").val(data.sucursal_categorias_idsucursal_categorias);
        $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');

    })
}

//Función para desactivar registros
function desactivar(idficha_alumno) {
    bootbox.confirm("¿Está Seguro de desactivar?", function(result) {
        if (result) {
            $.post("../ajax/ficha_alumno.php?op=desactivar", { idficha_alumno: idficha_alumno }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idficha_alumno) {
    bootbox.confirm("¿Está Seguro de activar?", function(result) {
        if (result) {
            $.post("../ajax/ficha_alumno.php?op=activar", { idficha_alumno: idficha_alumno }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}



init();