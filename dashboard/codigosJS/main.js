$(document).ready(function() {
    tablaClientes = $("#tablaClientes").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarC'>Editar</button><button class='btn btn-danger btnBorrarC'>Borrar</button></div></div>"
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
    $("#btnNuevoC").click(function() {
        $("#formClientes").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo cliente");
        $("#modalCRUD").modal("show");
        opcion = 1; //alta
    });
    var fila; //capturar la fila para editar o borrar el registro
    //botón EDITAR    
    $(document).on("click", ".btnEditarC", function() {
        fila = $(this).closest("tr");
        cod = fila.find('td:eq(0)').text();
        dni = fila.find('td:eq(1)').text();
        nombre = fila.find('td:eq(2)').text();
        direccion = fila.find('td:eq(3)').text();
        telefono = fila.find('td:eq(4)').text();
        $("#cod").val(cod);
        $("#dni").val(dni);
        $("#nombre").val(nombre);
        $("#direccion").val(direccion);
        $("#telefono").val(telefono);
        opcion = 2; //editar
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Cliente");
        $("#modalCRUD").modal("show");
    });
    //botón BORRAR
    $(document).on("click", ".btnBorrarC", function() {
        fila = $(this).closest("tr");
        cod = fila.find('td:eq(0)').text();
        opcion = 3; //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + cod + "?");
        if (respuesta) {
            $.ajax({
                url: "../CONTROLADORES/crud_cliente.php",
                type: "POST",
                dataType: "json",
                data: {
                    opcion: opcion,
                    cod: cod
                },
                success: function() {
                    tablaClientes.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });
    $("#formClientes").submit(function(e) {
        e.preventDefault();
        cod = $.trim($("#cod").val());
        dni = $.trim($("#dni").val());
        nombre = $.trim($("#nombre").val());
        direccion = $.trim($("#direccion").val());
        telefono = $.trim($("#telefono").val());
        $.ajax({
            url: "../CONTROLADORES/crud_cliente.php",
            type: "POST",
            dataType: "json",
            data: {
                cod: cod,
                dni: dni,
                nombre: nombre,
                direccion: direccion,
                telefono: telefono,
                opcion: opcion
            },
            success: function(data) {
                console.log(data);
                cod = data[0].cod;
                dni = data[0].dni;
                nombre = data[0].nombre;
                direccion = data[0].direccion;
                telefono = data[0].telefono;
                if (opcion == 1) {
                    tablaClientes.row.add([cod, dni, nombre, direccion, telefono]).draw();
                } else {
                    tablaClientes.row(fila).data([cod, dni, nombre, direccion, telefono]).draw();
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});