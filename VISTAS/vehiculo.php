<center><h1>Contenido Vehiculo</h1></center>
    
     
 <?php
        $objeto = new conexion();
        $conexion = $objeto->ConectarDB();
        $consulta = "SELECT v.placa, m.nombre as modelo, ma.nombre as marca, tv.nombre as tipo, color ,tv.costoDiario,e.nombre as estado,img
            FROM `vehiculo` as v 
            inner join Modelo m on m.id=v.idModelo 
            inner join Marca ma on ma.id=m.idMarca 
            inner join tipoVehiculo tv on tv.id=v.idTipoVehiculo
            inner join estado e on e.id=v.estado";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoV" type="button" class="btn btn-success" data-toggle="modal">Nuevo Vehiculo</button>    
            </div> 
        </div> 
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"></h1>
                        <a href="pdf/reporteVehiculo.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
                    </div>
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaVehiculo" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>placa</th>
                                <th>modelo</th>
                                <th>marca</th>
                                <th>tipo</th>                                 
                                <th>color</th>
                                <th>estado</th>
                                <th>Costo Diario</th>
                                <th>img</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if($data!=null){                           
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['placa'] ?></td>
                                <td><?php echo $dat['modelo'] ?></td>
                                <td><?php echo $dat['marca'] ?></td>
                                <td><?php echo $dat['tipo'] ?></td>
                                <td><?php echo $dat['color'] ?></td> 
                                <td><?php echo $dat['estado'] ?></td> 
                                <td><?php echo $dat['costoDiario'] ?></td>
                                <td><?php echo '<img src="../imgs/'.$dat['img'].'" width="120"> '?></td>
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
        $consulta = "select id,nombre from Modelo"; 
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
        <form id="formVehiculo">    
            <div class="modal-body">
                <div class="form-group">
                <label for="placa" class="col-form-label">PLACA:</label>
                <input type="text" class="form-control" id="placa">
                </div>
                
                <div class="form-group">
                    <label for="idModelo" class="col-form-label">Modelo</label>
                    <select class="form-control" name="idModelo" id="idModelo">
                        <?php 
                        foreach($data as $dat){?>
                        <option value="<?php echo $dat['id']; ?>"> "<?php echo $dat['nombre']; ?>"</option>
                        <?php } ?>
                    </select>
                </div>                 
                <div class="form-group">
                    <label for="idTipoVehiculo" class="col-form-label">Tipo vehiculo:</label>
                    <select class="form-control" name="idTipoVehiculo" id="idTipoVehiculo">
                        <?php
                        $consulta = "select id,nombre from tipoVehiculo"; 
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();
                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $dat){?>
                        <option value="<?php echo $dat['id']; ?>"> "<?php echo $dat['nombre']; ?>"</option>
                        <?php } ?>
                    </select>
                </div>                                 
                <div class="form-group">
                    <label for="color" class="col-form-label">Color:</label>
                    <input type="text" class="form-control" name="color" id="color">
                    </div>
                <div class="form-group">
                    <label for="estado" class="col-form-label">Estado:</label>
                    <select class="form-control" name="estado" id="estado">
                        <?php
                        $consulta = "select id,nombre from estado"; 
                        $resultado = $conexion->prepare($consulta);
                        $resultado->execute();
                        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                        $conexion=null ;

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
