var tabla;
//Función que se ejecuta al inicio
function init() {
    listar();

    $.post("../ajax/chsucursales.php?op=selectSucursal", function(r) {
        $("#sucursal_idsucursal").html(r);
        $('#sucursal_idsucursal').selectpicker('refresh');

    });

    $.post("../ajax/chsucursales.php?op=selectCategoria", function(r) {
        $("#categoria_idcategoria").html(r);
        $('#categoria_idcategoria').selectpicker('refresh');

    });

    $.post("../ajax/chsucursales.php?op=selectHorario", function(r) {
        $("#horario_idhorario").html(r);
        $('#horario_idhorario').selectpicker('refresh');

    });

}
//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [{
                extend: 'colvis',
                text: 'Visibles'
            }, {
                extend: 'pdfHtml5',
                title: 'REPORTE DE PAGOS ',
                pageSize: 'LEGAL'
            }, 'copyHtml5',
            'excelHtml5',
            'csvHtml5'
        ],
        "ajax": {
            url: '../ajax/cpagosfichas.php?op=listar',
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

//###############################################--ALUMNOS--#######################################################

function cargarDeudoresSucursales1(idsucursal) {

    console.log(idsucursal);

    var sucurs = $('select[name="sucursal_idsucursal"] option:selected').text();


    $('#categoria_idcategoria').val("--Seleccione--");
    $('#categoria_idcategoria').selectpicker('refresh');

    $('#horario_idhorario').val("--Seleccione--");
    $('#horario_idhorario').selectpicker('refresh');

    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [{
                extend: 'colvis',
                text: 'Visibles'
            }, {
                extend: 'pdfHtml5',
                title: 'REPORTE DE MENSUALIDADES DE ALUMNOS \n Sucursal: ' + sucurs,
                pageSize: 'LEGAL'
            }, 'copyHtml5',
            'excelHtml5',
            'csvHtml5'

        ],
        "ajax": {
            url: '../ajax/cpagosfichas.php?op=listarDeudoresSucursal1&id=' + idsucursal,
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

function cargarDeudoresCategorias1(idcategoria) {

    $('#horario_idhorario').val("--Seleccione--");
    $('#horario_idhorario').selectpicker('refresh');

    var idsucursal = $('#sucursal_idsucursal').val();

    var sucurs = $('select[name="sucursal_idsucursal"] option:selected').text();
    var categ = $('select[name="categoria_idcategoria"] option:selected').text();


    if (idsucursal == "") {
        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: [{
                    extend: 'colvis',
                    text: 'Visibles'
                }, {
                    extend: 'pdfHtml5',
                    title: 'REPORTE DE MENSUALIDADES DE ALUMNOS  \n Categoría: ' + categ,
                    pageSize: 'LEGAL'
                }, 'copyHtml5',
                'excelHtml5',
                'csvHtml5'

            ],
            "ajax": {
                url: '../ajax/cpagosfichas.php?op=listarDeudoresCategorias1&id=' + idcategoria,
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

    } else {

        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: [{
                    extend: 'colvis',
                    text: 'Visibles'
                }, {
                    extend: 'pdfHtml5',
                    title: 'REPORTE DE MENSUALIDADES DE ALUMNOS \n Sucursal: ' + sucurs + ' \n Categoría: ' + categ,
                    pageSize: 'LEGAL'
                }, 'copyHtml5',
                'excelHtml5',
                'csvHtml5'

            ],
            "ajax": {
                url: '../ajax/cpagosfichas.php?op=listarDeudoresSucursalCategorias1&idsucursal=' + idsucursal + '&idcategoria=' + idcategoria,
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


function cargarDeudoresHorario1(idhorario) {
    console.log(idhorario);


    var idsucursal = $('#sucursal_idsucursal').val();
    var idcategoria = $('#categoria_idcategoria').val();

    console.log(idsucursal);
    console.log(idcategoria);


    var sucurs = $('select[name="sucursal_idsucursal"] option:selected').text();
    var categ = $('select[name="categoria_idcategoria"] option:selected').text();
    var horar = $('select[name="horario_idhorario"] option:selected').text();

    if (idsucursal == "" && idcategoria == "") {
        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: [{
                    extend: 'colvis',
                    text: 'Visibles'
                }, {
                    extend: 'pdfHtml5',
                    title: 'REPORTE DE MENSUALIDADES DE ALUMNOS \n Horario: ' + horar,
                    pageSize: 'LEGAL'
                }, 'copyHtml5',
                'excelHtml5',
                'csvHtml5'

            ],
            "ajax": {
                url: '../ajax/cpagosfichas.php?op=listarDeudoresHorario1&id=' + idhorario,
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


    if (idsucursal == "" && idcategoria !== "") {
        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: [{
                    extend: 'colvis',
                    text: 'Visibles'
                }, {
                    extend: 'pdfHtml5',
                    title: 'REPORTE DE MENSUALIDADES DE ALUMNOS \n Categoria: ' + categ + ' \n Horario: ' + horar,
                    pageSize: 'LEGAL'
                }, 'copyHtml5',
                'excelHtml5',
                'csvHtml5'

            ],
            "ajax": {
                url: '../ajax/cpagosfichas.php?op=listarDeudoresCategoriaHorario1&idcategoria=' + idcategoria + '&idhorario=' + idhorario,
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

    if (idsucursal !== "" && idcategoria !== "") {
        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: [{
                    extend: 'colvis',
                    text: 'Visibles'
                }, {
                    extend: 'pdfHtml5',
                    title: 'REPORTE DE MENSUALIDADES DE ALUMNOS \n Sucursal: ' + sucurs + ' \n Categoria: ' + categ + ' \n Horario: ' + horar,
                    pageSize: 'LEGAL'
                }, 'copyHtml5',
                'excelHtml5',
                'csvHtml5'

            ],
            "ajax": {
                url: '../ajax/cpagosfichas.php?op=listarDeudoresSucursalesCategoriaHorario1&idsucursal=' + idsucursal + '&idcategoria=' + idcategoria + '&idhorario=' + idhorario,
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

//######################################################################################################


init();