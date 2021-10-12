<div class="container">
    <h1>Contenido Devolucion</h1>
     
 <?php
    $objeto = new conexion();
    $conexion = $objeto->ConectarDB();
    $consulta = "SELECT `id`, `idAlquiler`, `horaD`, `daños`, `faltantes`, `cosDaño`, `cosFaltante` FROM `devolucion` WHERE 1";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoD" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
</div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaDevolucion" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id</th>
                                <th>idAlquiler</th>
                                <th>horaD</th>
                                <th>daños</th>                                 
                                <th>faltantes</th>
                                <th>cosDaño</th>
                                <th>cosFaltante</th>
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
                                <td><?php echo $dat['idAlquiler'] ?></td>
                                <td><?php echo $dat['horaD'] ?></td>
                                <td><?php echo $dat['daños'] ?></td>
                                <td><?php echo $dat['faltantes'] ?></td> 
                                <td><?php echo $dat['cosDaño'] ?></td>
                                <td><?php echo $dat['cosFaltante'] ?></td>
                                <td> </td> 
                               
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
        <form id="formDevolucion">    
            <div class="modal-body">
                <div class="form-group">
                <label for="id" class="col-form-label">id:</label>
                <input type="text" class="form-control" id="id" disabled>
                </div>
                <div class="form-group">
                    <label for="idAlquiler" class="col-form-label">idAlquiler</label>
                    <select class="form-control" name="idAlquiler" id="idAlquiler">
                        <?php 
                        $consulta = "SELECT `id` FROM `Alquiler` WHERE 1"; 
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();
                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $dat){?>
                        <option value="<?php echo $dat['id']; ?>"> "<?php echo $dat['id']; ?>"</option>
                        <?php } ?>
                    </select>
                </div> 
                <div class="form-group">
                <label for="horaD" class="col-form-label">horaDevolucion:</label>
                 <input type="datetime-local" class="form-control"  id="horaD">
                </div>               
                <div class="form-group">
                <label for="daños" class="col-form-label">daños:</label>
                <input type="text" class="form-control" id="daños">
                </div>  
                <div class="form-group">
                <label for="faltantes" class="col-form-label">faltantes:</label>
                <input type="text" class="form-control" id="faltantes">
                </div>                
                <div class="form-group">
                <label for="cosDaño" class="col-form-label">costo Daño:</label>
                <input type="text" class="form-control" id="cosDaño">
                </div>  
                <div class="form-group">
                <label for="cosFaltante" class="col-form-label">costo Faltante:</label>
                <input type="text" class="form-control" id="cosFaltante">
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
