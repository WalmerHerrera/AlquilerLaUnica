$(document).ready(function() {
    tablaAgencias = $("#tablaAgencias").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarA'>Editar</button><button class='btn btn-danger btnBorrarA'>Borrar</button></div></div>"
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
    $("#btnNuevoA").click(function() {
        $("#formAgencias").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Agencia");
        $("#modalCRUD").modal("show");
        opcion = 1; //alta
    });
    var fila; //capturar la fila para editar o borrar el registro
    //botón EDITAR    
    $(document).on("click", ".btnEditarA", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        ciudad = fila.find('td:eq(1)').text();
        direccion = fila.find('td:eq(2)').text();
        cuenta = fila.find('td:eq(3)').text();
        cci = fila.find('td:eq(4)').text();
        $("#id").val(id);
        $("#ciudad").val(ciudad);
        $("#direccion").val(direccion);
        $("#cuenta").val(cuenta);
        $("#cci").val(cci);
        opcion = 2; //editar
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Agencia");
        $("#modalCRUD").modal("show");
    });
    //botón BORRAR
    $(document).on("click", ".btnBorrarA", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "../CONTROLADORES/crud_agencia.php",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    opcion: opcion
                },
                success: function() {
                    tablaAgencias.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });
    $("#formAgencias").submit(function(e) {
        e.preventDefault();
        id = $.trim($("#id").val());
        ciudad = $.trim($("#ciudad").val());
        direccion = $.trim($("#direccion").val());
        cuenta = $.trim($("#cuenta").val());
        cci = $.trim($("#cci").val());
        $.ajax({
            url: "../CONTROLADORES/crud_agencia.php",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                ciudad: ciudad,
                direccion: direccion,
                cuenta: cuenta,
                cci: cci,
                opcion: opcion
            },
            success: function(data) {
                console.log(data);
                id = data[0].id;
                ciudad = data[0].ciudad;
                direccion = data[0].direccion;
                cuenta = data[0].cuenta;
                cci = data[0].cci;
                if (opcion == 1) {
                    tablaAgencias.row.add([id, ciudad, direccion, cuenta, cci]).draw();
                } else {
                    tablaAgencias.row(fila).data([id, ciudad, direccion, cuenta, cci]).draw();
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});