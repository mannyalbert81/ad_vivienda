 <?php

class DocumentosClienteProveedorController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){

		session_start();
		
		$documentos_legal = new DocumentosLegalModel();
		
		if (isset(  $_SESSION['usuario_usuario']) )
		{
			$nombre_controladores = "Documentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos_legal->getPermisosVer("  controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
				$registrosTotales = 0;
				$hojasTotales = 0;
					
					// Categorias
				$categorias=new CategoriasModel();
				$resultCat=$categorias->getAll("nombre_categorias");
				
				
				$agencias=new AgenciasModel();
				$columnas_agen="agencias.id_agencias, agencias.nombre_agencias";
				$tablas_agen=" public.agencias, 
                               public.documentos_legal";
				$where_agen="documentos_legal.id_agencias = agencias.id_agencias GROUP BY agencias.nombre_agencias, agencias.id_agencias";
				$id_agen="agencias.nombre_agencias";
				$resultAgen=$agencias->getCondiciones($columnas_agen, $tablas_agen, $where_agen, $id_agen);
				
				
				$sucursales=new SucursalesModel();
				$columnas_suc="sucursales.id_sucursales, 
                               sucursales.nombre_sucursales";
				$tablas_suc="public.documentos_legal, 
                               public.sucursales";
				$where_suc="documentos_legal.id_sucursales = sucursales.id_sucursales GROUP BY sucursales.id_sucursales, sucursales.nombre_sucursales";
				$id_suc="sucursales.nombre_sucursales";
				$resultSuc=$sucursales->getCondiciones($columnas_suc, $tablas_suc, $where_suc, $id_suc);
				
				
				$regionales=new RegionalesModel();
				$columnas_reg="regionales.id_regionales, 
                                regionales.nombre_regionales";
				$tablas_reg="public.documentos_legal, 
                             public.regionales";
				$where_reg="regionales.id_regionales = documentos_legal.id_regionales GROUP BY regionales.id_regionales, regionales.nombre_regionales";
				$id_reg="regionales.nombre_regionales";
				$resultReg=$regionales->getCondiciones($columnas_reg, $tablas_reg, $where_reg, $id_reg);
				
				
				
				
				$subcategorias=new SubCategoriasModel();
				$resultSub=$subcategorias->getAll("nombre_subcategorias");
				
				//cliente_proveedor
				$cliente_proveedor=new ClienteProveedorModel();
				$columnas_cp = " cliente_proveedor.id_cliente_proveedor, cliente_proveedor.ruc_cliente_proveedor, cliente_proveedor.nombre_cliente_proveedor";
				$tablas_cp   = " public.documentos_legal, public.cliente_proveedor";
				$where_cp  = " cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor GROUP BY  cliente_proveedor.ruc_cliente_proveedor, cliente_proveedor.nombre_cliente_proveedor ,cliente_proveedor.id_cliente_proveedor";
				$id_cp = " cliente_proveedor.nombre_cliente_proveedor";
				$resultCli=$cliente_proveedor->getCondiciones($columnas_cp, $tablas_cp, $where_cp, $id_cp);
				
		         
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
		
				
					
				
				
				
				if (isset ($_POST["categorias"]) && isset ($_POST["subcategorias"]) && isset($_POST["ruc_cliente_proveedor"]) && isset($_POST["nombre_cliente_proveedor"])  && isset($_POST["fecha_documento_desde"]) && isset($_POST["fecha_documento_hasta"])  && isset($_POST["fecha_subida_desde"])  && isset($_POST["fecha_subida_hasta"])   )
				
				{
					
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
					$_id_cliente_proveedor = $_POST["ruc_cliente_proveedor"];
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
					if ($_id_cliente_proveedor > 0)
					{
						
						$where_4 = " AND cliente_proveedor.id_cliente_proveedor = '$_id_cliente_proveedor' ";
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
			
			
			if (isset ($_POST["btnGuardar"])  && isset($_POST["id_documentos_legal"]) )
			{
					
			
			
				$nombre_controladores = "Documentos";
				$id_rol= $_SESSION['id_rol'];
				$resultPer = $documentos_legal->getPermisosEditar(" controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
				if (!empty($resultPer))
				{
					$resul = "";
			
			
					$columnas = "documentos_legal.id_documentos_legal, documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, documentos_legal.creado  ";
					$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor";
					$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor ";
					$id       = "categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos";
			
					$_id_documentos_legal = $_POST["id_documentos_legal"];
					$_id_cliente_proveedor = $_POST["nombre_cliente_proveedor"];
			
					$_fecha_documento_desde = $_POST["fecha_documento_desde"];
					$_fecha_documento_hasta = $_POST["fecha_documento_hasta"];
					$_fecha_subida_desde = $_POST["fecha_subida_desde"];
					$_fecha_subida_hasta = $_POST["fecha_subida_hasta"];
					$_fecha_poliza_desde = $_POST["fecha_poliza_desde"];
					$_fecha_poliza_hasta = $_POST["fecha_poliza_hasta"];
			
			
						
					////guardamos en caso de que esten todos seleccionados
					if ( $_fecha_documento_desde != "" AND $_id_documentos_legal > 0 )
					{
			
						$this->view("Error",array(
								"resultado"=>"Las variables". $_id_documentos_legal
									
						));
							
			
						$colval = "id_documentos_legal = '$_id_documentos_legal', id_cliente_proveedor = '$_id_cliente_proveedor', fecha_documentos_legal = '$_fecha_documento_desde' , fecha_desde_documentos_legal = '$_fecha_poliza_desde', fecha_hasta_documentos_legal = '$_fecha_poliza_hasta' ";
						$tabla = "documentos_legal";
						$where_update = "id_documentos_legal = '$_id_documentos_legal' ";
			
						$documentos_legal=new DocumentosLegalModel();
			
						$documentos_legal->UpdateBy($colval, $tabla, $where_update);
					}
				}
				else
				{
					$this->view("Error",array(
							"resultado"=>"No tiene Permisos de Editar a Documentos"
		
					));
					exit();
			
				}
			}   ///termina if guardar
	
				$this->view("DocumentosClienteProveedor",array(
						"resultCat"=>$resultCat, "resultSub"=>$resultSub, "resultCli"=>$resultCli, "resultSet"=>$resultSet, "arraySel"=>$arraySel, "resultEdit"=>$resultEdit, "resul"=>$resul  , "paginasTotales"=>$paginasTotales, "registrosTotales"=> $registrosTotales,"hojasTotales"=>$hojasTotales, "pagina_actual"=>$paginaActual, "resultAgen"=>$resultAgen, "resultSuc"=>$resultSuc, "resultReg"=>$resultReg
					 
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
				if (isset ($_POST["categorias"]) && isset ($_POST["subcategorias"]) && isset($_POST["txt_ruc_cliente_proveedor"]) && isset($_POST["txt_nombre_cliente_proveedor"])  && isset($_POST["fecha_documento_desde"]) && isset($_POST["fecha_documento_hasta"])  && isset($_POST["fecha_subida_desde"])  && isset($_POST["fecha_subida_hasta"])   )
				
				{
								
					$arraySel = "";
				    $columnas = "documentos_legal.id_documentos_legal,  documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, soat.cierre_ventas_soat,   documentos_legal.creado, documentos_legal.numero_credito_documentos_legal, referencia.nombre_referencia , tipo_comprobantes.nombre_tipo_comprobantes, comprobantes.numero_comprobantes , detalle_documentos.nombre_detalle_documentos, regionales.nombre_regionales, sucursales.nombre_sucursales, agencias.nombre_agencias"; 
					$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor, public.soat, public.referencia, public.tipo_comprobantes , public.comprobantes, public.detalle_documentos, public.sucursales, public.agencias, public.regionales";
					$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor   AND documentos_legal.id_soat = soat.id_soat  AND documentos_legal.id_referencia = referencia.id_referencia AND documentos_legal.id_tipo_comprobantes = tipo_comprobantes.id_tipo_comprobantes AND documentos_legal.id_comprobantes = comprobantes.id_comprobantes AND documentos_legal.id_detalle_comprobantes = detalle_documentos.id_detalle_documentos AND documentos_legal.id_regionales = regionales.id_regionales AND documentos_legal.id_sucursales = sucursales.id_sucursales AND documentos_legal.id_agencias = agencias.id_agencias ";
					$id       = "documentos_legal.id_documentos_legal";
						
					
					$documentos = new DocumentosLegalModel();
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
					$where_5 = "";
					$where_6 = "";
					$where_7 = "";
					$where_8 = "";
					$where_9 = "";
					$where_10 = "";
					$where_11 = "";
					$where_12 = "";
					$where_13 = "";
						
					
					
					$_id_categorias = $_POST["categorias"];
					$_id_subcategorias = $_POST["subcategorias"];
					$_id_cliente_proveedor = $_POST["txt_ruc_cliente_proveedor"];
					$_nombre_cliente_proveedor = strtoupper($_POST["txt_nombre_cliente_proveedor"]);
					$_year     = 	$_POST["year"];
					$_id_agencias = $_POST["id_agencias"];
					$_id_sucursales= $_POST["id_sucursales"];
					$_id_regionales = $_POST["id_regionales"];
					$_numero_comprobantes = $_POST["numero_comprobantes"];
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
					if ($_id_cliente_proveedor != "" )
					{
						
						$where_4 = " AND cliente_proveedor.ruc_cliente_proveedor like  '$_id_cliente_proveedor' ";
					}
					
					if ($_nombre_cliente_proveedor != "" )
					{
					
						$where_3 = " AND cliente_proveedor.nombre_cliente_proveedor like  '$_nombre_cliente_proveedor' ";
					}
					
					///lo nuevo maycol
					if ($_id_agencias > 0)
					{
					
						$where_5 = " AND documentos_legal.id_agencias = '$_id_agencias' ";
					}
					if ($_id_sucursales > 0)
					{
					
						$where_6 = " AND documentos_legal.id_sucursales = '$_id_sucursales' ";
					}if ($_id_regionales > 0)
					{
						
						$where_7 = " AND documentos_legal.id_regionales = '$_id_regionales' ";
					}
					
					if ($_numero_comprobantes != "")
					{
						
						$where_10 = " AND comprobantes.numero_comprobantes like '$_numero_comprobantes' ";
					}
					
					///termina maycol
					
					if ($_fecha_documento_desde != "" && $_fecha_documento_hasta != "")
					{
						$where_8 = " AND DATE(documentos_legal.fecha_documentos_legal) BETWEEN '$_fecha_documento_desde' AND '$_fecha_documento_hasta'  ";
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
							
						$where_12 = "  AND TO_CHAR(documentos_legal.fecha_documentos_legal,'YYYY') = '$_year' ";
					}
					
					$where_to  = $where . $where_1 . $where_2 . $where_3 . $where_4 . $where_5 . $where_6 . $where_7  . $where_8 . $where_9 . $where_10. $where_11. $where_12. $where_13;
					
					
					
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
							/*
							$html.='<div class="pull-left col-lg-2 col-md-2 col-xs-2"   style="vertical-align:midde">';
							$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
							$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
							$html.='</div></br>';
							$html.='<section style="height:425px;">';
							$html.='<table class="table table-hover" >';
							$html.='<thead>';
							$html.='<tr class="col-lg-12 col-md-10 col-xs-10 info">';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: left;  font-size: 10px;"><b>Id</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: left; font-size: 10px;"><b>Fecha</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center; font-size: 10px;"><b>Subcategoría</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center; font-size: 10px;"><b>Tipo Documentos</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center; font-size: 10px;"><b>Cliente</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center; font-size: 10px;"><b>Carpeta </b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center; font-size: 10px;"><b>Crédito</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center; font-size: 10px;"><b>Comprobante</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: left; font-size: 10px;"><b>Páginas</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: left; font-size: 10px;"><b>Referencia</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center; font-size: 10px;"><b>Tipo Comprobante</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center;font-size: 10px;"><b>Regionales</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center; font-size: 10px;"><b>Sucursales</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center; font-size: 10px;"><b>Agencias</b></th>';
							$html.='<th  class="col-lg-1 col-md-1 col-xs-1" style="text-align: center; font-size: 10px;">Visualizar</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
							*/
							
							
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
								$html.='<td style="font-size: 9px;">'.date($res->fecha_documentos_legal).'</td>';
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
								
								/*
								$html.='<tr >';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->id_documentos_legal.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->fecha_documentos_legal.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->nombre_subcategorias.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->nombre_tipo_documentos.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->nombre_cliente_proveedor.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->numero_carton_documentos.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->numero_credito_documentos_legal.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->numero_comprobantes.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->paginas_documentos_legal.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->nombre_referencia.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->nombre_tipo_comprobantes.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->nombre_regionales.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->nombre_sucursales.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">'.$res->nombre_agencias.'</td>';
								$html.='<td class="col-lg-1 col-md-1 col-xs-1" style="font-size: 9px;">';
									
								if ($_SESSION["tipo_usuario"]=="usuario_local") {
									$html.='<a href="'.IP_INT . $res->id_documentos_legal.'" class="btn btn-warning" target="blank" style="font-size:90%;">Ver</a>';
								} else {
									$html.=' <a href="'.IP_EXT . $res->id_documentos_legal.'" class="btn btn-warning" target="blank" style="font-size:90%;">Ver</a>';
								}
								$html.='</td>';
								$html.='</tr>';
								
								*/
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
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_DocumentosClienteProv(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_DocumentosClienteProv(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_DocumentosClienteProv(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_DocumentosClienteProv(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_DocumentosClienteProv(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_DocumentosClienteProv($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_DocumentosClienteProv(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	public function AutocompleteNombreCliente(){
	
		session_start();
		$nombre_cliente = strtoupper($_GET['term']);
		//cliente_proveedor
		$cliente_proveedor=new ClienteProveedorModel();
		$columnas_cp = " cliente_proveedor.id_cliente_proveedor,  cliente_proveedor.ruc_cliente_proveedor,
		 cliente_proveedor.nombre_cliente_proveedor";
		$tablas_cp   = "   public.cliente_proveedor, public.documentos_legal";
		$where_cp  = " cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor AND
		cliente_proveedor.nombre_cliente_proveedor LIKE '$nombre_cliente%'
		GROUP BY  cliente_proveedor.ruc_cliente_proveedor, cliente_proveedor.nombre_cliente_proveedor ,
		cliente_proveedor.id_cliente_proveedor";
		$id_cp = " cliente_proveedor.nombre_cliente_proveedor";
		$resultCli=$cliente_proveedor->getCondiciones($columnas_cp, $tablas_cp, $where_cp, $id_cp);
	
		if(!empty($resultCli)){
	
			foreach ($resultCli as $res){
				$_nombre_cliente[] = array('id' => $res->id_cliente_proveedor.','.$res->ruc_cliente_proveedor, 'value' => $res->nombre_cliente_proveedor);
			}
			header('Content-type: application/json');
			echo json_encode($_nombre_cliente);
		}else
		{
			header('Content-type: application/json');
			echo json_encode(array(array('id' =>'0,--TODOS--', 'value' =>'--TODOS--')));
		}
	}
	
	public function AutocompleteRucCliente(){
	
		session_start();
		$ruc_cliente = strtoupper($_GET['term']);
		$_ruc_cliente = array();
		//cliente_proveedor
		$cliente_proveedor=new ClienteProveedorModel();
		$columnas_cp = " cliente_proveedor.id_cliente_proveedor,  cliente_proveedor.ruc_cliente_proveedor,
		 cliente_proveedor.nombre_cliente_proveedor";
		$tablas_cp   = "   public.cliente_proveedor, public.documentos_legal";
		$where_cp  = " cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor AND
		cliente_proveedor.ruc_cliente_proveedor LIKE '$ruc_cliente%'
		GROUP BY  cliente_proveedor.ruc_cliente_proveedor, cliente_proveedor.nombre_cliente_proveedor ,
		cliente_proveedor.id_cliente_proveedor";
		$id_cp = " cliente_proveedor.nombre_cliente_proveedor";
	
		$resultCli=$cliente_proveedor->getCondiciones($columnas_cp, $tablas_cp, $where_cp, $id_cp);
	
	
		if(!empty($resultCli)){
	
			foreach ($resultCli as $res){
	
				$_ruc_cliente[] = array('id' => $res->id_cliente_proveedor.','.$res->nombre_cliente_proveedor, 'value' => $res->ruc_cliente_proveedor);
			}
			echo json_encode($_ruc_cliente);
		}else
		{
			echo json_encode(array(array('id' =>'0,--TODOS--', 'value' =>'--TODOS--')));
		}
	}
	
	
	public function AutocompleteNumeroComprobantes(){
	
		session_start();
		
		$comprobantes= new ComprobantesModel();
		$numero_comprobantes = $_GET['term'];
	
			
			
		$columnas ="comprobantes.id_comprobantes, 
                    comprobantes.numero_comprobantes";
		$tablas=" public.documentos_legal, 
                   public.comprobantes";
	
		$where ="comprobantes.numero_comprobantes LIKE '$numero_comprobantes%' AND
		documentos_legal.id_comprobantes = comprobantes.id_comprobantes GROUP BY comprobantes.id_comprobantes, comprobantes.numero_comprobantes";
		$id ="comprobantes.numero_comprobantes";
	
	
		$resultSet=$comprobantes->getCondiciones($columnas, $tablas, $where, $id);
	
		$_numero_comprobantes[] = "--TODOS--";
		if(!empty($resultSet))
		{
	
			foreach ($resultSet as $res){
	
				$_numero_comprobantes[] = $res->numero_comprobantes;
			}
			header('Content-type: application/json');
			echo json_encode($_numero_comprobantes);
		}
		else	{
			header('Content-type: application/json');
			echo json_encode($_numero_comprobantes);
		}
	
	}
	
}

?>