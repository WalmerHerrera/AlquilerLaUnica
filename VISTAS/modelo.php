<div class="container">
    <h1>Contenido Modelo</h1>
     
 <?php
        $objeto = new conexion();
        $conexion = $objeto->ConectarDB();
        $consulta = "SELECT m.id, m.nombre as modelo, ma.nombre as marca
            FROM `Modelo` as m 
            inner join Marca ma on ma.id=m.idMarca ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoMo" type="button" class="btn btn-success" data-toggle="modal">Nuevo Vehiculo</button>    
            </div> 
        </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaModelos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id</th>
                                <th>nodelo</th>
                                <th>marca</th>
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
                                <td><?php echo $dat['modelo'] ?></td>
                                <td><?php echo $dat['marca'] ?></td>
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
        $consulta = "select id,nombre from Marca"; 
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $conexion=null ;

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
        <form id="formModelos">    
            <div class="modal-body">
                <div class="form-group">
                <label for="id" class="col-form-label">id</label>
                <input type="text" class="form-control" id="id" disabled>
                </div>
                <div>
                <label for="nombre" class="col-form-label">nombre: </label>
                <input type="text" class="form-control" id="nombre">
                </div>

                <div class="form-group">
                    <label for="marca" class="col-form-label">Marca:</label>
                    <select class="form-control" name="cbo_marca" id="cbo_marca">
                        <option value="0">seleccionar marca</option>
                        <?php 
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
