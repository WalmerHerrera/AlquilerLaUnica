$(document).ready(function() {
    tablaVehiculo = $("#tablaVehiculo").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarV'>Editar</button><button class='btn btn-danger btnBorrarV'>Borrar</button></div></div>"
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
    $("#btnNuevoV").click(function() {
        $("#formVehiculo").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Agregar nuevo Vehiculo");
        $("#modalCRUD").modal("show");
        opcion = 1; //alta
    });
    var fila; //capturar la fila para editar o borrar el registro
    //botón EDITAR    
    $(document).on("click", ".btnEditarV", function() {
        fila = $(this).closest("tr");
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Vehiculo");
        $("#modalCRUD").modal("show");
        placa = fila.find('td:eq(0)').text();
        idModelo = fila.find('td:eq(1)').text();
        idTipoVehiculo = fila.find('td:eq(3)').text();
        color = fila.find('td:eq(4)').text();
        estado = fila.find('td:eq(5)').text();
        $("#placa").val(placa);
        $("#idModelo").val(idModelo);
        $("#idTipoVehiculo").val(idTipoVehiculo);
        $("#color").val(color);
        $("#estado").val(estado);
        opcion = 2; //editar
    });
    //botón BORRAR
    $(document).on("click", ".btnBorrarV", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "../CONTROLADORES/crud_vehiculo.php",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    opcion: opcion
                },
                success: function() {
                    tablaMarcas.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });
    $("#fromVehiculo").submit(function(e) {
        e.preventDefault();
        nombre = $.trim($("#nombre").val());
        $.ajax({
            url: "../CONTROLADORES/crud_vehiculo.php",
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
                nombre = data[0].nombre;
                if (opcion == 1) {
                    tablaVehiculo.row.add([nombre]).draw();
                } else {
                    tablaVehiculo.row(fila).data([nombre]).draw();
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});
/**/