<center><h1>Contenido Alquiler</h1></center>
    
     
 <?php
        $objeto = new conexion();
        $conexion = $objeto->ConectarDB();
        $consulta = "SELECT `id`, `idReserva`, `id_vehiculo`, `fechaSalida`, `fechaEntrada`, `observaciones` FROM `Alquiler` WHERE 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoAl" type="button" class="btn btn-success" data-toggle="modal">Nuevo alquiler</button>    
            </div> 
        </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaAlquiler" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>reserva</th>
                                <th>vehiculo</th>
                                <th>Fecha Salida</th>                                 
                                <th>Fecha Entrada</th>
                                <th>Observaciones</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if($data!=null){                           
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['idReserva'] ?></td>
                                <td><?php echo $dat['id_vehiculo'] ?></td>
                                <td><?php echo $dat['fechaSalida'] ?></td>
                                <td><?php echo $dat['fechaEntrada'] ?></td> 
                                <td><?php echo $dat['observaciones'] ?></td> 
                                <td>
                                </td>  
                               
                            </tr>
                            <?php
                                }}
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
 
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formAlquiler">    
            <div class="modal-body">
                <div class="form-group">
                <label for="id" class="col-form-label">id:</label>
                <input type="text" class="form-control" name ="id" id="id" disabled>
                </div>
                
                <div class="form-group">
                    <label for="modelo" class="col-form-label">Reserva</label>
                    <select class="form-control" name="cbo_reserva" id="cbo_reserva">
                        <?php 
                        $consulta = "select id from reserva"; 
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();
                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $dat){?>
                        <option value="<?php echo $dat['id']; ?>"> "<?php echo $dat['id']; ?>"</option>
                        <?php } ?>
                    </select>
                </div>                 
                <div class="form-group">
                    <label for="tipo" class="col-form-label">Vehiculo:</label>
                    <select class="form-control" name="cbo_vehiculo" id="cbo_vehiculo">
                        <?php
                        $consulta = "select placa from vehiculo"; 
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();
                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $dat){?>
                        <option value="<?php echo $dat['placa']; ?>"> "<?php echo $dat['placa']; ?>"</option>
                        <?php } ?>
                    </select>
                </div> 
                <div class="form-group">
                <label for="observacion" class="col-form-label">Fecha Salida:</label>
                 <input type="datetime-local" class="form-control" name="salida" id="salida">
                </div>  
                <div class="form-group">
                <label for="observacion" class="col-form-label">Fecha Entrada:</label>
                 <input type="date" class="form-control" name="entrada" id="entrada">
                </div>                              
                <div class="form-group">
                <label for="observacion" class="col-form-label">Observaciones:</label>
                <input type="text" class="form-control" name="observacion" id="observacion">
                </div>
               
                           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div> 
    
</div>
