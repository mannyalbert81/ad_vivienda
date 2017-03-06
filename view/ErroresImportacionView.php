<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        	
   
   
  
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
  
  
	      <form action="<?php echo $helper->url("ErroresImportacion","index"); ?>" method="post" class="col-lg-12">
     
     	<div class="row">
		  <div class="col-sm-4 col-md-4">
				<h5> Seleccione el Origen: </h5>
		        <select name="origen" id="origen"  class="form-control"   >
	                <option value="ORD"  > ORDINEM</option>
	                <option value="MDI"  > MUNDO DIGITAL</option>
				</select>
				<input type="submit" value="Buscar" id="btnBuscar" name="btnBuscar" class="btn btn-info"/>
		
		  </div>
		  <div class="col-sm-4 col-md-4">
	    	
		  </div>
		  <div class="col-sm-4 col-md-4">
		    
		  </div>
		</div>
    </form>

    <div class="container">
      <div class="row" style="background-color: #FAFAFA;">
      
      <form action="<?php echo $helper->url("ClienteProveedor","Update"); ?>" method="post" class="col-lg-12">
     
     	 <section class="col-sm-12" style="height:400px;overflow-y:scroll;">
    
    
	    
	    <table class="table">
	         <tr>
	    		<th>Id</th>
	    		<th>Funcion Error</th>
	    		<th>Detalle Error</th>
	    		<th>Creado</th>
	  		</tr>
         	
		    <?php  $registros = 0; ?>
	  		<?php if ($resultSet !="") { foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_errores_importacion; ?>  </td>
	                   <td> <?php echo $res->funcion_errores_importacion; ?>  </td>
		               <td> <?php echo $res->error_errores_importacion; ?>     </td> 
		               <td> <?php echo $res->creado; ?>     </td>
		            	       <?php  $registros = $registros + 1 ; ?>
		            	       
		    
		        </tr>
		    <?php }}?>
		    
		        <tr class="bg-primary">
						<p class="text-center"> <strong> Registros Cargados: <?php echo  $registros?>  </strong>  </p>
	     		  	
				</tr>	        
							    
		</table>      		

 				
      </section>       
    
      <hr>                
	  <hr>                
 	  </form>
	  <hr>
	  <hr>
       </div>
       </div>
      <hr>
	  <hr>
	  
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer> 
     </body>  
    </html>          