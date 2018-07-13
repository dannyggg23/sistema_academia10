var tabla;
var tabla1;

//Función que se ejecuta al inicio
function init() {

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

    listar();
    listarDeudores();

}


//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: ['copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'

        ],
        "ajax": {
            url: '../ajax/cfichas.php?op=listar',
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

function listarDeudores() {
    tabla1 = $('#tbllistadodeudores').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: ['copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'

        ],
        "ajax": {
            url: '../ajax/cfichas.php?op=listarDeudores',
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

function cargarDeudoresSucursales(idsucursal) {
    console.log(idsucursal);
    $('#categoria_idcategoria').val("--Seleccione--");
    $('#categoria_idcategoria').selectpicker('refresh');

    $('#horario_idhorario').val("--Seleccione--");
    $('#horario_idhorario').selectpicker('refresh');

    tabla1 = $('#tbllistadodeudores').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: ['copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'

        ],
        "ajax": {
            url: '../ajax/cfichas.php?op=listarDeudoresSucursal&id=' + idsucursal,
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

function cargarDeudoresCategorias(idcategoria) {

    $('#horario_idhorario').val("--Seleccione--");
    $('#horario_idhorario').selectpicker('refresh');

    var idsucursal = $('#sucursal_idsucursal').val();

    if (idsucursal == "--Seleccione--") {
        tabla1 = $('#tbllistadodeudores').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/cfichas.php?op=listarDeudoresCategorias&id=' + idcategoria,
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

        tabla1 = $('#tbllistadodeudores').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/cfichas.php?op=listarDeudoresSucursalCategorias&idsucursal=' + idsucursal + '&idcategoria=' + idcategoria,
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

function cargarDeudoresHorario(idhorario) {
    console.log(idhorario);
    var idsucursal = $('#sucursal_idsucursal').val();
    var idcategoria = $('#categoria_idcategoria').val();

    if (idsucursal == "--Seleccione--" && idcategoria == "--Seleccione--") {
        tabla1 = $('#tbllistadodeudores').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/cfichas.php?op=listarDeudoresHorario&id=' + idhorario,
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


    if (idsucursal == "--Seleccione--" && idcategoria !== "--Seleccione--") {
        tabla1 = $('#tbllistadodeudores').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/cfichas.php?op=listarDeudoresCategoriaHorario&idcategoria=' + idcategoria + '&idhorario=' + idhorario,
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

    if (idsucursal !== "--Seleccione--" && idcategoria !== "--Seleccione--") {
        tabla1 = $('#tbllistadodeudores').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/cfichas.php?op=listarDeudoresSucursalesCategoriaHorario&idsucursal=' + idsucursal + '&idcategoria=' + idcategoria + '&idhorario=' + idhorario,
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

//###############################################--ALUMNOS--#######################################################
function cargarDeudoresSucursales1(idsucursal) {
    console.log(idsucursal);
    $('#categoria_idcategoria').val("--Seleccione--");
    $('#categoria_idcategoria').selectpicker('refresh');

    $('#horario_idhorario').val("--Seleccione--");
    $('#horario_idhorario').selectpicker('refresh');

    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: ['copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'

        ],
        "ajax": {
            url: '../ajax/cfichas.php?op=listarDeudoresSucursal&id=' + idsucursal,
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

    if (idsucursal == "--Seleccione--") {
        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/cfichas.php?op=listarDeudoresCategorias&id=' + idcategoria,
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
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/cfichas.php?op=listarDeudoresSucursalCategorias&idsucursal=' + idsucursal + '&idcategoria=' + idcategoria,
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

    if (idsucursal == "--Seleccione--" && idcategoria == "--Seleccione--") {
        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/cfichas.php?op=listarDeudoresHorario&id=' + idhorario,
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


    if (idsucursal == "--Seleccione--" && idcategoria !== "--Seleccione--") {
        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/cfichas.php?op=listarDeudoresCategoriaHorario&idcategoria=' + idcategoria + '&idhorario=' + idhorario,
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

    if (idsucursal !== "--Seleccione--" && idcategoria !== "--Seleccione--") {
        tabla = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/cfichas.php?op=listarDeudoresSucursalesCategoriaHorario&idsucursal=' + idsucursal + '&idcategoria=' + idcategoria + '&idhorario=' + idhorario,
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