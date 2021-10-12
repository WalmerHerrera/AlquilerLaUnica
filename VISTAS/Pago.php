<center><h1>Contenido Pago</h1></center>
    
     
 <?php
        $objeto = new conexion();
        $conexion = $objeto->ConectarDB();
        $consulta = "select p.id,p.idreserva,c.nombre 
from pago p
inner join reserva r on r.id=p.idreserva
inner join cliente c on c.cod=r.codCliente";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoP" type="button" class="btn btn-success" data-toggle="modal">Nuevo Vehiculo</button>    
            </div> 
        </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPago" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id</th>
                                <th>idreserva</th>
                                <th>nombre</th>
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
                                <td><?php echo $dat['idreserva'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
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
<?php 
        $consulta = "select id from reserva"; 
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        

 ?>   
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPago">    
            <div class="modal-body">
                <div class="form-group">
                <label for="id" class="col-form-label">ID:</label>
                <input type="text" class="form-control" id="id">
                </div>
                
                <div class="form-group">
                    <label for="idreserva" class="col-form-label">idReserva</label>
                    <select class="form-control" name="idreserva" id="idreserva">
                        <?php 
                        foreach($data as $dat){?>
                        <option value="<?php echo $dat['id']; ?>"> "<?php echo $dat['id']; ?>"</option>
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
