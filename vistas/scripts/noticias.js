var tabla;

//############################################################----MOSTRAR CATEGORIAS POR SUCURSALES---###################################################

function cargarCategorias(idsucursal) {

    console.log("entra al ajax");

    $("#sucursal_categorias_idsucursal_categorias").val("");
    $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');

    $('#sucursal_categorias_idsucursal_categorias').find('option').remove();


    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');

    $('#categoria_idcategoria').find('option').remove();

    $.post("../ajax/alumno.php?op=selectCategoria&sucursalCategoria=" + idsucursal, function(r) {
        $("#categoria_idcategoria").html(r);
        $('#categoria_idcategoria').selectpicker('refresh');

    });

}
//############################################################-  FIN MOSTRAR CATEGORIAS POR SUCURSALES---###################################################


//############################################################----MOSTRAR HORARIOS POR SUCURSALES Y CATEGORIAS ---###################################################

function cargarHorario(idcategoria) {
    var idsucursal = $('#sucursal_idsucursal').val();

    $("#sucursal_categorias_idsucursal_categorias").val("");
    $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');

    $('#sucursal_categorias_idsucursal_categorias').find('option').remove();

    $.post("../ajax/alumno.php?op=selectHorario&sucursalCategoria=" + idsucursal + "&horarioCategoria=" + idcategoria, function(r) {
        $("#sucursal_categorias_idsucursal_categorias").html(r);
        $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');

    });

}

//############################################################---- FIN MOSTRAR HORARIOS POR SUCURSALES Y CATEGORIAS ---###################################################


//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })


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

        $("#sucursal_categorias_idsucursal_categorias").val(data.sucursal_categorias_idsucursal_categorias);
        $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');


        $("#sucursal_idsucursal").val(data.idsucursal);
        $('#sucursal_idsucursal').selectpicker('refresh');

        $("#categoria_idcategoria").val(data.idcategoria);
        $('#categoria_idcategoria').selectpicker('refresh');

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