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

    $.post("../ajax/factura.php?op=selectRepresentante", function(r) {
        $("#representante_idrepresentante").html(r);
        $('#representante_idrepresentante').selectpicker('refresh');

    });



    $("#impuesto").val("12");

}

//Función limpiar
function limpiar() {
    $("#idpago").val("");
    $("#representante_idrepresentante").val("");
    $('#representante_idrepresentante').selectpicker('refresh');

    //Obtenemos la fecha actual
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    $('#fecha').val(today);

    $("#total").val("");


    $("#tipo_documento").val("Factura");
    $("#tipo_documento").selectpicker();

    // $("#serie_comprobante").val("");
    // $("#num_comprobante").val("");
    $("#total_compra").val("");
    $("#total").val("");
    $(".filas").remove();
    $("#impuesto").val("12");

    $("#subtotal_compra").val("");

    $("#subtotal1").val("");

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

        $.post("../ajax/academia.php?op=mostrarSerieNumero", function(data, status) {
            data = JSON.parse(data);
            console.log(data);
            $("#serie_comprobante").val(data.serie_factura);
            $("#num_comprobante").val(data.numero_factura);

        });



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
                title: 'Facturas',
                pageSize: 'LEGAL'
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5'
        ],
        "ajax": {
            url: '../ajax/factura.php?op=listar',
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

    var idrepresentante = $('#representante_idrepresentante').val();
    console.log(idrepresentante);

    if (idrepresentante == null || idrepresentante == "" || idrepresentante == "--Seleccione--") {

        swal("INCORRECTO", "Seleccione un representante", "error").then((value) => {
            $('#myModal').modal('hide');
        });

    } else {
        tabla = $('#tblarticulos').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: [

            ],
            "ajax": {
                url: '../ajax/factura.php?op=listarFichas',
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

}

//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    //$("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/factura.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            if (datos > 0) {
                swal("CORRECTO", "Factura registrada", "success").then((value) => {
                    var url = "https://www.escueladel10.com/sistema/reportes/exFactura.php?id=" + datos;
                    window.open(url, '_blank');
                });

                mostrarform(false);
                listar();
            } else {
                swal("INCORRECTO", "Verifique los datos antes de registrar", "error");

            }

        }

    });
    limpiar();
}

function mostrar(idpago) {
    $.post("../ajax/factura.php?op=mostrar", { idpago: idpago }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#fecha").val(data.fecha);
        $("#serie_comprobante").val(data.serie_comprobante);
        $("#num_comprobante").val(data.num_comprobante);
        $("#impuesto").val(data.impuesto);
        $("#tipo_documento").val(data.tipo_documento);
        $('#tipo_documento').selectpicker('refresh');
        $("#representante_idrepresentante").val(data.idrepresentante);
        $('#representante_idrepresentante').selectpicker('refresh');
        $("#idpago").val(data.idpago);

        //OCULTAR Y MOSTRAR ALGUNOS BOTONES
        $("#btnGuardar").hide();
        $("#btnCancelar").show();
        $("#btnAgregarArt").hide();

    });

    $.post("../ajax/factura.php?op=listarDetalle&id=" + idpago, function(r) {
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

function agregarDetalle(idproductos_servicios, nombre_productos_servicios, precio_productos_servicios) {

    var n_meses = 1;
    var descuento = 0;

    if (idproductos_servicios != "") {

        var subtotal = (n_meses * precio_productos_servicios) - descuento;

        var fila = '<tr class="filas" id="fila' + cont + '">' +
            '<td> <button type="button" class="btn btn-danger" onclick="eliminarDetalle(' + cont + ')">X</button> </td>' +
            '<td> <input type="hidden" name="productos_servicios_idproductos_servicios[]" id="productos_servicios_idproductos_servicios[]" value="' + idproductos_servicios + '" >' + nombre_productos_servicios + '</td>' +
            '<td> <input type="number" name="numero_meses_pago[]" id="numero_meses_pago[]" onchange="modificarSubtotales()"  value="' + n_meses + '" > </td>' +
            '<td> <input type="number" name="precio_pago[]" id="precio_pago[]" onchange="modificarSubtotales()" value="' + precio_productos_servicios + '"> </td>' +
            '<td> <input type="number" name="descuento_pago[]" id="descuento_pago[]" onchange="modificarSubtotales()" class="descuento"  value="0" >%</td>' +
            '<td> <select id="ficha_alumno_idficha_alumno[]" name="ficha_alumno_idficha_alumno[]" class="principal"   data-live-search="true" required><option>seleccione</option></select></td>' +
            '<td> <span name="subtotal" id="subtotal' + cont + '">' + subtotal + '</span> </td>' +
            '<td> <button type="button" onclick="modificarSubtotales()" class="btn btn-info"> <i class="fa fa-refresh"></i> </button> </td>' +
            '</tr>';

        $('#detalles').append(fila);

        swal("CORRECTO", "Ingresado correctamente", "success").then((value) => {
            var representante = $("#representante_idrepresentante").val();
            $.post("../ajax/factura.php?op=selectFicha&id=" + representante, function(r) {

                $("select.principal").html(r);
                $("select.principal").selectpicker('refresh');
            });
        });

        cont++;
        detalles++;
        modificarSubtotales();

    } else {
        alert("Error al ingresar el detalle , revisar los datos");
    }
}



function modificarSubtotales() {


    var cant = document.getElementsByName("numero_meses_pago[]");
    var prec = document.getElementsByName("precio_pago[]");
    var desc = document.getElementsByName("descuento_pago[]");
    // var ficha = document.getElementsByName("ficha_alumno_idficha_alumno[]");
    var sub = document.getElementsByName("subtotal");


    for (var i = 0; i < cant.length; i++) {

        var inpC = cant[i];
        var inpP = prec[i];
        var inpD = desc[i];
        var inpS = sub[i];
        //var fichab = ficha[i];

        //$.post("../ajax/factura.php?op=selectFichaDescuento&id=" + fichab.value, function(r) {
        //  inpD.value = r;
        //});


        inpS.value = (inpC.value * inpP.value) - (((inpC.value * inpP.value) * inpD.value) / 100);



        document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
        //document.getElementsByName("descuento_pago[]")[i].value = inpD.value;


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

    var ivacompra = ($("#impuesto").val() * total) / 100;


    $("#subtotal_compra").html("$/. " + total);

    $("#iva_compra").html("$/. " + ivacompra);

    var totalcomprah = parseFloat(total) + parseFloat(ivacompra);

    $("#total_compra").html("$/. " + totalcomprah);

    $("#total").val(totalcomprah);
    $("#subtotal1").val(total);


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