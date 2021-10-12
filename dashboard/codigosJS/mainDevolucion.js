$(document).ready(function() {
    tablaDevolucion = $("#tablaDevolucion").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarD'>Editar</button><button class='btn btn-danger btnBorrarD'>Borrar</button></div></div>"
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
    $("#btnNuevoD").click(function() {
        $("#formDevolucion").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Registrar Devolucion");
        $("#modalCRUD").modal("show");
        opcion = 1; //alta
    });
    var fila; //capturar la fila para editar o borrar el registro
    //botón EDITAR    
    $(document).on("click", ".btnEditarD", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        idAlquiler = fila.find('td:eq(1)').text();
        horaD = fila.find('td:eq(2)').text();
        daños = fila.find('td:eq(3)').text();
        faltantes = fila.find('td:eq(4)').text();
        cosDaño = fila.find('td:eq(5)').text();
        cosFaltante = fila.find('td:eq(6)').text();
        $("#id").val(idAlquiler);
        //$("#idAlquiler").val(idAlquiler);
        //$("#horaD").val("2013-3-18T13:00");
        //$("input[type=datetime-local]").prop("#horaD", horaD);
        $("#daños").val(daños);
        $("#faltantes").val(faltantes);
        $("#cosDaño").val(cosDaño);
        $("#cosFaltante").val(cosFaltante);
        opcion = 2; //editar
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Devolucion");
        $("#modalCRUD").modal("show");
    });
    //botón BORRAR
    $(document).on("click", ".btnBorrarD", function() {
        fila = $(this).closest("tr");
        id = fila.find('td:eq(0)').text();
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
        if (respuesta) {
            $.ajax({
                url: "../CONTROLADORES/crud_Devolucion.php",
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
    $("#formDevolucion").submit(function(e) {
        e.preventDefault();
        id = $.trim($("#id").val());
        idAlquiler = $.trim($("#idAlquiler").val());
        horaD = $.trim($("#horaD").val());
        daños = $.trim($("#daños").val());
        faltantes = $.trim($("#faltantes").val());
        cosDaño = $.trim($("#cosDaño").val());
        cosFaltante = $.trim($("#cosFaltante").val());
        $.ajax({
            url: "../CONTROLADORES/crud_Devolucion.php",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                idAlquiler: idAlquiler,
                horaD: horaD,
                daños: daños,
                faltantes: faltantes,
                cosDaño: cosDaño,
                cosFaltante: cosFaltante,
                opcion: opcion
            },
            success: function(data) {
                console.log(data);
                id = data[0].id;
                idAlquiler = data[0].idAlquiler;
                horaD = data[0].horaD;
                daños = data[0].daños;
                faltantes = data[0].faltantes;
                cosDaño = data[0].cosDaño;
                cosFaltante = data[0].cosFaltante;
                if (opcion == 1) {
                    tablaDevolucion.row.add([id, idAlquiler, horaD, daños, faltantes, cosDaño, cosFaltante]).draw();
                } else {
                    tablaDevolucion.row(fila).data([id, idAlquiler, horaD, daños, faltantes, cosDaño, cosFaltante]).draw();
                }
            }
        });
        $("#modalCRUD").modal("hide");
    });
});