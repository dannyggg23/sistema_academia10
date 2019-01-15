var tabla;


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



    $.post("../ajax/asistencia.php?op=selectFichaAlumno", function(r) {
        $("#idalumno").html(r);
        $('#idalumno').selectpicker('refresh');

    });

    listar();

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
            url: '../ajax/asistencia.php?op=listar',
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


function cargarAsistenciaSucursales(idsucursal) {
    console.log(idsucursal);
    $('#categoria_idcategoria').val("--Seleccione--");
    $('#categoria_idcategoria').selectpicker('refresh');

    $('#horario_idhorario').val("--Seleccione--");
    $('#horario_idhorario').selectpicker('refresh');

    tabla1 = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: ['copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'

        ],
        "ajax": {
            url: '../ajax/asistencia.php?op=listarAsistenciaSucursal&id=' + idsucursal,
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

function cargarAsistenciaCategorias(idcategoria) {

    $('#horario_idhorario').val("--Seleccione--");
    $('#horario_idhorario').selectpicker('refresh');

    var idsucursal = $('#sucursal_idsucursal').val();

    if (idsucursal == "--Seleccione--") {
        tabla1 = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/asistencia.php?op=listarAsistenciaCategorias&id=' + idcategoria,
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

        tabla1 = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/asistencia.php?op=listarAsistenciaSucursalCategorias&idsucursal=' + idsucursal + '&idcategoria=' + idcategoria,
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

function cargarAsistenciaHorario(idhorario) {
    console.log(idhorario);
    var idsucursal = $('#sucursal_idsucursal').val();
    var idcategoria = $('#categoria_idcategoria').val();

    if (idsucursal == "--Seleccione--" && idcategoria == "--Seleccione--") {
        tabla1 = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/asistencia.php?op=listarAsistenciaHorario&id=' + idhorario,
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
        tabla1 = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/asistencia.php?op=listarAsistenciaCategoriaHorario&idcategoria=' + idcategoria + '&idhorario=' + idhorario,
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
        tabla1 = $('#tbllistado').dataTable({
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            dom: 'Bfrtip', //Definimos los elementos del control de tabla
            buttons: ['copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdf'

            ],
            "ajax": {
                url: '../ajax/asistencia.php?op=listarAsistenciaSucursalesCategoriaHorario&idsucursal=' + idsucursal + '&idcategoria=' + idcategoria + '&idhorario=' + idhorario,
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

function listarfecha() {

    var fechaDesde = $('#fechaDesde').val();
    var fechaHasta = $('#fechaHasta').val();

    if (fechaDesde == "") {
        swal("ERROR", "Seleccione una fecha de inicio", "error").then((value) => {
            $('#fechaDesde').val("");
        });
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
                url: '../ajax/asistencia.php?op=listarFecha&finicio=' + fechaDesde + '&ffin=' + fechaHasta,
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

function listarfechaRepresentante() {

    var fechaDesde = $('#fechaDesde').val();
    var fechaHasta = $('#fechaHasta').val();
    var representante = $('#idalumno').val();

    if (fechaDesde == "") {
        swal("ERROR", "Seleccione una fecha de inicio", "error").then((value) => {
            $('#fechaDesde').val("");
        });
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
                url: '../ajax/asistencia.php?op=listarfechaRepresentante&finicio=' + fechaDesde + '&ffin=' + fechaHasta + '&idrepresentante=' + representante,
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

init();