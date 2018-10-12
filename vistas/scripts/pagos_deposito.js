var tabla;

//Función que se ejecuta al inicio
function init() {
    console.log("entra al js");
    listar();
    mostrarform(false);


}

function limpiar() {
    $("#fecha").val("");
    $("#cedula_representante").val("");
    $("#cedula_alumno").val("");
    $("#descripcion").val("");
    $("#fecha_acceso").val("");
    $("#imagenmuestra").val("");



}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

function mostrar(idpagos_deposito) {
    $.post("../ajax/pagos_deposito.php?op=mostrar", { idpagos_deposito: idpagos_deposito }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#fecha").val(data.fecha);
        $("#cedula_representante").val(data.cedula_representante + " " + data.nombre_representante);
        $("#cedula_alumno").val(data.cedula_alumno + " " + data.nombre_alumno);
        $("#descripcion").val(data.descripcion);
        $("#fecha_acceso").val(data.fecha_acceso);

        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/imgpagos/" + data.imagen);


    })
}

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


function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [{
                extend: 'pdfHtml5',

                title: 'Depósitos'

            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5'
        ],
        "ajax": {
            url: '../ajax/pagos_deposito.php?op=listar',
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


//Función para desactivar registros
function desactivar(idpagos_deposito) {
    bootbox.confirm("¿Está Seguro de desactivar?", function(result) {
        if (result) {
            $.post("../ajax/pagos_deposito.php?op=desactivar", { idpagos_deposito: idpagos_deposito }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

//Función para activar registros
function activar(idpagos_deposito) {
    bootbox.confirm("¿Está Seguro de activar?", function(result) {
        if (result) {
            $.post("../ajax/pagos_deposito.php?op=activar", { idpagos_deposito: idpagos_deposito }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

$(function() {
    $('img').on('click', function() {
        $('.enlargeImageModalSource').attr('src', $(this).attr('src'));
        $('#enlargeImageModal').modal('show');
    });
});





init();