$(document).ready(function() {
    tablaUsuarios = $("#tablaUsuarios").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarU'>Editar</button><button class='btn btn-danger btnBorrarU'>Borrar</button></div></div>"
        }],
        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    });
    $("#btnNuevoU").click(function() {
        $("#formUsuarios").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Usuario");
        $("#modalCRUD").modal("show");
        opcion = 1; //alta
    });
    var fila; //capturar la fila para editar o borrar el registro
    //botón EDITAR    
    $(document).on("click", ".btnEditarU", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        nombre = fila.find('td:eq(1)').text();
        Apellidos = fila.find('td:eq(2)').text();
        correo = fila.find('td:eq(3)').text();
        telefono = fila.find('td:eq(4)').text();
        usuario = fila.find('td:eq(5)').text();
        $("#id").val(id);
        $("#nombre").val(nombre);
        $("#Apellidos").val(Apellidos);
        $("#correo").val(correo);
        $("#telefono").val(telefono);
        $("#usuario").val(usuario);
        opcion = 2; //editar
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Usuario");
        $("#modalCRUD").modal("show");
    });
    //botón BORRAR
    $(document).on("click", ".btnBorrarU", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "../CONTROLADORES/crud_Usuario.php",
                type: "POST",
                dataType: "json",
                data: {
                    opcion: opcion,
                    id: id
                },
                success: function() {
                    tablaUsuarios.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });
    $("#formUsuarios").submit(function(e) {
        e.preventDefault();
        id = $.trim($("#id").val());
        nombre = $.trim($("#nombre").val());
        Apellidos = $.trim($("#Apellidos").val());
        correo = $.trim($("#correo").val());
        usuario = $.trim($("#usuario").val());
        telefono = $.trim($("#telefono").val());
        contraseña = $.trim($("#contraseña").val());
        $.ajax({
            url: "../CONTROLADORES/crud_Usuario.php",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                nombre: nombre,
                Apellidos: Apellidos,
                correo: correo,
                telefono: telefono,
                usuario: usuario,
                contraseña: contraseña,
                opcion: opcion
            },
            success: function(data) {
                console.log(data);
                id = data[0].id;
                nombre = data[0].nombre;
                Apellidos = data[0].Apellidos;
                correo = data[0].correo;
                telefono = data[0].telefono;
                usuario = data[0].usuario;
                if (opcion == 1) {
                    tablaUsuarios.row.add([id, nombre, Apellidos, correo, telefono, usuario]).draw();
                } else {
                    tablaUsuarios.row(fila).data([id, nombre, Apellidos, correo, telefono, usuario]).draw();
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});