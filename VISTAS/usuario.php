<div class="container">
    <h1>Tabla de Usuarios</h1>
     
 <?php
$consulta= new ControladorDataBase();
$data=$consulta->ctrSeleccionar("USUARIO");
?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoU" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
</div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id</th>
                                <th>nombre</th>
                                <th>Apellidos</th>
                                <th>correo</th>                                 
                                <th>telefono</th>
                                <th>usuario</th>
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
                                <td><?php echo $dat['Apellidos'] ?></td>
                                <td><?php echo $dat['correo'] ?></td>
                                <td><?php echo $dat['telefono'] ?></td> 
                                <td><?php echo $dat['usuario'] ?></td>
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
        <form id="formUsuarios">    
            <div class="modal-body">
                <div class="form-group">
                <label for="id" class="col-form-label">id:</label>
                <input type="text" class="form-control" id="id" disabled>
                </div>                 
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>  
                <div class="form-group">
                <label for="direccion" class="col-form-label">Apellidos</label>
                <input type="text" class="form-control" id="Apellidos">
                </div>   
                <div class="form-group">
                <label for="direccion" class="col-form-label">correo:</label>
                <input type="text" class="form-control" id="correo">
                </div> 
                <div class="form-group">
                <label for="telefono" class="col-form-label">telefono:</label>
                <input type="text" class="form-control" id="telefono">
                </div>              
                <div class="form-group">
                <label for="usuario" class="col-form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario">
                </div>
                <div class="form-group">
                <label for="usuario" class="col-form-label">Contraseña:</label>
                <input type="text" class="form-control" id="contraseña">
                </div>              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardarV" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div> 
    
</div>
