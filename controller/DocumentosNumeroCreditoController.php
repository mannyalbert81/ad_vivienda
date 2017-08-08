<?php
class DocumentosNumeroCreditoController extends ControladorBase{
	public function __construct() {
		parent::__construct();
	}
	public function index(){
		session_start();
		
		$_SESSION['categorias'] = "";
		$_SESSION['subcategorias'] = "";
		$_SESSION['numero_credito'] = "";
		$_SESSION['fecha_documento_desde'] = "";
		$_SESSION['fecha_documento_hasta'] = "";
		$_SESSION['year'] = "";
			
		
		$documentos_legal = new DocumentosLegalModel();
		
		if (isset(  $_SESSION['usuario_usuario']) )
		{
			$nombre_controladores = "Documentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos_legal->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
				$registrosTotales = 0;
				$hojasTotales = 0;
					
					// Categorias
				$categorias=new CategoriasModel();
				$resultCat=$categorias->getAll("nombre_categorias");
				
				
				$subcategorias=new SubCategoriasModel();
				$resultSub=$subcategorias->getAll("nombre_subcategorias");
				
				
				
				$resultPol = $documentos_legal->getCondiciones("numero_credito_documentos_legal", "documentos_legal", "numero_credito_documentos_legal !='' GROUP BY numero_credito_documentos_legal", "numero_credito_documentos_legal");
				
		         
				//documentos Legl
				
				
				$resultEdit = "";
				$resul = "";
		
				if (isset ($_GET["id_documentos_legal"])   )
				{
					$nombre_controladores = "Documentos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $documentos_legal->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
					if (!empty($resultPer))
					{
						$_id_documentos_legal = $_GET["id_documentos_legal"];
						$resultEdit = $documentos_legal->getBy("id_documentos_legal = '$_id_documentos_legal'     ");
						
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar a Documentos"
					
						));
					
						exit();
					}
						
				}
			
				if (isset ($_POST["categorias"]) && isset ($_POST["subcategorias"])  && isset($_POST["numero_credito"])  && isset($_POST["fecha_documento_desde"]) && isset($_POST["fecha_documento_hasta"])       )
				
				{
					$_SESSION['categorias'] = $_POST["categorias"];
					$_SESSION['subcategorias'] = $_POST["subcategorias"];
					$_SESSION['numero_credito'] = $_POST["numero_credito"];
					$_SESSION['fecha_documento_desde'] = $_POST["fecha_documento_desde"];
					$_SESSION['fecha_documento_hasta'] = $_POST["fecha_documento_hasta"];
					$_SESSION['year'] = $_POST["year"];
					///creo el array con los valores seleccionados
		
					
					$arraySel = "";
				    $columnas = "documentos_legal.id_documentos_legal,  documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, soat.cierre_ventas_soat,   documentos_legal.creado, documentos_legal.numero_credito_documentos_legal, referencia.nombre_referencia , tipo_comprobantes.nombre_tipo_comprobantes, comprobantes.numero_comprobantes , detalle_documentos.nombre_detalle_documentos, regionales.nombre_regionales, sucursales.nombre_sucursales  "; 
					$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor, public.soat, public.referencia, public.tipo_comprobantes , public.comprobantes, public.detalle_documentos, public.sucursales, public.agencias, public.regionales";
					$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor   AND documentos_legal.id_soat = soat.id_soat  AND documentos_legal.id_referencia = referencia.id_referencia AND documentos_legal.id_tipo_comprobantes = tipo_comprobantes.id_tipo_comprobantes AND documentos_legal.id_comprobantes = comprobantes.id_comprobantes AND documentos_legal.id_detalle_comprobantes = detalle_documentos.id_detalle_documentos AND documentos_legal.id_regionales = regionales.id_regionales AND documentos_legal.id_sucursales = sucursales.id_sucursales AND documentos_legal.id_agencias = agencias.id_agencias ";
					$id       = "documentos_legal.fecha_documentos_legal, carton_documentos.numero_carton_documentos";
						
					
					$documentos = new DocumentosLegalModel();
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
					$where_8 = "";
					$where_9 = "";
					$where_10 = "";
					$where_11 = "";
					$where_12 = "";
					$where_13 = "";
						
					
					
					$_id_categorias = $_POST["categorias"];
					$_id_subcategorias = $_POST["subcategorias"];
					$_numero_credito  = $_POST["numero_credito"];
					$_year     = 	$_POST["year"];
					
					$_fecha_documento_desde = $_POST["fecha_documento_desde"];
					$_fecha_documento_hasta = $_POST["fecha_documento_hasta"];
					$_fecha_subida_desde = $_POST["fecha_subida_desde"];
					$_fecha_subida_hasta = $_POST["fecha_subida_hasta"];
						
		        	if ($_id_categorias > 0)
					{
		
						$where_1 =  " AND categorias.id_categorias = '$_id_categorias' ";
						
					}
					
					if ($_id_subcategorias > 0)
					{
					
						$where_2 = " AND subcategorias.id_subcategorias = '$_id_subcategorias' ";
					
					}
					if ($_numero_credito > 0)
					{
						
						$where_4 = " AND documentos_legal.numero_credito_documentos_legal = '$_numero_credito' ";
					}	
					if ($_fecha_documento_desde != "" && $_fecha_documento_hasta != "")
					{
						$where_8 = " AND documentos_legal.fecha_documentos_legal BETWEEN '$_fecha_documento_desde' AND '$_fecha_documento_hasta'  ";
					}
		
					if ($_fecha_subida_desde != "" && $_fecha_subida_hasta != "")
					{
						$where_9 = " AND documentos_legal.creado BETWEEN '$_fecha_subida_desde' AND '$_fecha_subida_hasta'  ";
					}
					
					$where_to  = $where . $where_1 . $where_2 . $where_3 . $where_4  . $where_8 . $where_9 . $where_10. $where_11. $where_12. $where_13;
					
					//Conseguimos todos los usuarios
					
					//$resul = $where_to;
					$resultSet=$documentos->getCondiciones($columnas ,$tablas ,$where_to, $id);
					
					foreach($resultSet as $res) 
					{
						$hojasTotales =  $hojasTotales + $res->paginas_documentos_legal;
						$registrosTotales = $registrosTotales + 1 ;
					}
					
			}
			else 
			{
			//$arraySel = array();
				$registrosTotales = 0;
				$hojasTotales = 0;
					
			
			$arraySel = "";
			$resultSet = "";
			}
		
		
			///aqui va la paginacion  ///
			$articulosTotales = 0;
			$paginasTotales = 0;
			$paginaActual = 0;
			
