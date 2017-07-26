<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        <title>Cartones de Documentos - aDocument 2015</title>
   
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
      <body  style="background-color: #F6FADE">
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
       
       
        <?php
       $sel_numero_carton_documentos = "";
       
    
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	 
       	 
       	$sel_numero_carton_documentos=$_POST['numero_carton_documentos'];
       	
       	 
       }
      
	 	?>
  
    <div class="container">
      <div class="row" style="background-color: #FAFAFA;">
      
      <form action="<?php echo $helper->url("Documentos","BuscaxCarton"); ?>" method="post" class="col-lg-3">
           
            
            
              <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Búsqueda Contenido de Carpetas</h4>
	         </div>
	         <div class="panel-body">
            
             <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12">
		    <div class="form-group">
                                  <label for="numero_carton_documentos" class="control-label">Número:</label>
                                  <input type="text" class="form-control" id="numero_carton_documentos" name="numero_carton_documentos" value="<?php echo $sel_numero_carton_documentos;?>"  placeholder="Número Carpetas">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    </div>
            
		    
		    
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:2px">
		    <div class="form-group">
                                  <button type="submit" id="Buscar" name="Buscar" class="btn btn-primary"><span class="glyphicon glyphicon-search" ></span></button>
            </div>
		    </div>
		    </div>
		        
          
  
    
  			<?php  $paginas =   0;  ?>
		    <?php  $registros = 0; ?>
		    <?php  $numero_carton_documentos = 0; ?>
	  		<?php if ($resultSet !="") { foreach($resultSet as $res) {?>
	        		
		                 <?php $numero_carton_documentos =  $res->numero_carton_documentos; ?>     
		    	       
		            		 <?php  $paginas = $paginas + $res->paginas_documentos_legal;  ?>
		                     <?php  $registros = $registros + 1 ; ?>
		        <?php } ?>
				   <table class="table">
				        <tr>
				    		<th>Resúmen del Cartón: <?php echo $numero_carton_documentos  ?>    </th>
				  		</tr>
			    		<tr>
			    			<td> <p class="text-justify">  <strong> Se encontraton <?php echo $registros?> documentos, los cuales contienen un total de <?php echo $paginas ?> páginas.  </strong> Recuerde revisar estos documentos antes de imprimir el reporte final </p> </td>
			    		</tr>
	
      	
			     	</table>
  	
  	
  	 		<div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:2px">
		    <div class="form-group">
                                   <a href="<?php echo $helper->url("Documentos","ReportexCarton"); ?>&numero_carton_documentos=<?php echo $numero_carton_documentos; ?>" class="btn btn-success" target="blank">Imprimir Reporte</a>
	  		
            </div>
		    </div>
		    </div>
  	
  	        
			
			
			<?php    }   else {?>
		        
		            
		        <?php }  ?>
            
  </div></div>
         
       </form>
       
       
        
       
        <section class="col-lg-9 usuario" style="height:485px;overflow-y:scroll;">
	    <table class="table table-hover">
	         <tr class="info">
	    		<th style="text-align: left;  font-size: 13px;">Id</th>
	    		<th style="text-align: left;  font-size: 13px;">Fecha del Documento</th>
	    		<th style="text-align: left;  font-size: 13px;">Categoría</th>
	    		<th style="text-align: left;  font-size: 13px;">Subcategoría</th>
	    		<th style="text-align: left;  font-size: 13px;">Comprobante</th>
	    		<th style="text-align: left;  font-size: 13px;">Identificación Cliente</th>
	    		<th style="text-align: left;  font-size: 13px;">Nombre Cliente</th>
	    		
	    		<th style="text-align: left;  font-size: 13px;">Páginas </th>
	    		
	    		<th style="text-align: left;  font-size: 13px;"></th>
	    		<th style="text-align: left;  font-size: 13px;"></th>
	    		
	  		</tr>
            
			<?php  $paginas =   0;  ?>
		    <?php  $registros = 0; ?>
		    <?php  $numero_carton_documentos = 0; ?>
	  		<?php if ($resultSet !="") { foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="font-size: 11px;"> <?php echo $res->id_documentos_legal; ?>  </td>
	                   <td style="font-size: 11px;"> <?php echo $res->fecha_documentos_legal; ?>  </td>
		               <td style="font-size: 11px;"> <?php echo $res->nombre_categorias; ?>     </td> 
		               <td style="font-size: 11px;"> <?php echo $res->nombre_subcategorias; ?>  </td>
		               <td style="font-size: 11px;"> <?php echo $res->numero_comprobantes; ?>     </td>
		               <td style="font-size: 11px;"> <?php echo $res->ruc_cliente_proveedor; ?>     </td>
		               <td style="font-size: 11px;"> <?php echo $res->nombre_cliente_proveedor; ?>     </td>
		               <?php $numero_carton_documentos =  $res->numero_carton_documentos; ?>     
		    	       <td style="font-size: 11px;"> <?php echo $res->paginas_documentos_legal; ?>     </td>
		    	       
		            		 <?php  $paginas = $paginas + $res->paginas_documentos_legal;  ?>
		                     <?php  $registros = $registros + 1 ; ?>
		    
		                 <td style="font-size: 11px;">
			           		<div class="right">
			            
			                    <?php  if ($_SESSION["tipo_usuario"]=="usuario_local") {  ?>
			            		 	    <a href=" <?php echo IP_INT . $res->id_documentos_legal; ?>  " class="btn btn-warning" target="blank" style="font-size:95%;">Ver</a>
			            		 <?php } else {?>
			            		 	    <a href=" <?php echo IP_INT . $res->id_documentos_legal; ?>  " class="btn btn-warning" target="blank" style="font-size:95%;">Ver</a>
			            		 <?php }?>
			                    
			                </div>
			            
			             </td>
			             <!--  
			             <td style="font-size: 11px;">
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Documentos","index"); ?>&id_documentos_legal=<?php echo $res->id_documentos_legal; ?>" class="btn btn-info"><i class='glyphicon glyphicon-edit'></i></a>
			            
			                </div>
			            
			             </td>
			             -->
		    		</tr>
		    		
		           	  
		        <?php } ?>

				<?php    }   else {?>
		        
		            
		        <?php }  ?>
            
       	</table>
           
        
      </section>
      
    
    <br>
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