var tabla;

//################################################### MODAL CATEGORIA #########################################################
$("#modalcategoria").click(function() {
    $.ajax({
        url: "../vistas/modal_categoria.php",
        cache: false,
        /* Evitamos cache */
        dataType: 'html',
        /* Se recibirá contenido HTML */
        success: function(data) {
            BootstrapDialog.show({
                title: 'Datos de la Categoría',
                message: data,
                closeByBackdrop: false,
                closeByKeyboard: true,
                closable: true,
                size: BootstrapDialog.SIZE_LARGE,
                type: BootstrapDialog.TYPE_INFO,
                buttons: [{
                        label: 'Guardar',
                        cssClass: 'btn-primary',
                        action: function(dialogRef) {
                            var idcategoria;
                            var nombre_categoria = $("#nombre_categoria").val();
                            var descripcion_categoria = $("#descripcion_categoria").val();


                            if (nombre_categoria == "" || descripcion_categoria == "") { swal("ERROR", "Complete los campos correctamente", "error") } else {


                                $.post("../ajax/categoria.php?op=guardar", {
                                    nombre_categoria: nombre_categoria,
                                    descripcion_categoria: descripcion_categoria

                                }, function(data, status) {
                                    if (data > 0) {
                                        dialogRef.close();

                                        swal("CORRECTO", "Categoria registrada", "success");

                                        $.post("../ajax/chsucursales.php?op=selectCategoria", function(r) {
                                            $("#categoria_idcategoria").html(r);
                                            $("#categoria_idcategoria").val(data);
                                            $('#categoria_idcategoria').selectpicker('refresh');

                                        });

                                    } else {
                                        swal("INCORRECTO", "Verifique los datos antes de registrar", "error");
                                    }
                                });

                            }
                        }
                    },
                    {
                        label: 'Cerrar',
                        cssClass: 'btn-warning',
                        /* Nombre del botón (en este caso "Cerrar" */
                        action: function(dialogRef) {
                            dialogRef.close(); /* Cerrar la modal sin hacer nada más */
                        }
                    }
                ]
            });

        }
    })
});

//############################################################# FIN MODAL CATEGORIA ######################################################


//################################################### MODAL HORARIO #########################################################
$("#modalhorario").click(function() {
    $.ajax({
        url: "../vistas/modal_horario.php",
        cache: false,
        /* Evitamos cache */
        dataType: 'html',
        /* Se recibirá contenido HTML */
        success: function(data) {
            BootstrapDialog.show({
                title: 'Datos del Horario',
                message: data,
                closeByBackdrop: false,
                closeByKeyboard: true,
                closable: true,
                size: BootstrapDialog.SIZE_LARGE,
                type: BootstrapDialog.TYPE_INFO,
                buttons: [{
                        label: 'Guardar',
                        cssClass: 'btn-primary',
                        action: function(dialogRef) {

                            var nombre = $("#nombre").val();
                            var hora_inicio = $("#hora_inicio").val();
                            var hora_fin = $("#hora_fin").val();


                            if (nombre == "" || hora_inicio == "" || hora_fin == "") { swal("ERROR", "Complete los campos correctamente", "error") } else {


                                $.post("../ajax/horario.php?op=guardar", {
                                    nombre: nombre,
                                    hora_inicio: hora_inicio,
                                    hora_fin: hora_fin

                                }, function(data, status) {
                                    if (data > 0) {
                                        dialogRef.close();

                                        swal("CORRECTO", "Horario registrado", "success");

                                        $.post("../ajax/chsucursales.php?op=selectHorario", function(r) {
                                            $("#horario_idhorario").html(r);
                                            $("#horario_idhorario").val(data);
                                            $('#horario_idhorario').selectpicker('refresh');

                                        });

                                    } else {
                                        swal("INCORRECTO", "Verifique los datos antes de registrar", "error");
                                    }
                                });

                            }
                        }
                    },
                    {
                        label: 'Cerrar',
                        cssClass: 'btn-warning',
                        /* Nombre del botón (en este caso "Cerrar" */
                        action: function(dialogRef) {
                            dialogRef.close(); /* Cerrar la modal sin hacer nada más */
                        }
                    }
                ]
            });

        }
    })
});

//############################################################# FIN MODAL HORARIO ######################################################


//Función que se ejecuta al inicio
function init() {
    console.log("entra al js");
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    $.post("../ajax/chsucursales.php?op=selectHorario", function(r) {
        $("#horario_idhorario").html(r);
        $('#horario_idhorario').selectpicker('refresh');

    });

    $.post("../ajax/chsucursales.php?op=selectSucursal", function(r) {
        $("#sucursal_idsucursal").html(r);
        $('#sucursal_idsucursal').selectpicker('refresh');

    });

    $.post("../ajax/chsucursales.php?op=selectCategoria", function(r) {
        $("#categoria_idcategoria").html(r);
        $('#categoria_idcategoria').selectpicker('refresh');

    });


}

//Función limpiar
function limpiar() {

    $("#idsucursal_categorias").val("");

    $("#sucursal_idsucursal").val("");
    $('#sucursal_idsucursal').selectpicker('refresh');
    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');
    $("#horario_idhorario").val("");
    $('#horario_idhorario').selectpicker('refresh');


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
            url: '../ajax/chsucursales.php?op=listar',
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
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/chsucursales.php?op=guardaryeditar",
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

function mostrar(idsucursal_categorias) {
    $.post("../ajax/chsucursales.php?op=mostrar", { idsucursal_categorias: idsucursal_categorias }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);



        $("#idsucursal_categorias").val(data.idsucursal_categorias);

        $("#sucursal_idsucursal").val(data.sucursal_idsucursal);
        $('#sucursal_idsucursal').selectpicker('refresh');

        $("#categoria_idcategoria").val(data.categoria_idcategoria);
        $('#categoria_idcategoria').selectpicker('refresh');

        $("#horario_idhorario").val(data.horario_idhorario);
        $('#horario_idhorario').selectpicker('refresh');

    })
}

//Función para desactivar registros
function desactivar(idsucursal_categorias) {
    bootbox.confirm("¿Está Seguro de desactivar?", function(result) {
        if (result) {
            $.post("../ajax/chsucursales.php?op=desactivar", { idsucursal_categorias: idsucursal_categorias }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idsucursal_categorias) {
    bootbox.confirm("¿Está Seguro de activar?", function(result) {
        if (result) {
            $.post("../ajax/chsucursales.php?op=activar", { idsucursal_categorias: idsucursal_categorias }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}



init();