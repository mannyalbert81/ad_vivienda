<!DOCTYPE HTML>
<html lang="es">
     <head>
     
<?php //require_once 'config/global.php';?> 
<?php //echo json_encode($resultCli);?>
     
        <meta charset="utf-8"/>
        <title>Busqueda de Documentos - aDocument 2015</title>
   
  		
        		
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		   
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		 
		  <link rel="stylesheet" href="/resources/demos/style.css">
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script type="text/javascript" src="view/css/jquery-ui.js"></script>
        
 
 		
		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		<script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		</script>
 		
			  
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
		

	<script>
/*
		$(document).ready(function(){

		    $("#ruc_cliente_proveedor").change(function() {

		    	///obtengo el id seleccionado
				var id_cliente_proveedor = $(this).val();

	               if(id_cliente_proveedor > 0)
	               {
         		 		$('#nombre_cliente_proveedor').val( id_cliente_proveedor );//To select Blue	 
         		   }
	               else
	               {
	            		$('#nombre_cliente_proveedor').val( 0 );//To select Blue
			       }
	               
			    });

		}); 
*/
	</script>
		
		
    <script>
/*
		$(document).ready(function(){

		    $("#nombre_cliente_proveedor").change(function() {

	               
					///obtengo el id seleccionado
					var id_cliente_proveedor = $(this).val();

	               if(id_cliente_proveedor > 0)

	               {
         		 		$('#ruc_cliente_proveedor').val( id_cliente_proveedor );//To select Blue	 
         		   }
	               else
	               {
	            		$('#ruc_cliente_proveedor').val( 0 );//To select Blue
			       }
	               
			    });

		}); 
*/
	</script>		
	
	
		

	
	<script>

		$(document).ready(function(){

		    $("#fecha_documento_hasta").change(function() {

		    	return validarFecha();
		    });

		    $fecha=$('#fecha_documento_hasta');
		    if ($fecha[0].type!="date"){
		    	$fecha.attr('readonly','readonly');
		    $fecha.datepicker({
	    		changeMonth: true,
	    		changeYear: true,
	    		dateFormat: "yy-mm-dd",
	    		yearRange: "1990:2017"
	    		});
		    }

		    $fecha=$('#fecha_documento_desde');
		    if ($fecha[0].type!="date"){
		    	$fecha.attr('readonly','readonly');
		    $fecha.datepicker({
	    		changeMonth: true,
	    		changeYear: true,
	    		dateFormat: "yy-mm-dd",
	    		yearRange: "1990:2017"
	    		});
		    }

		}); 

	</script>
	
		
     <script>
			function myFunction() {
			    var x = document.getElementById("categorias").value;
                    var subcategorias = document.getElementById("subcategorias");
                    $subcategorias.Empty();
				    document.getElementById("demo").innerHTML = "You selected: " + x;
			}
		</script>
       
   <script type="text/javascript">
	$(document).ready(function(){
		
		$("#btnBuscar").click(function(){
          var datafecha= $("#fecha_documento_hasta").data();
			
	    	if(datafecha.val==0)
	    	{
		    				
	    	load_DocumentosClienteProv(1);
			
	    	}else
	    	{
	    		datafecha.val=0;
	    	}
	    	
			
			});
	});

	
	function load_DocumentosClienteProv(pagina){

		
		//iniciar variables
		 var doc_categorias=$("#categorias").val();
		 var doc_subcategorias=$("#subcategorias").val();
		 var doc_ruc_cli=$("#txt_ruc_cliente_proveedor").val();
		 var doc_nombre_cli=$("#txt_nombre_cliente_proveedor").val();
		 var doc_id_agencias=$("#id_agencias").val();
		 var doc_id_sucursales=$("#id_sucursales").val();
		 var doc_id_regionales=$("#id_regionales").val();
		 var doc_numero_comprobantes=$("#numero_comprobantes").val();

		 
		 var doc_fecha_doc_desde=$("#fecha_documento_desde").val();
		 var doc_fecha_doc_hasta=$("#fecha_documento_hasta").val();
		 var doc_fecha_subida_desde=$("#fecha_subida_desde").val();
		 var doc_fecha_subida_hasta=$("#fecha_subida_hasta").val();
		 var doc_year=$("#year").val();

		 
		 	
		  var con_datos={
				  categorias:doc_categorias,
				  subcategorias:doc_subcategorias,
				  txt_ruc_cliente_proveedor:doc_ruc_cli,
				  txt_nombre_cliente_proveedor:doc_nombre_cli,
				  id_agencias:doc_id_agencias,
				  id_sucursales:doc_id_sucursales,
				  id_regionales:doc_id_regionales,
				  numero_comprobantes:doc_numero_comprobantes,
				  fecha_documento_desde:doc_fecha_doc_desde,
				  fecha_documento_hasta:doc_fecha_doc_hasta,
				  fecha_subida_desde:doc_fecha_subida_desde,
				  fecha_subida_hasta:doc_fecha_subida_hasta,
				  year:doc_year,
				  action:'ajax',
				  page:pagina
				  };


		$("#DocumentosClienteProv").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("DocumentosClienteProveedor","buscar");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#DocumentosClienteProv").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){

				
				$(".DocumentosClienteProv").html(data).fadeIn('slow');
				$("#DocumentosClienteProv").html("");

				resetfecha();
			}
		})
	}
	
	</script>
	
	 <script>
	 /*
	$(document).ready(function(){
 	
	$("#txt_nombre_cliente_proveedor").autocomplete({
		source: "<?php echo $helper->url("DocumentosClienteProveedor","AutocompleteNombreCliente"); ?>",
		minLength: 1,
		select: function( event, data ) 
			{
			 var respueta = data.item.id;
			 var res = respueta.split(',');
			 
			 $("#nombre_cliente_proveedor").val(res[0]);
			 $("#ruc_cliente_proveedor").val(res[0]);
			 
             $("#txt_nombre_cliente_proveedor").val(data.item.value);
             $("#txt_ruc_cliente_proveedor").val(res[1]);
	            //alert(data);
			}
	 });
		
	$("#txt_nombre_cliente_proveedor").focusout(function(){

		if($("#txt_nombre_cliente_proveedor").val()==''||$("#txt_nombre_cliente_proveedor").val()==null)
		{
			 $("#nombre_cliente_proveedor").val(0);
			 $("#ruc_cliente_proveedor").val(0);
			 $("#txt_nombre_cliente_proveedor").val('');
	         $("#txt_ruc_cliente_proveedor").val('');
			 
		}
						
	});
						
	});
		*/
					
    </script>
    
    <script>
    /*
	$(document).ready(function(){
 	
	$("#txt_ruc_cliente_proveedor").autocomplete({
		source: "<?php echo $helper->url("DocumentosClienteProveedor","AutocompleteRucCliente"); ?>",
		minLength: 1,
		select: function( event, data ) 
		{
		 var respueta = data.item.id;
		 var res = respueta.split(',');
		 
		 $("#nombre_cliente_proveedor").val(res[0]);
		 $("#ruc_cliente_proveedor").val(res[0]);
		 
         $("#txt_nombre_cliente_proveedor").val(res[1]);
         $("#txt_ruc_cliente_proveedor").val(data.item.value);
            //alert(data);
		}
	 });
		
	$("#txt_ruc_cliente_proveedor").focusout(function(){

		if($("#txt_ruc_cliente_proveedor").val()==''||$("#txt_ruc_cliente_proveedor").val()==null)
		{
			 $("#nombre_cliente_proveedor").val(0);
			 $("#ruc_cliente_proveedor").val(0);
			 $("#txt_nombre_cliente_proveedor").val('');
	         $("#txt_ruc_cliente_proveedor").val('');
	            //alert(data);
			 
		}
						
	});
	});
		
		*/			
    </script>
       
        <script>
        /*
	       	$(document).ready(function(){ 	
				$( "#numero_comprobantes" ).autocomplete({
      				source: "<?php echo $helper->url("DocumentosClienteProveedor","AutocompleteNumeroComprobantes"); ?>",
      				minLength: 1
    			});
	
    		});
*/
     </script>
     
     <script type="text/javascript">
	function validarFecha()
	{
		    var startDate = new Date($('#fecha_documento_desde').val());
	    	var endDate = new Date($('#fecha_documento_hasta').val());
			var datafecha= $("#fecha_documento_hasta").data();

			if (startDate > endDate){

	    		$("#fecha_documento_hasta").val("");
	    		datafecha.val=1;
	    		alert('Fecha documento DESDE mayor a  fecha FINAL');	    		
	    	}else
	    	{
	    		datafecha.val=0;
	    	}

	    	var fecha_actual = new Date();
	    	
	    	if (endDate > fecha_actual){

	    		$("#fecha_documento_hasta").val("");
	    		datafecha.val=1;
	    		alert('Fecha documento mayor a fecha actual');
	    		
	    	}else
	    	{
	    		datafecha.val=0;
	    	}
	    	
	    }

	 function resetfecha()
	    {
	    	$('#fecha_documento_desde').val("");
	    	$('#fecha_documento_hasta').val("");
	    }
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
 
 
       <?php include("view/modulos/head.php"); ?>
     
       
       <?php include("view/modulos/menu.php"); ?>
   <?php
   
		   $sel_categorias = 0;
		   $sel_subcategorias = 0;
		   $sel_year = 0;
		   $sel_cliente_proveedor = 0;
		   $sel_agencias = 0;
		   $sel_sucursales = 0;
		   $sel_regionales = 0;
		   //$sel_tipo_documentos = 0;
		   //$sel_carton_documentos = 0;
		   //$sel_numero_poliza = 0;
		   //$sel_cierre_ventas_soat = 0; 
		   $sel_fecha_documento_desde = "";
		   $sel_fecha_documento_hasta = "";
		   $sel_fecha_subida_desde = "";
		   $sel_fecha_subida_hasta = "";
		   
		   if($_SERVER['REQUEST_METHOD']=='POST' )
		   {
		      $sel_categorias = $_POST['categorias'];
		      $sel_subcategorias = $_POST['subcategorias'];
		      $sel_year = $_POST['year'];
		      //$sel_cliente_proveedor = $_POST['nombre_cliente_proveedor'];
		      $sel_agencias = $_POST['id_agencias'];
		      $sel_sucursales = $_POST['id_sucursales'];
		      $sel_regionales = $_POST['id_regionales'];
		      //$sel_tipo_documentos = $_POST['tipo_documentos'];
		      //$sel_carton_documentos = $_POST['carton_documentos'];
		      //$sel_numero_poliza = $_POST['numero_poliza'];
		      //$sel_cierre_ventas_soat = $_POST['cierre_ventas_soat'];
		      $sel_fecha_documento_desde = $_POST['fecha_documento_desde'];
		      $sel_fecha_documento_hasta = $_POST['fecha_documento_hasta'];
		      $sel_fecha_subida_desde = $_POST['fecha_subida_desde'];
		      $sel_fecha_subida_hasta = $_POST['fecha_subida_hasta'];
		      
		
		   }
		   
		?>
		
    <div class="container">
      <div class="row" style="background-color: #FAFAFA;">
      
      <form id="formularioPrincipal" action="<?php echo $helper->url("Documentos","index"); ?>" method="post" class="form-horizontal">
        
     
      <div class="panel panel-default">

		  <div class="panel-heading"> <strong style="color:#ec971f;"> BUSQUEDA DE DOCUMENTOS </strong>  </div>
		  <div class="panel-body">
		    <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
		  	  <p   class="bg-danger" style="text-align: center;" ><strong>ESTAMOS EDITANDO </strong> Los cambios realizados seran guardados en el registro : <strong>   <?php echo $resEdit->id_documentos_legal ?>  </strong> </p>
		  	  <input  type="hidden" id="id_documentos_legal" name="id_documentos_legal" value= "<?php echo $resEdit->id_documentos_legal ?>" > 
  	        <?php } }?>
  	      
  	      </div>

     <div class="table-responsive">
     
    
       	<table class="table">     	
            	
            <tr>

	    		<th class="col-sm-2">Nombre Categoría</th>
	    		<th class="col-sm-2">Nombre SubCategoría</th>
	    		<th class="col-sm-2">Año</th>
	    		<th class="col-sm-2">Identificación Cliente</th>
	    		<th >Nombre Cliente</th>
	    		

	    		

	    	
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
		
				<td>	       		
		          <select name="year" id="year"  class="form-control">
							<option value="0"  > --TODOS--</option>
				        <?php ?>
				        <?php for($i = date ("Y") ; $i > 1899 ; $i --) {?>
				         	<?php if ($sel_year > 0){?>
				         			<option value="<?php echo $i; ?>" <?php if ($i == $sel_year) {echo "selected"; }  ?>  ><?php echo $i; ?> </option>
				         		<?php  } else { ?>
				         			<option value="<?php echo $i; ?>" ><?php echo $i; ?> </option>
						    	<?php }  ?>
						    <?php } ?>
					   		    
	     			     		</select>
		   		</td>
		
		   		<td>
		   		<input type="hidden"  id="ruc_cliente_proveedor" name="ruc_cliente_proveedor" value="0">
                 	  
		   		
		   		 <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
					        	<?php foreach($resultCli as $resCli) {?>
										<input type="text" class="form-control" id="txt_ruc_cliente_proveedor" name="txt_ruc_cliente_proveedor" value="<?php if ($resCli->id_cliente_proveedor == $resEdit->id_cliente_proveedor )  echo  $resCli->ruc_cliente_proveedor; ?>">
                 			  <?php } ?>
					     <?php } } else {?>
					     
					     <input type="text" class="form-control" id="txt_ruc_cliente_proveedor" name="txt_ruc_cliente_proveedor" value=""  placeholder="Ingrese Identificación">
                 		  									
						 <?php } ?>
						      		
           	 		
           		</td>
		
		   		<td>
		   		    <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
					       	<?php foreach($resultCli as $resCli) {?>
					       	<input type="text" class="form-control" id="txt_nombre_cliente_proveedor" name="txt_nombre_cliente_proveedor" value="<?php if ($resCli->id_cliente_proveedor == $resEdit->id_cliente_proveedor )  echo  $resCli->nombre_cliente_proveedor; ?>">
                 			
						   <?php } ?>
						  <?php } } else {?>	
						  					 
						  <input type="text" class="form-control" id="txt_nombre_cliente_proveedor" name="txt_nombre_cliente_proveedor" value=""  placeholder="Ingrese Nombre">
                 		  
						 <?php } ?>
				         <input type="hidden"  id="nombre_cliente_proveedor" name="nombre_cliente_proveedor" value="0">		 
					 
					<?php unset($resultCli);
						  unset($resCli);?>
		   		</td>
		
		   	   		
		   	</tr>
		
			
        </table>
      
	  
		<table class="table">
      
      
            <tr>
	    		
	    		 <th>Comprobante</th>
	    		
	    		<th >Regionales</th>
	    		<th >Sucursales</th>
	    		<th >Agencias</th>
	    		<th >Fecha Documento Desde</th>
	    		<th >Fecha Documento Hasta</th>
	    		<th ></th>
	    		
	    		
	    		
	  		</tr>
            
            <tr>
            
     
				            <td>
			    <input type="text"  class="form-control" id="numero_comprobantes" name="numero_comprobantes" placeholder="Comprobante" >
            </td>
            
            	<td>
	            <select name="id_regionales" id="id_regionales"  class="form-control"   >
	                <option value="0"  > --TODOS--</option>
			    	 <?php foreach($resultReg as $res) {?>
					 		<?php if ($sel_regionales > 0){?>
					 			<option value="<?php echo $res->id_regionales; ?>"  <?php if ($res->id_regionales == $sel_regionales) {echo "selected"; }  ?>     > <?php echo $res->nombre_regionales; ?> </option>
					 		
					 		<?php  } else { ?>
					 			
					 			<option value="<?php echo $res->id_regionales; ?>"  > <?php echo $res->nombre_regionales; ?> </option>
					 		
					 		<?php }  ?>
	 		
				 	 <?php } ?>
				</select>
				</td>
            	
            	
            	<td>
	            <select name="id_sucursales" id="id_sucursales"  class="form-control"   >
	                <option value="0"  > --TODOS--</option>
			    	 <?php foreach($resultSuc as $res) {?>
					 		<?php if ($sel_sucursales > 0){?>
					 			<option value="<?php echo $res->id_sucursales; ?>"  <?php if ($res->id_sucursales == $sel_sucursales) {echo "selected"; }  ?>     > <?php echo $res->nombre_sucursales; ?> </option>
					 		
					 		<?php  } else { ?>
					 			
					 			<option value="<?php echo $res->id_sucursales; ?>"  > <?php echo $res->nombre_sucursales; ?> </option>
					 		
					 		<?php }  ?>
	 		
				 	 <?php } ?>
				</select>
				</td>
				
				<td>
	            <select name="id_agencias" id="id_agencias"  class="form-control"   >
	                <option value="0"  > --TODOS--</option>
			    	 <?php foreach($resultAgen as $res) {?>
					 		<?php if ($sel_agencias > 0){?>
					 			<option value="<?php echo $res->id_agencias; ?>"  <?php if ($res->id_agencias == $sel_agencias) {echo "selected"; }  ?>     > <?php echo $res->nombre_agencias; ?> </option>
					 		
					 		<?php  } else { ?>
					 			
					 			<option value="<?php echo $res->id_agencias; ?>"  > <?php echo $res->nombre_agencias; ?> </option>
					 		
					 		<?php }  ?>
	 		
				 	 <?php } ?>
				</select>
				</td>
				
				



	 
            	<td>
            	
            	  <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
						
						<input type="date" name="fecha_documento_desde" id="fecha_documento_desde"  class="form-control"  value="<?php echo $resEdit->fecha_documentos_legal ?>"     /> 	
						    
				  <?php } } else {?>
				   		
				   		<input type="date" name="fecha_documento_desde" id="fecha_documento_desde"  class="form-control"   />
						        
				  <?php } ?>
		
            	
		   			
		   		</td>
		   		<td>
		   			<input type="date" data-val="0" name="fecha_documento_hasta"  id="fecha_documento_hasta"  class="form-control"  />
		   		</td>
		   		
		   		
		   		
		   		<td>  	
		        	<?php if ($resultEdit !="" ) { ?>
		  	  			<input type="submit" value="Guardar" id="btnGuardar" name="btnGuardar" class="btn btn-success"/>
  	                <?php } else {?>
  	                	<input type="button" value="Buscar" id="btnBuscar" name="btnBuscar" class="btn btn-info"/>
  	                <?php } ?>
		        	
		        	
		        	
		        	
				</td>

     	</tr>
      
      	</table>
	  
	  
	  
	  
      	
      
      
      
      
      	</div>
        </div>  
      

     <hr/> 
     
     <!-- paginacion ajax -->
        
        <div style="height: 200px; display: block;">
		
		 <h4 style="color:#ec971f;"></h4>
			  <div >					
					<div id="DocumentosClienteProv" style="text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="DocumentosClienteProv" ></div><!-- Datos ajax Final -->
		      </div>
		       <br>
				  
		 </div>
        
        
        <input type="hidden" name="fecha_subida_desde" id="fecha_subida_desde"  class="form-control"   />
						        
				   
		   			<input type="hidden" name="fecha_subida_hasta" id="fecha_subida_hasta" class="form-control"  />
		   		
      <!--termina paginacion ajax -->
     

      <?php /*?>
       <section class="col-sm-12" style="height:400px;overflow-y:scroll;">
    
    
	    <table>
		    <tr> 
		    	<th> 
		    	</th>
		    </tr>
	    </table>
	    
	  
	    <table class="table">
	         <tr>
	    		<th>Id</th>
	    		<th>Fecha del Documento</th>
	    		<th>Categoria</th>
	    		<th>Subcategoria</th>
	    		<th>Tipo Documentos</th>
	    		<th>Cliente/Proveedor</th>
	    		<th>Carton Documentos</th>
	    		<th>Numero Credito</th>
	    		<th>Fecha de Subida</th>
	    		<th></th>
	    		<th></th>
	    		
	  		</tr>
            <?php// echo $resul  ?>
			<?php  $paginas =   0;  ?>
		    <?php  $registros = 0; ?>
	  		<?php if ($resultSet !="") { foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_documentos_legal; ?>  </td>
	                   <td> <?php echo $res->fecha_documentos_legal; ?>  </td>
		               <td> <?php echo $res->nombre_categorias; ?>     </td> 
		               <td> <?php echo $res->nombre_subcategorias; ?>  </td>
		               <td> <?php echo $res->nombre_tipo_documentos; ?>     </td>
		               <td> <?php echo $res->nombre_cliente_proveedor; ?>     </td>
		               <td> <?php echo $res->numero_carton_documentos; ?>     </td>
		    	       <td> <?php echo $res->numero_credito_documentos_legal; ?>     </td>
		    	       
		    	       <td> <?php echo $res->creado; ?>     </td>
		            		 <?php  $paginas = $paginas + $res->paginas_documentos_legal;  ?>
		                     <?php  $registros = $registros + 1 ; ?>
		    
		                 <td>
			           		<div class="right">
			            
			                  <?php  if ($_SESSION["tipo_usuario"]=="usuario_local") {  ?>
			            		 	  <a href=" <?php echo IP_INT . $res->id_documentos_legal; ?>  " class="btn btn-warning" target="blank">Ver</a>
			            		 <?php } else {?>
			            		 	  <a href="<?php echo IP_EXT . $res->id_documentos_legal; ?>  " class="btn btn-warning" target="blank">Ver</a> 
			            		 <?php }?>
			                           
			                </div>
			            
			             </td>
			             <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Documentos","index"); ?>&id_documentos_legal=<?php echo $res->id_documentos_legal; ?>" class="btn btn-info">Editar</a>
			            
			                </div>
			            
			             </td>
			             
		    		</tr>
		  		
		           	  
		        <?php } ?>
		</table>      		
		    		
		<table class="table">
				<th class="text-center">
				    	<nav>
						  <ul id="pagina" name="pagina" class="pagination">
						    <?php if ($paginasTotales > 0) {?>
						    <?php for ($i = 1; $i< $paginasTotales+1; $i++)  { ?>
						    		<input type="submit" value="<?php echo $i; ?>" id="pagina"  <?php if ($i == $pagina_actual ) { echo 'style="color: #1454a3 " '; }  ?>     name="pagina" class="btn btn-info"/>
						    	
						    <?php    } }?>
						    
						  </ul>
						</nav>	   	   
			
				</th>
				<tr class="bg-primary">
						<p class="text-center"> <strong> Registros Cargados: <?php echo  $registros?> Hojas Cargadas: <?php echo $paginas?> Registros Totales: <?php echo  $registrosTotales?> Hojas Totales: <?php echo $hojasTotales?> </strong>  </p>
	     		  	
				</tr>			
		</table>
		 	
 				<?php  }   else { ?>
		        <?php }  ?>
      </section>       
    <?php */?>
      
       </form>
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