			if(isset($_POST["pagina"])){
				
				// en caso que haya datos, los casteamos a int
				$paginaActual = (int)$_POST["pagina"];
			}
				
			
			if ($resultSet != "")
			{
					
					foreach($resultSet as $res)
					{
						$articulosTotales = $articulosTotales + 1;
					}
						
						
					$articulosPorPagina = 50;
						
					$paginasTotales = ceil($articulosTotales / $articulosPorPagina);
				
						
					// el número de la página actual no puede ser menor a 0
					if($paginaActual < 1){
						$paginaActual = 1;
					}
					else if($paginaActual > $paginasTotales){ // tampoco mayor la cantidad de páginas totales
						$paginaActual = $paginasTotales;
					}
						
					// obtenemos cuál es el artículo inicial para la consulta
					$articuloInicial = ($paginaActual - 1) * $articulosPorPagina;
						
					//agregamos el limit
					$limit = " LIMIT   '$articulosPorPagina' OFFSET '$articuloInicial'";
						
					//volvemos a pedir el resultset con la pginacion
						
					$resultSet=$documentos->getCondicionesPag($columnas ,$tablas ,$where_to,  $id, $limit );
						
					
			
			}
			
			
				$this->view("DocumentosNumeroCredito",array(
						"resultCat"=>$resultCat, "resultSub"=>$resultSub, "resultPol"=>$resultPol, "resultSet"=>$resultSet, "arraySel"=>$arraySel, "resultEdit"=>$resultEdit, "resul"=>$resul  , "paginasTotales"=>$paginasTotales, "registrosTotales"=> $registrosTotales,"hojasTotales"=>$hojasTotales, "pagina_actual"=>$paginaActual
					 
							));
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Acceso a Busqueda de Documentos 1 "
				));
				exit();
		}
				
				
		}
		else 
		{
	
				$this->view("ErrorSesion",array(
					"resultSet"=>""
						));
				
		}
	
	}
			
		
	public function buscar()
	{
		require_once 'config/global.php';
	
		session_start();
	
		$documentos_legal = new DocumentosLegalModel();
	
		if (isset(  $_SESSION['usuario_usuario']) )
		{
			$nombre_controladores = "Documentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos_legal->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
				if (isset ($_POST["categorias"]) && isset ($_POST["subcategorias"])  && isset($_POST["txt_numero_credito"])  && isset($_POST["fecha_documento_desde"]) && isset($_POST["fecha_documento_hasta"])  && isset($_POST["fecha_subida_desde"])  && isset($_POST["fecha_subida_hasta"])   )
				{						
	
					$arraySel = "";
					$columnas = "documentos_legal.id_documentos_legal,  documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, soat.cierre_ventas_soat,   documentos_legal.creado, documentos_legal.numero_credito_documentos_legal, referencia.nombre_referencia , tipo_comprobantes.nombre_tipo_comprobantes, comprobantes.numero_comprobantes , detalle_documentos.nombre_detalle_documentos, regionales.nombre_regionales, sucursales.nombre_sucursales, agencias.nombre_agencias  "; 
					$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor, public.soat, public.referencia, public.tipo_comprobantes , public.comprobantes, public.detalle_documentos, public.sucursales, public.agencias, public.regionales";
					$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor   AND documentos_legal.id_soat = soat.id_soat  AND documentos_legal.id_referencia = referencia.id_referencia AND documentos_legal.id_tipo_comprobantes = tipo_comprobantes.id_tipo_comprobantes AND documentos_legal.id_comprobantes = comprobantes.id_comprobantes AND documentos_legal.id_detalle_comprobantes = detalle_documentos.id_detalle_documentos AND documentos_legal.id_regionales = regionales.id_regionales AND documentos_legal.id_sucursales = sucursales.id_sucursales AND documentos_legal.id_agencias = agencias.id_agencias ";
					$id       = "documentos_legal.fecha_documentos_legal, carton_documentos.numero_carton_documentos";
					
						
					$documentos = new DocumentosLegalModel();
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
					$where_8 = "";
					$where_9 = "";
					$where_10 = "";
					$where_11 = "";
					$where_12 = "";
					$where_13 = "";
					
						
					$_id_categorias = $_POST["categorias"];
					$_id_subcategorias = $_POST["subcategorias"];
					$_numero_credito  = $_POST["txt_numero_credito"];
					
					
					
					$_year            = $_POST["year"];
						
					$_fecha_documento_desde = $_POST["fecha_documento_desde"];
					$_fecha_documento_hasta = $_POST["fecha_documento_hasta"];
					$_fecha_subida_desde = $_POST["fecha_subida_desde"];
					$_fecha_subida_hasta = $_POST["fecha_subida_hasta"];
					
					if ($_id_categorias > 0)
					{
					
						$where_1 =  " AND categorias.id_categorias = '$_id_categorias' ";
					
					}
						
					if ($_id_subcategorias > 0)
					{
							
						$where_2 = " AND subcategorias.id_subcategorias = '$_id_subcategorias' ";
							
					}
					if ($_numero_credito != "")
					{
					    
						$where_4 = " AND documentos_legal.numero_credito_documentos_legal LIKE '$_numero_credito' ";
					}
					else 
					{
						//$_numero_credito = 'NOXZY';
						//$where_4 = " AND documentos_legal.numero_credito_documentos_legal = '$_numero_credito' ";
					}
					if ($_fecha_documento_desde != "" && $_fecha_documento_hasta != "")
					{
						$where_8 = " AND DATE(documentos_legal.fecha_documentos_legal) BETWEEN '$_fecha_documento_desde' AND '$_fecha_documento_hasta'";
					}
					
					if($_fecha_documento_desde != "" && $_fecha_documento_hasta == ""){
					
						$_fecha_documento_hasta='2018/01/01';
						$where_8 = " AND DATE(documentos_legal.fecha_documentos_legal) BETWEEN '$_fecha_documento_desde' AND '$_fecha_documento_hasta'  ";
					
					}
						
						
					if($_fecha_documento_desde == "" && $_fecha_documento_hasta != ""){
							
						$_fecha_documento_desde='1800/01/01';
						$where_8 = " AND DATE(documentos_legal.fecha_documentos_legal) BETWEEN '$_fecha_documento_desde' AND '$_fecha_documento_hasta'  ";
							
					}
					
					if ($_fecha_subida_desde != "" && $_fecha_subida_hasta != "")
					{
						$where_9 = " AND DATE(documentos_legal.creado) BETWEEN '$_fecha_subida_desde' AND '$_fecha_subida_hasta'  ";
					}
					if ($_year >0)
					{
						
						$where_10 = "  AND TO_CHAR(documentos_legal.fecha_documentos_legal,'YYYY') = '$_year' ";
					}	
						
					$where_to  = $where . $where_1 . $where_2 . $where_3 . $where_4  . $where_8 . $where_9 . $where_10. $where_11. $where_12. $where_13;
						
					//Conseguimos todos los usuarios
	
					//$resul = $where_to;
					//$resultSet=$documentos->getCondiciones($columnas ,$tablas ,$where_to, $id);
					$resultSet=$documentos->getCantidad("*", $tablas, $where_to);
						
					$html="";
					$cantidadResult=0;
						
					$cantidadResult=(int)$resultSet[0]->total;
						
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
						
					if($action == 'ajax')
					{
	
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	
						$per_page = 10; //la cantidad de registros que desea mostrar
						$adjacents  = 10; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
	
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
	
	
						$resultSet=$documentos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
						$count_query   = $cantidadResult;
						$total_pages = ceil($cantidadResult/$per_page);
	
						
						if ($cantidadResult>0)
						{
							
							$html.='<div class="pull-left">';
							$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
							$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
							$html.='</div><br>';
							$html.='<section style="height:700px;  overflow-y:auto;">';
							$html.='<table class="table table-hover">';
							$html.='<thead>';
							$html.='<tr class="info">';
							$html.='<th style="text-align: left;  font-size: 10px;">Id</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Fecha</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Subcategoría</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Tipo Documentos</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Cliente</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Carpeta</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Crédito</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Comprobante</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Páginas</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Referencia</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Tipo Comprobante</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Regionales</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Sucursales</th>';
							$html.='<th style="text-align: left;  font-size: 10px;">Agencias</th>';
							$html.='<th style="text-align: left;  font-size: 10px;"></th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
							
							foreach ($resultSet as $res)
							{
								$html.='<tr>';
								$html.='<td style="font-size: 9px;">'.$res->id_documentos_legal.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->fecha_documentos_legal.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->nombre_subcategorias.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->nombre_tipo_documentos.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->nombre_cliente_proveedor.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->numero_carton_documentos.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->numero_credito_documentos_legal.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->numero_comprobantes.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->paginas_documentos_legal.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->nombre_referencia.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->nombre_tipo_comprobantes.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->nombre_regionales.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->nombre_sucursales.'</td>';
								$html.='<td style="font-size: 9px;">'.$res->nombre_agencias.'</td>';
								$html.='<td style="font-size: 9px;">';
									
								if ($_SESSION["tipo_usuario"]=="usuario_local") {
									$html.='<a href="'.IP_INT . $res->id_documentos_legal.'" class="btn btn-warning" target="blank" style="font-size:90%;">Ver</a>';
								} else {
									$html.=' <a href="'.IP_EXT . $res->id_documentos_legal.'" class="btn btn-warning" target="blank" style="font-size:90%;">Ver</a>';
								}
								$html.='</td>';
								$html.='</tr>';
								
							}
							
							$html.='</tbody>';
							$html.='</table>';
							$html.='</section>';
							$html.='<div class="table-pagination pull-right">';
							$html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents).'';
							$html.='</div>';
							$html.='</section>';
							
								
	
						}else{
	
							$html.='<div class="alert alert-warning alert-dismissable">';
							$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
							$html.='<h4>Aviso!!!</h4> No hay datos para mostrar';
							$html.='</div>';
	
						}
	
						echo $html;
							
	
					}
						
	
				}
	
			}
		}
	}
	
	
	//<input type="button" id="btnBuscar" name="btnBuscar" value="Buscar" class="btn btn-warning " />
	
	public function paginate($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_DocumentosNumeroCred(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_DocumentosNumeroCred(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_DocumentosNumeroCred(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_DocumentosNumeroCred(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_DocumentosNumeroCred(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_DocumentosNumeroCred($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_DocumentosNumeroCred(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
	public function AutocompleteNumeroCredito(){
	
		session_start();
	
		$numero_credito = strtoupper($_GET['term']);
		$_numero_credito = array();
		
		$documentos_legal = new DocumentosLegalModel();
	
	
		//Tipo de Documento
		$resultPol = $documentos_legal->getCondiciones("numero_credito_documentos_legal",
				"documentos_legal", 
				"numero_credito_documentos_legal LIKE '$numero_credito%' GROUP BY numero_credito_documentos_legal",
				"numero_credito_documentos_legal");
		
	
		if(!empty($resultPol)){
	
			foreach ($resultPol as $res){
	
				$_numero_credito[] = array('id' => $res->numero_credito_documentos_legal, 'value' => $res->numero_credito_documentos_legal);
			}
			//echo json_encode($_ruc_cliente);
				
		}else
		{
			//echo json_encode(array(array('id' =>'0,NO DATA', 'value' =>'NO DATA')));
			$_numero_credito = array(array('id' =>'--TODOS--', 'value' =>'--TODOS--'));
		}
	
		echo  json_encode($_numero_credito);
	}
		
	
	
	
}
?>