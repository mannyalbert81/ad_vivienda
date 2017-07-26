<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        <title>Roles - aDocument 2015</title>
   
      
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
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
  
    <div class="container">
      <div class="row" style="background-color: #FAFAFA;">
      
      <form action="<?php echo $helper->url("Roles","InsertaRoles"); ?>" method="post" class="col-lg-5">
            
            	
		   		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Editar Roles</h4>
	         </div>
	         <div class="panel-body">
	        
	        <div class="row">
		    <div class="col-xs-12 col-md-12">
		    <div class="form-group">
                                  <label for="nombre_rol" class="control-label">Nombre Rol:</label>
                                  <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" value="<?php echo $resEdit->nombre_rol; ?>"  placeholder="Nombre Rol">
                                  <span class="help-block"></span>
            </div>
		    </div>
		     </div>
	        
	               
		            
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:40px">
		    <div class="form-group">
                                   <input type="submit" value="Actualizar" class="btn btn-success"/>
            </div>
		    </div>
		    </div>
		            
		            
		      </div>
		      </div>      
            
		     <?php } } else {?>
		     
		       <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Insertar Roles</h4>
	         </div>
	         <div class="panel-body">
		    
		     <div class="row">
		    <div class="col-xs-12 col-md-12">
		    <div class="form-group">
                                  <label for="nombre_rol" class="control-label">Nombre Rol:</label>
                                  <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" value=""  placeholder="Nombre Rol">
                                  <span class="help-block"></span>
            </div>
		    </div>
		     </div>
		       
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:40px">
		    <div class="form-group">
                                   <input type="submit" value="Guardar" class="btn btn-success"/>
            </div>
		    </div>
		    </div>
		       
		       </div>
		      </div>       
		     <?php } ?>
		        
          
          </form>
       
       
        <div class="col-lg-7">
         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Roles de Usuario</h4>
	         </div>
	         </div>
		 </div>
           <div class="panel-body">
        <section class="col-lg-7" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr class="info">
	    		<th style="text-align: left;  font-size: 13px;">Id</th>
	    		<th style="text-align: left;  font-size: 13px;">Nombre Rol</th>
	    		<th style="text-align: left;  font-size: 13px;"></th>
	    		<th style="text-align: left;  font-size: 13px;"></th>
	    	
	  		</tr>
            
	            <?php foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="font-size: 11px;"> <?php echo $res->id_rol; ?>  </td>
		               <td style="font-size: 11px;"> <?php echo $res->nombre_rol; ?>     </td> 
		               
		               <td style="font-size: 11px;">
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Roles","index"); ?>&id_rol=<?php echo $res->id_rol; ?>" class="btn btn-warning" style="font-size:65%;"><i class='glyphicon glyphicon-edit'></i></a>
			                </div>
			            
			             </td>
			             <td style="font-size: 11px;">   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Roles","borrarId"); ?>&id_rol=<?php echo $res->id_rol; ?>" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a>
			                </div>
			                
		               </td>
		    		</tr>
		        <?php } ?>
            
            
            
       	</table>     
      </section>
        </div>
  </div></div>
       
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
        
     </body>  
    </html>          