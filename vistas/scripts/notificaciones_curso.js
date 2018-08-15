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

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
    $.post("../ajax/ficha_alumno.php?op=selectSucursal", function(r) {
        $("#sucursal_idsucursal").html(r);
        $('#sucursal_idsucursal').selectpicker('refresh');
    });

    // $.post("../ajax/ficha_alumno.php?op=selectCategorias", function(r) {
    //     $("#categoria_idcategoria").html(r);
    //     $('#categoria_idcategoria').selectpicker('refresh');
    // });

    // $.post("../ajax/ficha_alumno.php?op=selectHorarios", function(r) {
    //     $("#sucursal_categorias_idsucursal_categorias").html(r);
    //     $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');
    // });

}

//Función limpiar
function limpiar() {

    $("#mensaje").val("");
    $("#titulo").val("");
    $("#subtitulo").val("");
    $("#sucursal_categorias_idsucursal_categorias").val("");
    $('#sucursal_categorias_idsucursal_categorias').selectpicker('refresh');

    $("#sucursal_idsucursal").val("");
    $('#sucursal_idsucursal').selectpicker('refresh');

    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');

}


//Función enviardatos

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento

    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../RESTFul/index.php/notificaciones/curso",
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



init();