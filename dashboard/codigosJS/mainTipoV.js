$(document).ready(function() {
    tablaTipoV = $("#tablaTipoV").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarT'>Editar</button><button class='btn btn-danger btnBorrarT'>Borrar</button></div></div>"
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
    $("#btnNuevoT").click(function() {
        $("#formTipoV").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Agregar nuevo tipo de vehiculo");
        $("#modalCRUD").modal("show");
        opcion = 1; //alta
    });
    var fila; //capturar la fila para editar o borrar el registro
    //botón EDITAR    
    $(document).on("click", ".btnEditarT", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        nombre = fila.find('td:eq(1)').text();
        costo = fila.find('td:eq(2)').text();
        $("#id").val(id);
        $("#nombre").val(nombre);
        $("#costo").val(costo);
        opcion = 2; //editar
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Tipo de vehiculo");
        $("#modalCRUD").modal("show");
    });
    //botón BORRAR
    $(document).on("click", ".btnBorrarT", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        opcion = 3; //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "../CONTROLADORES/crud_tipoVehiculo.php",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    opcion: opcion
                },
                success: function() {
                    tablaTipoV.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });
    $("#formTipoV").submit(function(e) {
        e.preventDefault();
        id = $.trim($("#id").val());
        nombre = $.trim($("#nombre").val());
        costo = $.trim($("#costo").val());
        $.ajax({
            url: "../CONTROLADORES/crud_tipoVehiculo.php",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                nombre: nombre,
                costo: costo,
                opcion: opcion
            },
            success: function(data) {
                console.log(data);
                id = data[0].id;
                nombre = data[0].nombre;
                costoDiario = data[0].costoDiario;
                if (opcion == 1) {
                    tablaTipoV.row.add([id, nombre, costoDiario]).draw();
                } else {
                    tablaTipoV.row(fila).data([id, nombre, costoDiario]).draw();
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});