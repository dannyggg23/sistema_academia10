var tabla;

//Función que se ejecuta al inicio
function init() {
    console.log("entra al js");
    mostrarform(false);
    listar();

    $("#tipo_documento").val("Factura");
    $("#tipo_documento").selectpicker();




    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    $.post("../ajax/pago.php?op=selectRepresentante", function(r) {
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
        listarArticulos();



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
            url: '../ajax/pago.php?op=listar',
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


function listarArticulos() {
    tabla = $('#tblarticulos').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [

        ],
        "ajax": {
            url: '../ajax/pago.php?op=listarFichas',
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
    //$("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/pago.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            listar();
        }

    });
    limpiar();
}

function mostrar(idpago) {
    $.post("../ajax/pago.php?op=mostrar", { idpago: idpago }, function(data, status) {
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

    $.post("../ajax/pago.php?op=listarDetalle&id=" + idpago, function(r) {
        $("#detalles").html(r);
    });


}

//Función para desactivar registros
function anular(idpago) {
    bootbox.confirm("¿Está Seguro de anular?", function(result) {
        if (result) {
            $.post("../ajax/pago.php?op=anular", { idpago: idpago }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

////DECLACRACION DE VARIABLES NECESARIAS PARA TRABAJAR CON LAS FACTURAS
var impuesto = 12;
var cont = 0;
var detalles = 0;
//$("#guardar").hide();

$("#btnGuardar").hide();
$("#tipo_documento").change(marcarImpuesto);

function marcarImpuesto() {
    var tipo_documento = $("#tipo_documento option:selected").text();
    if (tipo_documento == 'Factura') {
        $("#impuesto").val(impuesto);

    } else {
        $("#impuesto").val("0");

    }

}

function agregarDetalle(idficha_alumno, numeroFicha_alumno, descuento_ficha_alumno) {

    var n_meses = 1;
    var precio = 25;
    var descuento = 0;

    if (idficha_alumno != "") {
        var subtotal = (n_meses * precio) - descuento;

        var fila = '<tr class="filas" id="fila' + cont + '">' +
            '<td> <button type="button" class="btn btn-danger" onclick="eliminarDetalle(' + cont + ')">X</button> </td>' +
            '<td> <input type="hidden" name="ficha_alumno_idficha_alumno[]" id="ficha_alumno_idficha_alumno[]" value="' + idficha_alumno + '" >' + numeroFicha_alumno + '</td>' +
            '<td> <input type="number" name="numero_meses_pago[]" id="numero_meses_pago[]" onchange="modificarSubtotales()"  value="' + n_meses + '" > </td>' +
            '<td> <input type="number" name="precio_pago[]" id="precio_pago[]" onchange="modificarSubtotales()" value="' + precio + '"> </td>' +
            '<td> <input type="number" name="descuento_pago[]" id="descuento_pago[]" onchange="modificarSubtotales()" value="' + descuento_ficha_alumno + '" > </td>' +
            '<td> <span name="subtotal" id="subtotal' + cont + '">' + subtotal + '</span> </td>' +
            '<td> <button type="button" onclick="modificarSubtotales()" class="btn btn-info"> <i class="fa fa-refresh"></i> </button> </td>' +
            '</tr>';
        cont++;
        detalles++;

        $('#detalles').append(fila);
        modificarSubtotales();

    } else {
        alert("Error al ingresar el detalle , revisar los datos");
    }
}

function modificarSubtotales() {

    console.log("modificar subtotales");
    var cant = document.getElementsByName("numero_meses_pago[]");
    var prec = document.getElementsByName("precio_pago[]");
    var desc = document.getElementsByName("descuento_pago[]");
    var sub = document.getElementsByName("subtotal");

    for (var i = 0; i < cant.length; i++) {
        var inpC = cant[i];
        var inpP = prec[i];
        var inpD = desc[i];
        var inpS = sub[i];

        inpS.value = inpP.value - (((inpC.value * inpP.value) * inpD.value) / 100);

        document.getElementsByName("subtotal")[i].innerHTML = inpS.value;

        console.log(inpS.value);
    }

    calcularTotales();
}

function calcularTotales() {

    var subt = document.getElementsByName("subtotal");

    var total = 0.0;

    for (var i = 0; i < subt.length; i++) {
        total += document.getElementsByName("subtotal")[i].value;
    }

    $("#total_compra").html("$/. " + total);

    $("#total").val(total);

    evaluar();
}

function evaluar() {
    if (detalles > 0) {
        $("#btnGuardar").show();
    } else {
        $("#btnGuardar").hide();
        cont = 0;

    }
}

function eliminarDetalle(indice) {
    $("#fila" + indice).remove();
    calcularTotales();
    detalles = detalles - 1;
}


init();