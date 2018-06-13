var tabla;

//Función que se ejecuta al inicio
function init() {

    mostrarform(false);
    listar();


    $.post("../ajax/cpagos.php?op=selectRepresentante", function(r) {
        $("#representante_idrepresentante").html(r);
        $('#representante_idrepresentante').selectpicker('refresh');

    });
}

//Función limpiar
function limpiar() {
    $("#idpago").val("");
    $("#representante_idrepresentante").val("");

    //Obtenemos la fecha actual
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    $('#fecha').val(today);

    $("#total").val("");

    $("#tipo_documento").val("");
    $("#serie_comprobante").val("");
    $("#num_comprobante").val("");
    $("#total_compra").val("");
    $("#total").val("");
    $(".filas").remove();
    $("#impuesto").val("");

}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();

    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        //$("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();




        $("#btnGuardar").hide();
        $("#btnCancelar").show();
        detalles = 0;
        $("#btnAgregarArt").show();



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
    modificarSubtotales();

}

//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [


        ],
        "ajax": {
            url: '../ajax/cpagos.php?op=listar',
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


function mostrar(idpago) {
    $.post("../ajax/cpagos.php?op=mostrar", { idpago: idpago }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#fecha").val(data.fecha);
        $("#serie_comprobante").val(data.serie_comprobante);
        $("#num_comprobante").val(data.num_comprobante);
        $("#impuesto").val(data.impuesto);
        $("#tipo_documento").val(data.tipo_documento);
        $('#tipo_documento').selectpicker('refresh');
        $("#representante_idrepresentante").val(data.representante_idrepresentante);
        $('#representante_idrepresentante').selectpicker('refresh');
        $("#idpago").val(data.idpago);

        //OCULTAR Y MOSTRAR ALGUNOS BOTONES
        $("#btnGuardar").hide();
        $("#btnCancelar").show();
        $("#btnAgregarArt").hide();

    });

    $.post("../ajax/cpagos.php?op=listarDetalle&id=" + idpago, function(r) {
        $("#detalles").html(r);
    });


}



init();