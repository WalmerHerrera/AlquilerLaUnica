<div class="container">
    <h1>Contenido Tipo Vehiculo</h1>
     
 <?php
$consulta= new ControladorDataBase();
$data=$consulta->ctrSeleccionar("tipoVehiculo");

?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoT" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div> 
        </div>    
</div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaTipoV" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id</th>
                                <th>nombre</th>
                                <th>costoDiario</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['costoDiario'] ?></td>
                                <td>   
                                </td>  
                               
                            </tr>
                            <?php
                                }
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
        <form id="formTipoV">    
            <div class="modal-body">
                <div class="form-group">
                <label for="id" class="col-form-label">idTipo:</label>
                <input type="text" class="form-control" id="id" disabled>
                </div>
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre Tipo:</label>
                <input type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="costo" class="col-form-label">Costo Diario:</label>
                <input type="text" class="form-control" id="costo">
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
