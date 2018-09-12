var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    //Cargamos los items al select 
    $.post("../ajax/usuario.php?op=selectRepresentante", function(r) {
        $("#representante_idrepresentante").html(r);
        $('#representante_idrepresentante').selectpicker('refresh');

    });

    $.post("../ajax/usuario.php?op=selectSucursal", function(r) {
        $("#sucursal_idsucursal").html(r);
        $('#sucursal_idsucursal').selectpicker('refresh');

    });
    $("#imagenmuestra").hide();

    //MOSTRAMOS LOS PERMISOS
    $.post("../ajax/usuario.php?op=permisos&id=", function(r) {
        $("#permisos").html(r);
    });
}

//Función limpiar
function limpiar() {
    $("#idusuario").val("");
    $("#nombre_usuario").val("");
    $("#cedula_usuario").val("");
    $("#direccion_usuario").val("");
    $("#telefono_usuario").val("");
    $("#celular_usuario").val("");
    $("#email_usuario").val("");
    $("#cargo_usuario").val("");
    $("#login_usuario").val("");
    $("#clave_usuario").val("");
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
                title: 'Usuarios',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: '../ajax/usuario.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 30, //Paginación
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
        url: "../ajax/usuario.php?op=guardaryeditar",
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

function mostrar(idusuario) {

    $.post("../ajax/usuario.php?op=clave", function(data, status) {
        mostrarform(true);

        data = JSON.parse(data);


        $("#clave_usuario").val(data.clave);



    });


    $.post("../ajax/usuario.php?op=mostrar", { idusuario: idusuario }, function(data, status) {
        data = JSON.parse(data);




        $("#idusuario").val(data.idusuario);
        $("#nombre_usuario").val(data.nombre_usuario);
        $("#cedula_usuario	").val(data.cedula_usuario);
        $("#direccion_usuario").val(data.direccion_usuario);

        $("#telefono_usuario").val(data.telefono_usuario);
        $("#celular_usuario").val(data.celular_usuario);

        $("#email_usuario").val(data.email_usuario);
        $("#cargo_usuario").val(data.cargo_usuario);

        $("#login_usuario").val(data.login_usuario);
        //$("#clave_usuario").val(a);

        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src", "../files/usuarios/" + data.imagen_usuario);
        $("#imagenactual").val(data.imagen_usuario);

    });
    $.post("../ajax/usuario.php?op=permisos&id=" + idusuario, function(r) {
        $("#permisos").html(r);
    });
}

//Función para desactivar registros
function desactivar(idusuario) {
    bootbox.confirm("¿Está Seguro de desactivar los datos?", function(result) {
        if (result) {
            $.post("../ajax/usuario.php?op=desactivar", { idusuario: idusuario }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

//Función para activar registros
function activar(idusuario) {
    bootbox.confirm("¿Está Seguro de activar los datos?", function(result) {
        if (result) {
            $.post("../ajax/usuario.php?op=activar", { idusuario: idusuario }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}


init();