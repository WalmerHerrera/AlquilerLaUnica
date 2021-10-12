$(document).ready(function() {
    tablaReserva = $("#tablaReserva").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarR'>Editar</button><button class='btn btn-danger btnBorrarR'>Borrar</button></div></div>"
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
    $("#btnNuevoR").click(function() {
        $("#formReserva").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Reserva");
        $("#modalCRUD").modal("show");
        opcion = 1; //alta
    });
    var fila; //capturar la fila para editar o borrar el registro
    //botón EDITAR    
    $(document).on("click", ".btnEditarR", function() {
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Reserva");
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        cliente = fila.find('td:eq(1)').text();
        usuario = fila.find('td:eq(2)').text();
        $("#id").val(id);
        $("#cbo_cliente").val(cliente);
        $("#cbo_usuario").val(usuario);
        opcion = 2; //editar
        $("#modalCRUD").modal("show");
    });
    //botón BORRAR
    $(document).on("click", ".btnBorrarR", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        opcion = 3; //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "../CONTROLADORES/crud_Reserva.php",
                type: "POST",
                dataType: "json",
                data: {
                    opcion: opcion,
                    id: id
                },
                success: function() {
                    tablaReserva.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });
    $("#formReserva").submit(function(e) {
        e.preventDefault();
        id = $.trim($("#id").val());
        codCliente = $.trim($("#cbo_cliente").val());
        idUsuario = $.trim($("#cbo_usuario").val());
        $.ajax({
            url: "../CONTROLADORES/crud_Reserva.php",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                codCliente: codCliente,
                idUsuario: idUsuario,
                opcion: opcion
            },
            success: function(data) {
                console.log(data);
                id = data[0].id;
                codCliente = data[0].codCliente;
                idUsuario = data[0].idUsuario;
                if (opcion == 1) {
                    tablaReserva.row.add([id, codCliente, idUsuario]).draw();
                } else {
                    tablaReserva.row(fila).data([id, codCliente, idUsuario]).draw();
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});