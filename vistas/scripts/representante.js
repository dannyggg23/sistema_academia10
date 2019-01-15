var tabla;

//Función que se ejecuta al inicio
function init() {
    console.log("entra al js");
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    $.post("../ajax/representante.php?op=selectCiudad", function(r) {
        $("#ciudad_representante").html(r);
        $('#ciudad_representante').selectpicker('refresh');

    });

}

//Función limpiar
function limpiar() {
    $("#idrepresentante").val("");
    $("#cedula_representante").val("");
    $("#nombre_representante").val("");
    $("#email_representante").val("");
    $("#direccion_representante").val("");
    $("#telefono_representante").val("");
    $("#fecha_nacimiento_representante").val("");
    $("#parentesco_respresentante").val("");
    $("#celular_representante").val("");
    $("#lugar_trabajo_representante").val("");
    $("#cedula_conyugue_representante").val("");
    $("#nombre_conyugue_representante").val("");
    $("#barrio_representante").val("");

    $("#ciudad_representante").val("");
    $('#ciudad_representante').selectpicker('refresh');


    $("#genero_representante").val("");
    $('#genero_representante').selectpicker('refresh');

}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnGuardar").show();
        $("#btnagregar").hide();

        $("#idrepresentante").attr('disabled', false);
        $("#cedula_representante").attr('disabled', false);
        $("#nombre_representante").attr('disabled', false);
        $("#email_representante").attr('disabled', false);
        $("#direccion_representante").attr('disabled', false);
        $("#telefono_representante").attr('disabled', false);

        $("#fecha_nacimiento_representante").attr('disabled', false);
        $("#parentesco_respresentante").attr('disabled', false);
        $("#celular_representante").attr('disabled', false);
        $("#lugar_trabajo_representante").attr('disabled', false);
        $("#cedula_conyugue_representante").attr('disabled', false);
        $("#nombre_conyugue_representante").attr('disabled', false);
        $("#barrio_representante").attr('disabled', false);


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
                title: 'Representantes'
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5'
        ],
        "ajax": {
            url: '../ajax/representante.php?op=listar',
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
        url: "../ajax/representante.php?op=guardaryeditar",
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

function mostrar(idrepresentante) {
    $.post("../ajax/representante.php?op=mostrar", { idrepresentante: idrepresentante }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#btnGuardar").show();
        $("#btnagregar").hide();

        $("#idrepresentante").attr('disabled', false);
        $("#cedula_representante").attr('disabled', false);
        $("#nombre_representante").attr('disabled', false);
        $("#email_representante").attr('disabled', false);
        $("#direccion_representante").attr('disabled', false);
        $("#telefono_representante").attr('disabled', false);

        $("#fecha_nacimiento_representante").attr('disabled', false);
        $("#parentesco_respresentante").attr('disabled', false);
        $("#celular_representante").attr('disabled', false);
        $("#lugar_trabajo_representante").attr('disabled', false);
        $("#cedula_conyugue_representante").attr('disabled', false);
        $("#nombre_conyugue_representante").attr('disabled', false);
        $("#barrio_representante").attr('disabled', false);


        $("#idrepresentante").val(data.idrepresentante);
        $("#cedula_representante").val(data.cedula_representante);
        $("#nombre_representante").val(data.nombre_representante);
        $("#email_representante").val(data.email_representante);
        $("#direccion_representante").val(data.direccion_representante);
        $("#telefono_representante").val(data.telefono_representante);
        $("#genero_representante").val(data.genero_representante);
        $('#genero_representante').selectpicker('refresh');
        $("#fecha_nacimiento_representante").val(data.fecha_nacimiento_representante);
        $("#parentesco_respresentante").val(data.parentesco_respresentante);
        $("#celular_representante").val(data.celular_representante);
        $("#lugar_trabajo_representante").val(data.lugar_trabajo_representante);
        $("#cedula_conyugue_representante").val(data.cedula_conyugue_representante);
        $("#nombre_conyugue_representante").val(data.nombre_conyugue_representante);
        $("#barrio_representante").val(data.barrio_representante);
        $("#ciudad_representante").val(data.ciudad_representante);
        $('#ciudad_representante').selectpicker('refresh');

    })
}

