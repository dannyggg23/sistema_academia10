var tabla;

//Función que se ejecuta al inicio
function init() {
    console.log("entra al js");
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });


}

//Función limpiar
function limpiar() {
    $("#iddatos_academia").val("");
    $("#titulo_factura").val("");
    $("#nombre_propietario").val("");
    $("#documento_identidad").val("");
    $("#direccion_academia").val("");
    $("#telefono_academia").val("");
    $("#email_academia").val("");
    $("#serie_factura").val("");
    $("#numero_factura").val("");


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

                title: 'Categorías'

            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5'
        ],
        "ajax": {
            url: '../ajax/academia.php?op=listar',
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


function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/academia.php?op=guardaryeditar",
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

function mostrar(iddatos_academia) {
    $.post("../ajax/academia.php?op=mostrar", { iddatos_academia: iddatos_academia }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#iddatos_academia").val(data.iddatos_academia);
        $("#titulo_factura").val(data.titulo_factura);
        $("#nombre_propietario").val(data.nombre_propietario);
        $("#documento_identidad").val(data.documento_identidad);
        $("#direccion_academia").val(data.direccion_academia);
        $("#telefono_academia").val(data.telefono_academia);
        $("#email_academia").val(data.email_academia);
        $("#serie_factura").val(data.serie_factura);
        $("#numero_factura").val(data.numero_factura);

    });
}



init();