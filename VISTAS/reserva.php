<center><h1>Contenido Reserva</h1></center>
    
     
 <?php
        $objeto = new conexion();
        $conexion = $objeto->ConectarDB();
        $consulta = "Select r.id, c.nombre as cliente, u.nombre as usuario,r.costoTotal 
        from reserva r 
        inner join cliente c on c.cod=r.codCliente 
        inner join USUARIO u on u.id=r.idUsuario";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoR" type="button" class="btn btn-success" data-toggle="modal">Nueva Reserva</button>    
            </div> 
        </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaReserva" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id</th>
                                <th>cliente</th>
                                <th>trabajador</th>
                                <th>costo</th>                                 
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
                                <td><?php echo $dat['cliente'] ?></td>
                                <td><?php echo $dat['usuario'] ?></td>
                                <td><?php echo $dat['costoTotal'] ?></td>
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
        <form id="formReserva">    
            <div class="modal-body">
                <div class="form-group">
                <label for="id" class="col-form-label">ID:</label>
                <input type="text" class="form-control" id="id" disabled>
                </div>
                
                <div class="form-group">
                    <label for="modelo" class="col-form-label">Cliente</label>
                    <select class="form-control" name="cbo_cliente" id="cbo_cliente">
                        <?php
                        $consulta = "select cod,nombre from cliente"; 
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();
                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
                        foreach($data as $dat){?>
                        <option value="<?php echo $dat['cod']; ?>"> "<?php echo $dat['nombre']; ?>"</option>
                        <?php } ?>
                    </select>
                </div>                 
                <div class="form-group">
                    <label for="usuario" class="col-form-label">Trabajador:</label>
                    <select class="form-control" name="cbo_usuario" id="cbo_usuario">
                        <?php
                        $consulta = "select id,nombre from USUARIO"; 
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();
                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        $conexion=null;
                        foreach($data as $dat){?>
                        <option value="<?php echo $dat['id']; ?>"> "<?php echo $dat['nombre']; ?>"</option>
                        <?php } ?>
                    </select>
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