function ver(idrepresentante) {
    $.post("../ajax/representante.php?op=mostrar", { idrepresentante: idrepresentante }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#btnGuardar").hide();
        $("#btnagregar").hide();


        $("#idrepresentante").attr('disabled', 'disabled');
        $("#cedula_representante").attr('disabled', 'disabled');
        $("#nombre_representante").attr('disabled', 'disabled');
        $("#email_representante").attr('disabled', 'disabled');
        $("#direccion_representante").attr('disabled', 'disabled');
        $("#telefono_representante").attr('disabled', 'disabled');

        $("#fecha_nacimiento_representante").attr('disabled', 'disabled');
        $("#parentesco_respresentante").attr('disabled', 'disabled');
        $("#celular_representante").attr('disabled', 'disabled');
        $("#lugar_trabajo_representante").attr('disabled', 'disabled');
        $("#cedula_conyugue_representante").attr('disabled', 'disabled');
        $("#nombre_conyugue_representante").attr('disabled', 'disabled');
        $("#barrio_representante").attr('disabled', 'disabled');


        $("#idrepresentante").val(data.idrepresentante);
        $("#cedula_representante").val(data.cedula_representante);
        $("#nombre_representante").val(data.nombre_representante);
        $("#email_representante").val(data.email_representante);
        $("#direccion_representante").val(data.direccion_representante);
        $("#telefono_representante").val(data.telefono_representante);
        $("#genero_representante").val(data.genero_representante);
        $('#genero_representante').selectpicker('refresh');
        $("#fecha_nacimiento_representante").val(data.fecha_nacimiento_representante);
        $("#parentesco_respresentante").val(data.parentesco_respresentante);
        $("#celular_representante").val(data.celular_representante);
        $("#lugar_trabajo_representante").val(data.lugar_trabajo_representante);
        $("#cedula_conyugue_representante").val(data.cedula_conyugue_representante);
        $("#nombre_conyugue_representante").val(data.nombre_conyugue_representante);
        $("#barrio_representante").val(data.barrio_representante);
        $("#ciudad_representante").val(data.ciudad_representante);
        $('#ciudad_representante').selectpicker('refresh');

    })
}

//Función para desactivar registros
function desactivar(idrepresentante) {
    bootbox.confirm("¿Está Seguro de desactivar?", function(result) {
        if (result) {
            $.post("../ajax/representante.php?op=desactivar", { idrepresentante: idrepresentante }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idrepresentante) {
    bootbox.confirm("¿Está Seguro de activar?", function(result) {
        if (result) {
            $.post("../ajax/representante.php?op=activar", { idrepresentante: idrepresentante }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function validarcedula() {
    if ($("#checkbox2").is(':checked')) {} else {
        var cedula_representante = $('#cedula_representante').val();
        $.post("../ajax/representante.php?op=validarcedula", { cedula_representante: cedula_representante }, function(e) {
            if (e == "Cédula válida") { swal("CORRECTO", e, "success") } else {
                swal("ERROR", e, "error");
                $('#cedula_representante').val("");
            }
            tabla.ajax.reload();
        });
    }
}




function validarcedula1() {
    if ($("#checkbox3").is(':checked')) {} else {
        var cedula_representante = $('#cedula_conyugue_representante').val();
        $.post("../ajax/representante.php?op=validarcedula", { cedula_representante: cedula_representante }, function(e) {
            if (e == "Cédula válida") { swal("CORRECTO", e, "success") } else {
                swal("ERROR", e, "error");
                $('#cedula_conyugue_representante').val("");
            }
            tabla.ajax.reload();
        });
    }
}
init();