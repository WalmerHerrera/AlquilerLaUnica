$(document).ready(function() {
    tablaModelos = $("#tablaModelos").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarMo'>Editar</button><button class='btn btn-danger btnBorrarMo'>Borrar</button></div></div>"
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
    var id = document.getElementById('id');
    $("#btnNuevoMo").click(function() {
        $("#formModelos").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Agregar nuevo modelo");
        $("#modalCRUD").modal("show");
        opcion = 1; //alta
        id.disable = false;
    });
    var fila; //capturar la fila para editar o borrar el registro
    //botón EDITAR    
    $(document).on("click", ".btnEditarMo", function() {
        fila = $(this).closest("tr");
        id.disable = true;
        idmarca = fila.find('td:eq(0)').text();
        nombre = fila.find('td:eq(1)').text();
        $("#id").val(idmarca);
        $("#nombre").val(nombre);
        opcion = 2; //editar
        $(".modal-header").css("background-color", "#e74a3b");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Modelo");
        $("#modalCRUD").modal("show");
    });
    //botón BORRAR
    $(document).on("click", ".btnBorrarMo", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "../CONTROLADORES/crud_Marca.php",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    opcion: opcion
                },
                success: function() {
                    tablaModelos.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });
    $("#formModelos").submit(function(e) {
        e.preventDefault();
        nombre = $.trim($("#nombre").val());
        $.ajax({
            url: "../CONTROLADORES/crud_Marca.php",
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
                    tablaMarcas.row.add([nombre]).draw();
                } else {
                    tablaMarcas.row(fila).data([nombre]).draw();
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});