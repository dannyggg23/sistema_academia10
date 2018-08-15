//Función que se ejecuta al inicio
function init() {

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
    $.post("../ajax/ficha_alumno.php?op=selectSucursal", function(r) {
        $("#sucursal_idsucursal").html(r);
        $('#sucursal_idsucursal').selectpicker('refresh');
    });



}

//Función limpiar
function limpiar() {

    $("#mensaje").val("");
    $("#titulo").val("");
    $("#subtitulo").val("");
    $("#sucursal_idsucursal").val("");
    $('#sucursal_idsucursal').selectpicker('refresh');

}


//Función enviardatos

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento

    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../RESTFul/index.php/notificaciones",
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