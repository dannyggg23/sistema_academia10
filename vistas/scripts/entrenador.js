var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    $.post("../ajax/alumno.php?op=selectSucursal", function(r) {
        $("#sucursal_idsucursal").html(r);
        $('#sucursal_idsucursal').selectpicker('refresh');

    });


    $("#ocultar").hide();
    $("#ocultar1").hide();
    $("#ocultar2").hide();


    $("#imagenmuestra").hide();
}


$("#checkbox1").on('change', function() {
    if ($(this).is(':checked')) {
        $('#bandera').val("true");

        console.log($('#bandera').val());

        $("#ocultar").show();
        $("#ocultar1").show();
        $("#ocultar2").show();

        $("#sucursal_idsucursal").attr("required", true);
        $("#categoria_idcategoria").attr("required", true);
        $("#idsucursal_categorias").attr("required", true);


    } else {


        $("#ocultar").hide();
        $("#ocultar1").hide();
        $("#ocultar2").hide();

        $('#bandera').val("false");
        console.log($('#bandera').val());

        $("#sucursal_idsucursal").attr("required", false);
        $("#categoria_idcategoria").attr("required", false);
        $("#idsucursal_categorias").attr("required", false);

    }

});

function abrirmodal(identrenador) {

    $('#myModal').modal('show');


    console.log(identrenador);

    $.post("../ajax/entrenador.php?op=mostrar", { identrenador: identrenador }, function(data, status) {
        data = JSON.parse(data);



        $("#identrenador1").val(data.identrenador);
        $("#cedula_entrenador1").val(data.cedula_entrenador);
        $("#nombre_entrenador1").val(data.nombre_entrenador);
        $("#apellido_entrenador1").val(data.apellido_entrenador);
        $("#direccion_entrenador1").val(data.direccion_entrenador);
        $("#email_entrenador1").val(data.email_entrenador);
        $("#telefono_entrenador1").val(data.telefono_entrenador);
        $("#celular_entrenador1").val(data.celular_entrenador);
        $("#descripcion1").val(data.descripcion);
        $("#genero_entrenador1").val(data.genero_entrenador);
        $("#titulo_entrenador1").val(data.titulo_entrenador);
        $("#fechanacimiento_entrenador1").val(data.fechanacimiento_entrenador);

        $("#imagenmodal").attr("src", "../files/entrenadores/" + data.imagen_entrenador);


    });
}

function cargarCategorias(idsucursal) {

    console.log("entra al ajax");

    $("#idsucursal_categorias").val("");
    $('#idsucursal_categorias').selectpicker('refresh');

    $('#idsucursal_categorias').find('option').remove();


    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');

    $('#categoria_idcategoria').find('option').remove();

    $.post("../ajax/entrenador.php?op=selectCategoria&sucursalCategoria=" + idsucursal, function(r) {
        $("#categoria_idcategoria").html(r);
        $('#categoria_idcategoria').selectpicker('refresh');

    });

}

function cargarHorario(idcategoria) {
    var idsucursal = $('#sucursal_idsucursal').val();

    $("#idsucursal_categorias").val("");
    $('#idsucursal_categorias').selectpicker('refresh');

    $('#idsucursal_categorias').find('option').remove();

    $.post("../ajax/entrenador.php?op=selectHorario&sucursalCategoria=" + idsucursal + "&horarioCategoria=" + idcategoria, function(r) {
        $("#idsucursal_categorias").html(r);
        $('#idsucursal_categorias').selectpicker('refresh');

    });

}

//Función limpiar
function limpiar() {



    $("#identrenador").val("");
    $("#cedula_entrenador").val("");
    $("#nombre_entrenador").val("");
    $("#apellido_entrenador").val("");
    $("#direccion_entrenador").val("");
    $("#email_entrenador").val("");
    $("#telefono_entrenador").val("");
    $("#celular_entrenador").val("");
    $("#descripcion").val("");
    $("#genero_entrenador").val("");
    $('#genero_entrenador').selectpicker('refresh');

    $("#titulo_entrenador").val("");
    $("#fechanacimiento_entrenador").val("");

    $("#sucursal_idsucursal").val("");
    $('#sucursal_idsucursal').selectpicker('refresh');

    $("#categoria_idcategoria").val("");
    $('#categoria_idcategoria').selectpicker('refresh');

    $("#idsucursal_categorias").val("");
    $('#idsucursal_categorias').selectpicker('refresh');

    $("#checkbox2").prop('checked', false);
    $("#checkbox1").prop('checked', false);


    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#imagen").val("");


}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
        $("#ocultar_ficha").show();
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
                title: 'Entrenadores',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: '../ajax/entrenador.php?op=listar',
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
        url: "../ajax/entrenador.php?op=guardaryeditar",
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

function mostrar(identrenador) {
    $.post("../ajax/entrenador.php?op=mostrar", { identrenador: identrenador }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);


        $("#ocultar_ficha").hide();
        $("#imagenmuestra").show();

        $("#identrenador").val(data.identrenador);
        $("#cedula_entrenador").val(data.cedula_entrenador);
        $("#nombre_entrenador").val(data.nombre_entrenador);
        $("#apellido_entrenador").val(data.apellido_entrenador);
        $("#direccion_entrenador").val(data.direccion_entrenador);
        $("#email_entrenador").val(data.email_entrenador);
        $("#telefono_entrenador").val(data.telefono_entrenador);
        $("#celular_entrenador").val(data.celular_entrenador);
        $("#descripcion").val(data.descripcion);
        $("#genero_entrenador").val(data.genero_entrenador);
        $('#genero_entrenador').selectpicker('refresh');
        $("#titulo_entrenador").val(data.titulo_entrenador);
        $("#fechanacimiento_entrenador").val(data.fechanacimiento_entrenador);

        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/entrenadores/" + data.imagen_entrenador);
        $("#imagenactual").val(data.imagen_entrenador);

    })
}

//Función para desactivar registros
function desactivar(identrenador) {
    bootbox.confirm("¿Está Seguro de desactivar los datos?", function(result) {
        if (result) {
            $.post("../ajax/entrenador.php?op=desactivar", { identrenador: identrenador }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(identrenador) {
    bootbox.confirm("¿Está Seguro de activar el Artículo?", function(result) {
        if (result) {
            $.post("../ajax/entrenador.php?op=activar", { identrenador: identrenador }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function validarcedula() {

    if ($("#checkbox2").is(':checked')) {

    } else {
        var cedula_representante = $('#cedula_entrenador').val();
        $.post("../ajax/representante.php?op=validarcedula", { cedula_representante: cedula_representante }, function(e) {
            if (e == "Cédula válida") {
                swal("CORRECTO", e, "success")
            } else {
                swal("ERROR", e, "error");
                $('#cedula_entrenador').val("");
            }
            tabla.ajax.reload();
        });
    }
}


init();