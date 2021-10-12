<div class="container">
    <h1>Contenido Clientes</h1>
     
 <?php
$consulta= new ControladorDataBase();
$data=$consulta->ctrSeleccionar("cliente");
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoC" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
</div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaClientes" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>cod</th>
                                <th>dni</th>
                                <th>nombre</th>
                                <th>direccion</th>                                 
                                <th>telefono</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['cod'] ?></td>
                                <td><?php echo $dat['dni'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['direccion'] ?></td>
                                <td><?php echo $dat['telefono'] ?></td> 
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
        <form id="formClientes">    
            <div class="modal-body">
                <div class="form-group">
                <label for="cod" class="col-form-label">COD:</label>
                <input type="text" class="form-control" id="cod" disabled>
                </div>
                <div class="form-group">
                <label for="dni" class="col-form-label">DNI:</label>
                <input type="text" class="form-control" id="dni">
                </div>                
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>  
                <div class="form-group">
                <label for="direccion" class="col-form-label">Direccion:</label>
                <input type="text" class="form-control" id="direccion">
                </div>                
                <div class="form-group">
                <label for="telefono" class="col-form-label">Telefono:</label>
                <input type="text" class="form-control" id="telefono">
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
