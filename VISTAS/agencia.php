<div class="container">
    <h1>Contenido Agencias</h1>
     
 <?php
$consulta= new ControladorDataBase();
$data=$consulta->ctrSeleccionar("agencia");
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoA" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div> 
        </div>    
</div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaAgencias" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id</th>
                                <th>ciudad</th>
                                <th>direccion</th>
                                <th>CuentaBancaria</th>
                                <th>CCI</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['ciudad'] ?></td>
                                <td><?php echo $dat['direccion'] ?></td>
                                <td><?php echo $dat['cuentaBancaria'] ?></td>
                                <td><?php echo $dat['CCI'] ?></td>
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
        <form id="formAgencias">    
            <div class="modal-body">
                <div class="form-group">
                <label for="id" class="col-form-label">id:</label>
                <input type="text" class="form-control" id="id" disabled>
                </div>
                <div class="form-group">
                <label for="ciudad" class="col-form-label">Ciudad:</label>
                <input type="text" class="form-control" id="ciudad">
                </div>
                <div class="form-group">
                <label for="direccion" class="col-form-label">Direccion:</label>
                <input type="text" class="form-control" id="direccion">
                </div>
                <div class="form-group">
                <label for="cuenta" class="col-form-label">Cuenta Bancaria:</label>
                <input type="text" class="form-control" id="cuenta">
                </div>
                <div class="form-group">
                <label for="cci" class="col-form-label">CCI:</label>
                <input type="text" class="form-control" id="cci">
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
