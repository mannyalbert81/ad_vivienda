     <?php include("view/modulos/head.php"); ?>

<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Permisos Rol - aDocument 2015</title>
   <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/css/jquery.js"></script>
		  <script src="view/css/bootstrapValidator.min.js"></script>
		  <script src="view/css/ValidarPermisosRoles.js"></script>
  
		
      <script>
        
       $(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#id_controladores").change(function() {

               // obtenemos el combo de subcategorias
                var $id_acciones = $("#id_acciones");
               // lo vaciamos
               
				///obtengo el id seleccionado
				

               var id_controladores = $(this).val();


               $id_acciones.empty();

               $id_acciones.append("<option value= " +"0" +" > --TODOS--</option>");
           
               if(id_controladores > 0)
               {
            	   var datos = {
            			   id_controladores : $(this).val()
                   };


            	   $.post("<?php echo $helper->url("PermisosRoles","devuelveAcciones"); ?>", datos, function(resultAcc) {

            		 		$.each(resultAcc, function(index, value) {
               		 	    $id_acciones.append("<option value= " +value.id_acciones +" >" + value.nombre_acciones  + "</option>");	
                       		 });

            		 		 	 		   
            		  }, 'json');


               }
               else
               {
            	   $.post("<?php echo $helper->url("PermisosRoles","devuelveAllAcciones"); ?>", datos, function(resultAcc) {

   		 		        $.each(resultAcc, function(index, value) {
          		 	    $id_acciones.append("<option value= " +value.id_acciones +" >" + value.nombre_acciones  + "</option>");	
                	  });
     		  		}, 'json');

               }
               
		    });
    
		}); 

	</script>
		
	<script>

		$(document).ready(function(){

			$("#id_acciones").change(function() {

	               // obtenemos el combo de categorias
	                var $id_controladores = $("#id_controladores");
	               
					///obtengo el id seleccionado
					var id_acciones = $(this).val();

	               if(id_acciones > 0)

	               {
	            	   var datos = {
	            			   id_acciones : $(this).val()
	                   };


	            	   //$categorias.append("<option value= " +"0" +" >"+ id_subcategorias  +"</option>");
	                   $.post("<?php echo $helper->url("PermisosRoles","devuelveSubByAcciones"); ?>", datos, function(resultAcc) {
	            		   
         		 		  $.each(resultAcc, function(index, value) {
         		 			$('#id_controladores').val( value.id_controladores );//To select Blue	 
 								
							 });

         		 		 	 		   
         		  		}, 'json');
	                   
	               }
	               else
	               {

	          		 $('#controladres').val( 0 );//To select Blue

			        }
	               
	               
			    });
		}); 

	</script>
       
       
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
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
      
      <form id="form-Permisos-Roles" action="<?php echo $helper->url("PermisosRoles","InsertaPermisosRoles"); ?>" method="post" class="col-lg-5">
           
           
		  
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
             
              	<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Actualizar Permisos Roles</h4>
	         </div>
	         <div class="panel-body">	
	         
	         
	        <div class="row">
		    <div class="col-xs-12 col-md-12">
		    <div class="form-group">
                                  <label for="nombre_permisos_rol" class="control-label">Nombre Permisos Rol:</label>
                                  <input type="text" class="form-control" id="nombre_permisos_rol" name="nombre_permisos_rol" value="<?php echo $resEdit->nombre_permisos_rol; ?>"  placeholder="Nombre Permiso Rol">
                                  <span class="help-block"></span>
            </div>
		    </div>
		     </div>
	         
	            	
	       <div class="row">  
		   <div class="col-xs-12 col-md-12">
		   <div class="form-group">
                                  <label for="id_rol" class="control-label">Rol: </label>
                                  <select name="id_rol" id="id_rol"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultRol as $res) {?>
										<option value="<?php echo $res->id_rol; ?>" <?php if ($res->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_rol; ?> </option>
							    
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
		    </div> 
		    
		    
		   <div class="row">  
		   <div class="col-xs-12 col-md-12">
		   <div class="form-group">
                                  <label for="id_controladores" class="control-label">Nombre Controladores: </label>
                                  <select name="id_controladores" id="id_controladores"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultCon as $res) {?>
										<option value="<?php echo $res->id_controladores; ?>" <?php if ($res->id_controladores == $resEdit->id_controladores )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_controladores; ?> </option>
							    
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
		    </div>   	
	            	
	            	
	            	
	            	
		   		   
	            	
		   		   
		   		   <table class="table">
		   		   	<tr>
		   		   		<th style="width: 33.3%" > Ver</th>
		   		   		<th style="width: 33.3%"> Editar</th>
		   		   		<th style="width: 33.3%"> Borrar</th>
		   		   	</tr>
		   		   	<tr>
					  <td> 
		   		   		<select name="ver_permisos_rol" id="ver_permisos_rol"  class="form-control">
										<option value="TRUE"  <?php  if ( $resEdit->ver_permisos_rol =='t')  echo ' selected="selected" ' ; ?> >Permitir </option>
						            	<option value="FALSE" <?php  if ( $resEdit->ver_permisos_rol =='f')  echo ' selected="selected" ' ; ?> >Denegar </option>
					    </select>
		   		   		</td>
		   		   		<td> 
		   		   		<select name="editar_permisos_rol" id="editat_permisos_rol"  class="form-control">
										<option value="TRUE"  <?php  if ( $resEdit->editar_permisos_rol =='t')  echo ' selected="selected" ' ; ?>>Permitir </option>
						            	<option value="FALSE" <?php  if ( $resEdit->editar_permisos_rol =='f')  echo ' selected="selected" ' ; ?>  >Denegar </option>
					    </select>
					    </td>
		   		   		<td>
		   		   		<select name="borrar_permisos_rol" id="borrar_permisos_rol"  class="form-control">
										<option value="TRUE"  <?php  if ( $resEdit->borrar_permisos_rol =='t')  echo ' selected="selected" ' ; ?> >Permitir </option>
						            	<option value="FALSE" <?php  if ( $resEdit->borrar_permisos_rol =='f')  echo ' selected="selected" ' ; ?>  >Denegar </option>
					    </select>
		   		   		</td>
		   		
		   		   	</tr>
		   		   </table>
		   		   
		   		   
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:40px">
		    <div class="form-group">
                                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Actualizar</button>
                                
            </div>
		    </div>
		    </div>
		   		   
		   		   
		   		   </div>
		   		   </div>
		    
		     <?php } } else {?>
		    
		     		
		     <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Insertar Permisos Roles</h4>
	         </div>
	         <div class="panel-body">
		     		
		     <div class="row">
		    <div class="col-xs-12 col-md-12">
		    <div class="form-group">
                                  <label for="nombre_permisos_rol" class="control-label">Nombre Permisos Rol:</label>
                                  <input type="text" class="form-control" id="nombre_permisos_rol" name="nombre_permisos_rol" value=""  placeholder="Nombre Permiso Rol">
                                  <span class="help-block"></span>
            </div>
		    </div>
		     </div>
		     
		    <div class="row">  
		   <div class="col-xs-12 col-md-12">
		   <div class="form-group">
                                  <label for="id_rol" class="control-label">Rol: </label>
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
		   <div class="col-xs-12 col-md-12">
		   <div class="form-group">
                                  <label for="id_controladores" class="control-label">Nombre Controladores: </label>
                                  <select name="id_controladores" id="id_controladores"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultCon as $res) {?>
										<option value="<?php echo $res->id_controladores; ?>" ><?php echo $res->nombre_controladores; ?> </option>
							    
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
		    </div> 
		    
		    
		   		   
		    	   <table class="table">
		   		   	<tr>
		   		   		<th style="width: 33.3%"> Ver</th>
		   		   		<th style="width: 33.3%"> Editar</th>
		   		   		<th style="width: 33.3%"> Borrar</th>
		   		   	</tr>
		   		   	<tr>
		   		   		<td> 
		   		   		<select name="ver_permisos_rol" id="ver_permisos_rol"  class="form-control">
										<option value="TRUE"  >Permitir </option>
						            	<option value="FALSE"  >Denegar </option>
					    </select>
		   		   		</td>
		   		   		<td> 
		   		   		<select name="editar_permisos_rol" id="editat_permisos_rol"  class="form-control">
										<option value="TRUE"  >Permitir </option>
						            	<option value="FALSE"  >Denegar </option>
					    </select>
					    </td>
		   		   		<td>
		   		   		<select name="borrar_permisos_rol" id="borrar_permisos_rol"  class="form-control">
										<option value="TRUE"  >Permitir </option>
						            	<option value="FALSE"  >Denegar </option>
					    </select>
		   		   		</td>
		   		   	</tr>
		   		   </table>
		   		   
		   		   
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:40px">
		    <div class="form-group">
                                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
                                
            </div>
		    </div>
		    </div>
		   		   
		   		   
		   		   </div>
		   		   </div>
		        
		     <?php } ?>
		        
          
          </form>
      
      
      
       
       
       
           
            <form action="<?php echo $helper->url("PermisosRoles","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-7">
           
            <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Lista de  Permisos Rol</h4>
	         </div>
	         <div class="panel-body">
           
           
           <div class="col-lg-4">
           <input type="text"  name="contenido" id="contenido" value="" class="form-control"/>
           <div id="mensaje_contenido" class="errores"></div>
            </div>
            
           <div class="col-lg-4">
           <select name="criterio" id="criterio"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" <?php if ($sel_menu == $val ) { echo "selected";}?>><?php echo $desc; ?> </option>
                                    <?php } ?>
									
									
                                        
           </select>
           <div id="mensaje_criterio" class="errores"></div>
           </div>
          
           
          
           <div class="col-lg-2">
            <button type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-primary"/><span class="glyphicon glyphicon-search" ></span></button>
          
           </div>
           </div></div>
         
          </form>
        
        <div class="panel-body">
        <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr class="info">
	    		<th style="text-align: left;  font-size: 13px;">Id</th>
	    		<th style="text-align: left;  font-size: 13px;">Nombre Permisos Rol</th>
	    		<th style="text-align: left;  font-size: 13px;">Nombre Rol</th>
	    		<th style="text-align: left;  font-size: 13px;">Nombre Controlador</th>
	    		<th style="text-align: left;  font-size: 13px;">Ver</th>
	    		<th style="text-align: left;  font-size: 13px;">Editar</th>
	    		<th style="text-align: left;  font-size: 13px;">Borrar</th>
	    		<th style="text-align: left;  font-size: 13px;"></th>
	    		<th style="text-align: left;  font-size: 13px;"></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="font-size: 11px;"> <?php echo $res->id_permisos_rol; ?>  </td>
		               <td style="font-size: 11px;"> <?php echo $res->nombre_permisos_rol; ?>     </td>
		               <td style="font-size: 11px;"> <?php echo $res->nombre_rol; ?>     </td> 
		               <td style="font-size: 11px;"> <?php echo $res->nombre_controladores; ?>  </td>
		               <td style="font-size: 11px;"> <?php if ($res->ver_permisos_rol =="t"){ echo "Si";}else{echo "No";}; ?>     </td>
		               <td style="font-size: 11px;"> <?php if ($res->editar_permisos_rol == "t"){ echo "Si";}else{echo "No";}; ?>     </td>
		               <td style="font-size: 11px;"> <?php if ($res->borrar_permisos_rol == "t"){ echo "Si";}else{echo "No";}; ?>     </td>
		           	   <td style="font-size: 11px;">
			           		<div class="right">
			                    <a href="<?php echo $helper->url("PermisosRoles","index"); ?>&id_permisos_rol=<?php echo $res->id_permisos_rol; ?>" class="btn btn-warning" style="font-size:65%;"><i class='glyphicon glyphicon-edit'></i></a>
			                </div>
			            
			             </td>
			             <td style="font-size: 11px;">   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("PermisosRoles","borrarId"); ?>&id_permisos_rol=<?php echo $res->id_permisos_rol; ?>" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a>
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
       </div>
       
       <br>
        <br>
         <br>
          <br>
           <br>
       
      </div>
       </div>
       
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
     </body>  
    </html>   