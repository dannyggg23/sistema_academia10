var tabla;
//################################################### MODAL REPRESENTANTE #########################################################
$("#modalrepresentante").click(function() {
    $.ajax({
        url: "../vistas/modal_representante.php",
        cache: false,
        /* Evitamos cache */
        dataType: 'html',
        /* Se recibirá contenido HTML */
        success: function(data) {
            BootstrapDialog.show({
                title: 'Datos del Representante',
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
                            var idrepresentante;
                            var cedula_representante = $("#cedula_representante").val();
                            var nombre_representante = $("#nombre_representante").val();
                            var cedula_conyugue_representante = $("#cedula_conyugue_representante").val();
                            var nombre_conyugue_representante = $("#nombre_conyugue_representante").val();
                            var genero_representante = $("#genero_representante").val();
                            var email_representante = $("#email_representante").val();
                            var telefono_representante = $("#telefono_representante").val();
                            var celular_representante = $("#celular_representante").val();
                            var ciudad_representante = $("#ciudad_representante").val();
                            var barrio_representante = $("#barrio_representante").val();
                            var direccion_representante = $("#direccion_representante").val();
                            var fecha_nacimiento_representante = $("#fecha_nacimiento_representante").val();
                            var parentesco_respresentante = $("#parentesco_respresentante").val();
                            var lugar_trabajo_representante = $("#lugar_trabajo_representante").val();

                            if (cedula_representante == "" || nombre_representante == "" || cedula_conyugue_representante == "" ||
                                nombre_conyugue_representante == "" || genero_representante == "" || email_representante == "" ||
                                telefono_representante == "" || ciudad_representante == "" || barrio_representante == "" ||
                                direccion_representante == "" || fecha_nacimiento_representante == "" || parentesco_respresentante == "" ||
                                lugar_trabajo_representante == "") { swal("ERROR", "Complete los campos correctamente", "error") } else {

                                var ciudad = ciudad_representante;

                                $.post("../ajax/representante.php?op=selectidciudad", { ciudad: ciudad }, function(data, status) {
                                    data = JSON.parse(data);

                                    ciudad_representante = data.idCiudad;

                                    genero_representante == "m" || genero_representante == "M" ? genero_representante = "Masculino" : genero_representante = "Femenino";

                                    $.post("../ajax/representante.php?op=guardar", {
                                        cedula_representante: cedula_representante,
                                        nombre_representante: nombre_representante,
                                        cedula_conyugue_representante: cedula_conyugue_representante,
                                        nombre_conyugue_representante: nombre_conyugue_representante,
                                        genero_representante: genero_representante,
                                        email_representante: email_representante,
                                        telefono_representante: telefono_representante,
                                        celular_representante: celular_representante,
                                        ciudad_representante: ciudad_representante,
                                        barrio_representante: barrio_representante,
                                        direccion_representante: direccion_representante,
                                        fecha_nacimiento_representante: fecha_nacimiento_representante,
                                        parentesco_respresentante: parentesco_respresentante,
                                        lugar_trabajo_representante: lugar_trabajo_representante,
                                        idrepresentante: idrepresentante
                                    }, function(data, status) {
                                        if (data > 0) {
                                            dialogRef.close();
                                            swal("CORRECTO", "Representante registrado", "success");
                                            $.post("../ajax/alumno.php?op=selectRepresentante", function(r) {
                                                $("#representante_idrepresentante").html(r);
                                                $("#representante_idrepresentante").val(data);
                                                $('#representante_idrepresentante').selectpicker('refresh');
                                            });
                                        } else {
                                            swal("INCORRECTO", "Verifique los datos antes de registrar", "error");
                                        }
                                    });
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

//############################################################# FIN MODAL REPRESENTANTE ######################################################

//############################################################--MOSTRAR DATOS DE FICHA---######################################################
$("#checkbox1").on('change', function() {
    if ($(this).is(':checked')) {

        $('#bandera').val("true");

        console.log($('#bandera').val());

        $("#ocultar").show();
        $("#ocultar1").show();
        $("#ocultar2").show();
        $("#ocultar3").show();

        $("#descuento_ficha_alumno").attr("required", true);
        $("#sucursal_idsucursal").attr("required", true);
        $("#categoria_idcategoria").attr("required", true);
        $("#idsucursal_categorias").attr("required", true);


    } else {


        $("#ocultar").hide();
        $("#ocultar1").hide();
        $("#ocultar2").hide();
        $("#ocultar3").hide();
        $('#bandera').val("false");
        console.log($('#bandera').val());

        $("#descuento_ficha_alumno").attr("required", false);
        $("#sucursal_idsucursal").attr("required", false);
        $("#categoria_idcategoria").attr("required", false);
        $("#idsucursal_categorias").attr("required", false);

    }

});

//############################################################-- FIN DE MOSTRAR DATOS DE FICHA---######################################################



//############################################################----MOSTRAR MODAL DE DATOS DE ALUMNO---###################################################

function abrirmodal(idalumno) {

    $('#myModal').modal('show');


    console.log(idalumno);

    $.post("../ajax/alumno.php?op=mostrar", { idalumno: idalumno }, function(data, status) {
        data = JSON.parse(data);

        $("#nombre_alumno1").val(data.nombre_alumno);
        $("#cedula_alumno1").val(data.cedula_alumno);
        $("#genero_alumno1").val(data.genero_alumno);
        $("#tipo_sangre_alumno1").val(data.tipo_sangre_alumno);
        $("#escuela_alumno1").val(data.escuela_alumno);
        $("#fecha_nacimiento1").val(data.fecha_nacimiento);
        $("#posicion_alumno1").val(data.posicion_alumno);
        $("#peso_alumno1").val(data.peso_alumno);
        $("#talla_alumno1").val(data.talla_alumno);
        $("#informacion_alumno1").val(data.informacion_alumno);
        $("#representante").val(data.cedula_representante);
        $("#nombrerepresentante").val(data.nombre_representante);
        $("#imagenmodal").attr("src", "../files/alumnos/" + data.imagen_alumno);


    });
}

//#########################################################- FIN MOSTRAR MODAL DE DATOS DE ALUMNO---###################################################


//############################################################----MOSTRAR CATEGORIAS POR SUCURSALES---###################################################

function cargarCategorias(idsucursal) {

    console.log("entra al ajax");

    $("#idsucursal_categorias").val("");
    $('#idsucursal_categorias').selectpicker('refresh');

    $('#idsucursal_categorias').find('option').remove();


    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');

    $('#categoria_idcategoria').find('option').remove();

    $.post("../ajax/alumno.php?op=selectCategoria&sucursalCategoria=" + idsucursal, function(r) {
        $("#categoria_idcategoria").html(r);
        $('#categoria_idcategoria').selectpicker('refresh');

    });

}
//############################################################-  FIN MOSTRAR CATEGORIAS POR SUCURSALES---###################################################


//############################################################----MOSTRAR HORARIOS POR SUCURSALES Y CATEGORIAS ---###################################################

function cargarHorario(idcategoria) {
    var idsucursal = $('#sucursal_idsucursal').val();

    $("#idsucursal_categorias").val("");
    $('#idsucursal_categorias').selectpicker('refresh');

    $('#idsucursal_categorias').find('option').remove();

    $.post("../ajax/alumno.php?op=selectHorario&sucursalCategoria=" + idsucursal + "&horarioCategoria=" + idcategoria, function(r) {
        $("#idsucursal_categorias").html(r);
        $('#idsucursal_categorias').selectpicker('refresh');

    });

}

//############################################################---- FIN MOSTRAR HORARIOS POR SUCURSALES Y CATEGORIAS ---###################################################


function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })



    //Cargamos los items al select 
    $.post("../ajax/alumno.php?op=selectRepresentante", function(r) {
        $("#representante_idrepresentante").html(r);
        $('#representante_idrepresentante').selectpicker('refresh');

    });

    $.post("../ajax/alumno.php?op=selectSucursal", function(r) {
        $("#sucursal_idsucursal").html(r);
        $('#sucursal_idsucursal').selectpicker('refresh');

    });

    $("#imagenmuestra").hide();
    $("#ocultar").hide();
    $("#ocultar1").hide();
    $("#ocultar2").hide();
    $("#ocultar3").hide();


}



//Función limpiar
function limpiar() {
    $("#idalumno").val("");
    $("#cedula_alumno").val("");
    $("#nombre_alumno").val("");
    $("#genero_alumno").val("");
    $('#genero_alumno').selectpicker('refresh');

    $("#representante_idrepresentante").val("");
    $('#representante_idrepresentante').selectpicker('refresh');

    $("#tipo_sangre_alumno").val("");
    $("#escuela_alumno").val("");
    $("#fecha_nacimiento").val("");
    $("#posicion_alumno").val("");

    $("#peso_alumno").val("");
    $("#talla_alumno").val("");
    $("#informacion_alumno").val("");

    $("#descuento_ficha_alumno").val("");
    $("#sucursal_idsucursal").val("");
    $('#sucursal_idsucursal').selectpicker('refresh');

    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');

    $("#idsucursal_categorias").val("");
    $('#idsucursal_categorias').selectpicker('refresh');

    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#imagen").val("");

    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    $('#fechaApertura_alumno').val(today);
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#checkbox1").show();
        $("#imagenmuestra").hide();

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
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: '../ajax/alumno.php?op=listar',
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
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/alumno.php?op=guardaryeditar",
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

function mostrar(idalumno) {
    $.post("../ajax/alumno.php?op=mostrar", { idalumno: idalumno }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#representante_idrepresentante").val(data.representante_idrepresentante);
        $('#representante_idrepresentante').selectpicker('refresh');

        $("#idalumno").val(data.idalumno);
        $("#cedula_alumno").val(data.cedula_alumno);
        $("#nombre_alumno").val(data.nombre_alumno);
        $("#genero_alumno").val(data.genero_alumno);
        $('#genero_alumno').selectpicker('refresh');


        $("#tipo_sangre_alumno").val(data.tipo_sangre_alumno);
        $("#escuela_alumno").val(data.escuela_alumno);
        $("#fecha_nacimiento").val(data.fecha_nacimiento);
        $("#posicion_alumno").val(data.posicion_alumno);
        $("#peso_alumno").val(data.peso_alumno);
        $("#talla_alumno").val(data.talla_alumno);
        $("#informacion_alumno").val(data.informacion_alumno);

        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/alumnos/" + data.imagen_alumno);
        $("#imagenactual").val(data.imagen_alumno);

        $("#ocultar").hide();
        $("#ocultar1").hide();
        $("#ocultar2").hide();
        $("#ocultar3").hide();
        $("#checkbox1").hide();
        $("#imagenmuestra").show();

    })
}

//Función para desactivar registros
function desactivar(idalumno) {
    bootbox.confirm("¿Está Seguro de desactivar los datos?", function(result) {
        if (result) {
            $.post("../ajax/alumno.php?op=desactivar", { idalumno: idalumno }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idalumno) {
    bootbox.confirm("¿Está Seguro de activar lod datos?", function(result) {
        if (result) {
            $.post("../ajax/alumno.php?op=activar", { idalumno: idalumno }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function validarcedula() {

    var cedula_representante = $('#cedula_alumno').val();
    $.post("../ajax/representante.php?op=validarcedula", { cedula_representante: cedula_representante }, function(e) {
        e == "Cédula válida" ? swal("CORRECTO", e, "success") : swal("ERROR", e, "error");
        tabla.ajax.reload();
    });
}

function validarcedularepresentante() {

    var cedula_representante = $('#cedula_representante').val();
    $.post("../ajax/representante.php?op=validarcedula", { cedula_representante: cedula_representante }, function(e) {
        e == "Cédula válida" ? swal("CORRECTO", e, "success") : swal("ERROR", e, "error");
        tabla.ajax.reload();
    });
}

function validarcedularepresentanteconyugue() {

    var cedula_representante = $('#cedula_conyugue_representante').val();
    $.post("../ajax/representante.php?op=validarcedula", { cedula_representante: cedula_representante }, function(e) {
        e == "Cédula válida" ? swal("CORRECTO", e, "success") : swal("ERROR", e, "error");
        tabla.ajax.reload();
    });
}

init();