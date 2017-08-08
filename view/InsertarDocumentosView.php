<?php include("view/modulos/head.php"); ?>

<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Actualizar Documentos - aDocument 2015</title>
            
       
		<script >
		$(document).ready(function(){
		    // cada vez que se cambia el valor del combo
		    $("#categorias").change(function() {
               // obtenemos el combo de subcategorias
                var $subcategorias = $("#subcategorias");
               // lo vaciamos
               
				///obtengo el id seleccionado
				
               var id_categorias = $(this).val();
               $subcategorias.empty();
               $subcategorias.append("<option value= " +"0" +" > --TODOS--</option>");
           
               if(id_categorias > 0)
               {
            	   var datos = {
            			   id_categorias : $(this).val()
                   };
            	   $.post("<?php echo $helper->url("subCategorias","devuelveSubcategorias"); ?>", datos, function(resultSub) {
            		 		$.each(resultSub, function(index, value) {
               		 	    $subcategorias.append("<option value= " +value.id_subcategorias +" >" + value.nombre_subcategorias  + "</option>");	
                       		 });
            		 		 	 		   
            		  }, 'json');
               }
               else
               {
            	   $.post("<?php echo $helper->url("subCategorias","devuelveAllSubcategorias"); ?>", datos, function(resultSub) {
   		 		        $.each(resultSub, function(index, value) {
          		 	    $subcategorias.append("<option value= " +value.id_subcategorias +" >" + value.nombre_subcategorias  + "</option>");	
                	  });
     		  		}, 'json');
               }
               
		    });
    
		}); 
	</script>
		
	<script>
		$(document).ready(function(){
			$("#subcategorias").change(function() {
	               // obtenemos el combo de categorias
	                var $categorias = $("#categorias");
	               
					///obtengo el id seleccionado
					var id_subcategorias = $(this).val();
	               if(id_subcategorias > 0)
	               {
	            	   var datos = {
	            			   id_subcategorias : $(this).val()
	                   };
	            	   //$categorias.append("<option value= " +"0" +" >"+ id_subcategorias  +"</option>");
	                   $.post("<?php echo $helper->url("subCategorias","devuelveSubBySubcategorias"); ?>", datos, function(resultSub) {
	            		   
         		 		  $.each(resultSub, function(index, value) {
         		 			 $('#categorias').val( value.id_categorias );//To select Blue	 
         		 			//$("'#categorias > option[value="+value.id_categorias"+"]').attr('selected', 'selected'");
								
							 });
         		 		 	 		   
         		  		}, 'json');
	                   
	               }
	               else
	               {
	          		 $('#categorias').val( 0 );//To select Blue
			        }
	               
	               
			    });
		}); 
	</script>
		
         
    </head>
    <body   style="background-color: #F6FADE">
    
      	       <?php
   
		   $sel_categorias = 0;
		   $sel_subcategorias = 0;
		   
		   $sel_numero_credito = 0;
		   
		   if($_SERVER['REQUEST_METHOD']=='POST' )
		   {
		      $sel_categorias = $_POST['categorias'];
		      $sel_subcategorias = $_POST['subcategorias'];
		     
		   }
		   else 
		   {
		
		   	
		   }
		   
		?>
      	 
       
       <?php include("view/modulos/menu.php"); ?>
  
  
  		    
        <div class="container">
  
  		<div class="table-responsive">
     
    <form action="<?php echo $helper->url("Documentos","InsertarDocumentos"); ?>" enctype="multipart/form-data"  method="post" class="col-lg-12">
       	<table class="table">     	
            	
            <tr>
	    		<th class="col-sm-2 ">Nombre Categoría</th>
	    		<th class="col-sm-2">Nombre SubCategoría</th>
	    		
	    		
	    	
	  		</tr>
            <tr>
	            <td>
	            <select name="categorias" id="categorias"  class="form-control"   >
	                <option value="0"  > --TODOS--</option>
			    	 <?php foreach($resultCat as $resCat) {?>
					 		<?php if ($sel_categorias > 0){?>
					 			<option value="<?php echo $resCat->id_categorias; ?>"  <?php if ($resCat->id_categorias == $sel_categorias) {echo "selected"; }  ?>     > <?php echo $resCat->nombre_categorias; ?> </option>
					 		
					 		<?php  } else { ?>
					 			
					 			<option value="<?php echo $resCat->id_categorias; ?>"  > <?php echo $resCat->nombre_categorias; ?> </option>
					 		
					 		<?php }  ?>
	 		
				 	 <?php } ?>
				</select>
						        
				</td>				  
		
				<td>	       		
		          <select name="subcategorias" id="subcategorias"  class="form-control">
							<option value="0"  > --TODOS--</option>
				        <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
				        	<?php foreach($resultSub as $resSub) {?>
								<option value="<?php echo $resSub->id_subcategorias; ?>" <?php if ($resSub->id_subcategorias == $resEdit->id_subcategorias )  echo  ' selected="selected" '  ;  ?> ><?php echo $resSub->nombre_subcategorias; ?> </option>
						    <?php } ?>
					   		    
	     			     <?php } } else {?>
			
				    	 <?php foreach($resultSub as $resSub) {?>
					 		<?php if ($sel_subcategorias > 0){?>
					 				<option value="<?php echo $resSub->id_subcategorias;?>"  <?php if ($resSub->id_subcategorias == $sel_subcategorias) {echo "selected"; }  ?>     > <?php echo $resSub->nombre_subcategorias; ?> </option>
					 			<?php  } else { ?>
					 				<option value="<?php echo $resSub->id_subcategorias;?>" > <?php echo $resSub->nombre_subcategorias; ?> </option>
					 			<?php }  ?>
	 				 	 	<?php } ?>
						<?php } ?>
					</select>
		   		</td>
		
			</tr>	
	
	
			    <tr>
	    		<th class="col-sm-2 ">Archivo PDF</th>
	    		<th class="col-sm-2">Archivo XML</th>
	    		
	    		
	    	
	  		</tr>
            <tr>
				   <td> <input type="file" class="form-control" id="archivo_pdf" accept="application/pdf" name="archivo_pdf"/>
		           </td>
		           <td> <input type="file" class="form-control" id="archivo_xml" accept="text/xml" name="archivo_xml"/>
		           </td>
		
			</tr>	
					
        </table>
        
        <table class="table">
    	    	<tr>
            		
            	</tr>
        		<tr>
				   		<td> <button type="submit"name="btnInsertar" class="btn btn-success">Insertar</button></td>
		           
		           
		           
	            </tr>
           	
		    </table>
    
    
    
    	<table class="table">     	
        
            <tr>
	    		<th class="col-sm-2 ">CONTENIDO DEL INDICE</th>
	    		
	    		
	    		
	    	
	  		</tr>
            	
            <tr>
	    		<td>
		 		<?php 
		 		   if (!empty($contenidoXML)) {
		 			foreach($contenidoXML as $posicion=>$jugador)
		 			{
		 				echo "El " . $posicion . " es " . $jugador;
		 				echo "<br>";
		 			}
		 		
		 		   }
		 		?>
	    		</td>
	    	
	  		</tr>
            				
        </table>
    
    
       </form>     
      
      	
      	</div>
    
  	   </div>
       
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
     </body>  
    </html>   