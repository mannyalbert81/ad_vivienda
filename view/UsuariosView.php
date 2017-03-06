      <?php include("view/modulos/head.php"); ?>
       

<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Usuarios - aDocument 2015</title>

          <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/css/jquery.js"></script>
		  <script src="view/css/bootstrapValidator.min.js"></script>
		  <script src="view/css/ValidarUsuarios.js"></script>
       
        
        
    </head>
    <body style="background-color: #F6FADE">
    
 
       <?php include("view/modulos/menu.php"); ?>
	   
	   
	    <?php
       $sel_menu = "";
       
    
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	 
       	 
       	$sel_menu=$_POST['criterio'];
       	
       	 
       }
      
	 	?>
  
    <div class="container">
      <div class="row" style="background-color: #FAFAFA;">
      
       
      <form id="form-usuarios" action="<?php echo $helper->url("Usuarios","InsertaUsuarios"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-5">
  
            
             <h4 style="color:#ec971f;">Insertar Usuarios</h4>
            	
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="nombre_usuario" class="control-label">Nombres Usuario</label>
                                  <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $resEdit->nombre_usuario; ?>"  placeholder="Nombres">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="usuario_usuario" class="control-label">Usuario</label>
                                  <input type="text" class="form-control" id="usuario_usuario" name="usuario_usuario" value="<?php echo $resEdit->usuario_usuario; ?>"  placeholder="Usuario">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
			
           <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="clave_usuario" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="clave_usuario" name="clave_usuario" value=""  placeholder="Password">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="clave_usuario_r" class="control-label">Repita Password</label>
                                  <input type="password" class="form-control" id="clave_usuario_r" name="clave_usuario_r" value=""  placeholder="Repita Password">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div> 
            
              <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="telefono_usuario" class="control-label">Teléfono Usuario</label>
                                  <input type="text" class="form-control" id="telefono_usuario" name="telefono_usuario" value="<?php echo $resEdit->telefono_usuario; ?>"  placeholder="Teléfono">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="celular_usuario" class="control-label">Celular Usuario</label>
                                  <input type="text" class="form-control" id="celular_usuario" name="celular_usuario" value="<?php echo $resEdit->celular_usuario; ?>"  placeholder="Celular">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
			
			
			<div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="correo_usuario" class="control-label">Correo Usuario</label>
                                  <input type="text" class="form-control" id="correo_usuario" name="correo_usuario" value="<?php echo $resEdit->correo_usuario; ?>"  placeholder="Correo">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		   <div class="form-group">
                                  <label for="id_rol" class="control-label">Rol </label>
                                  <select name="id_rol" id="id_rol"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultRol as $res) {?>
										<option value="<?php echo $res->id_rol; ?>" <?php if ($res->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_rol; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
            
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		   <div class="form-group">
                                  <label for="id_estado" class="control-label">Estado </label>
                                  <select name="id_estado" id="id_estado"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultEst as $res) {?>
										<option value="<?php echo $res->id_estado; ?>" <?php if ($res->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_estado; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
           
		     <?php } } else {?>
		    
		   
		   
		     <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="nombre_usuario" class="control-label">Nombres Usuario</label>
                                  <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value=""  placeholder="Nombres">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="usuario_usuario" class="control-label">Usuario</label>
                                  <input type="text" class="form-control" id="usuario_usuario" name="usuario_usuario" value=""  placeholder="Usuario">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
			
           <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="clave_usuario" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="clave_usuario" name="clave_usuario" value=""  placeholder="Password">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="clave_usuario_r" class="control-label">Repita Password</label>
                                  <input type="password" class="form-control" id="clave_usuario_r" name="clave_usuario_r" value=""  placeholder="Repita Password">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div> 
            
              <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="telefono_usuario" class="control-label">Teléfono Usuario</label>
                                  <input type="text" class="form-control" id="telefono_usuario" name="telefono_usuario" value=""  placeholder="Teléfono">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="celular_usuario" class="control-label">Celular Usuario</label>
                                  <input type="text" class="form-control" id="celular_usuario" name="celular_usuario" value=""  placeholder="Celular">
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
			
			
			<div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="correo_usuario" class="control-label">Correo Usuario</label>
                                  <input type="text" class="form-control" id="correo_usuario" name="correo_usuario" value=""  placeholder="Correo">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		   <div class="form-group">
                                  <label for="id_rol" class="control-label">Rol </label>
                                  <select name="id_rol" id="id_rol"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultRol as $res) {?>
										<option value="<?php echo $res->id_rol; ?>" ><?php echo $res->nombre_rol; ?> </option>
							    
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
            
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		   <div class="form-group">
                                  <label for="id_estado" class="control-label">Estado </label>
                                  <select name="id_estado" id="id_estado"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultEst as $res) {?>
										<option value="<?php echo $res->id_estado; ?>"><?php echo $res->nombre_estado; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
		   
		   
		       	
		     <?php } ?>
		      
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:40px">
		    <div class="form-group">
                                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
            </div>
		    </div>
		    </div>
		      
		        
          
          </form>
       
       
        <div class="col-lg-7 no_imprimir">
             <h4 style="color:#ec971f;">Lista de  Usuarios</h4>
			 
			  <form action="<?php echo $helper->url("Usuarios","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
           
           <div class="col-lg-4">
           <input type="text"  name="contenido" id="contenido" value="" class="form-control"/>
           <div id="mensaje_contenido" class="errores"></div>
            </div>
            
           <div class="col-lg-4">
           <select name="criterio" id="criterio"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" <?php if ($sel_menu == $val ) { echo "selected";}?> ><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_criterio" class="errores"></div>
           </div>
          
           
          
           <div class="col-lg-2">
           <input type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-default"/>
           </div>
           
         
          </form>
            	
        </div>
        <section class="col-lg-7 usuario no_imprimir" style="height:510px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Id</th>
	    		<th>Nombre</th>
	    		<th>Usuario</th>
	    		<th>Teléfono</th>
	    		<th>Celular</th>
	    		<th>Correo</th>
	    		<th>Rol</th>
	    		<th>Estado</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_usuario; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_usuario; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->usuario_usuario; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->telefono_usuario; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->celular_usuario; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->correo_usuario; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_rol; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_estado; ?>  </td>
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Usuarios","index"); ?>&id_usuario=<?php echo $res->id_usuario; ?>" class="btn btn-warning" style="font-size:65%;"><i class='glyphicon glyphicon-edit'></i></a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Usuarios","borrarId"); ?>&id_usuario=<?php echo $res->id_usuario; ?>" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a>
			                </div>
			                <hr/>
		               </td>
		    		</tr>
		        <?php } } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
      
      <br>
      <br>
      
      </div>
       </div>
       
       <br>
      <br>
      <br>
      <br>
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
     </body>  
    </html>   