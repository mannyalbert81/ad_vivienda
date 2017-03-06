
<?php

class TarjetasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$tarjetas = new TarjetasModel();
     	//Conseguimos todos los usuarios
		$resultTar=$tarjetas->getContador( "COUNT(id_tarjetas) AS contador ");
		
		
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuario']) )
		{

			$resultado = null;
			
			$documentos_legal = new  DocumentosLegalModel();
			
			$nombre_controladores = "Tarjetas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tarjetas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
				$_destino_id = "";
				$_numero_tarjetas = "";
				$_nombre_tipos_tarjetas = "";
				$id_consulta = "numero_tarjetas";
					
				if (isset ($_POST["btn_guardar"]) )
				{
					$resRuc = "";
			
					if ($_POST["destino_id"])
					{
						$destino_new_id = $_POST["destino_new_id"];
						$destino_id = $_POST["destino_id"];
						$destino_numero = $_POST["destino_numero"];
						$destino_nombre = $_POST["destino_nombre"];
						 
							
						if(count($destino_id) != count($destino_nombre))
						{
							$resNombre = array_combine(array_intersect_key($destino_id, $destino_nombre), array_intersect_key($destino_nombre, $destino_id) );
						}
						else
						{
							$resNombre =  array_combine($destino_id, $destino_nombre);
						}
							
							
						$resNumero =  array_combine($destino_id, $destino_numero);
						 
						//actualizo los numerops
						foreach($resNumero  as $id => $numero )
						{
							if ( is_null($id) || is_null($numero) )
							{
								 
							}
							else
							{
			
								$colval = "numero_tarjetas = '$numero ' ";
								$tabla = "tarjetas";
								$where = "id_tarjetas = '$id' ";
								$tarjetas->UpdateBy($colval, $tabla, $where);
							}
							//echo "Key=" . $x . ", Value=" . $x_value;
						}
						 
						 
						 
						 
						foreach($resNombre  as $id => $nombre )
						{
							if (is_null($id) || is_null($nombre))
							{
							}
							else
							{
						/*						
								$colval = "nombre_cliente_proveedor = '$nombre ' ";
								$tabla = "cliente_proveedor";
								$where = "id_cliente_proveedor = '$id' ";
						*/		$cliente_proveedor->UpdateBy($colval, $tabla, $where);
							}
			
							//echo "Key=" . $x . ", Value=" . $x_value;
						}
						 
						 
							
						if(count($destino_id) != count($destino_new_id))
						{
							$resId = array_combine(array_intersect_key($destino_id, $destino_new_id), array_intersect_key($destino_new_id, $destino_id) );
						}
						else
						{
							$resId =  array_combine($destino_id, $destino_new_id);
						}
							
							
						foreach($resId  as $id => $id_new )
						{
							if (!empty($id_new) )
							{
								//busco si exties este nuevo id
								 
								try {
									$resTar = $tarjetas->getBy("id_tarjetas = '$id_new' ");
								} catch (Exception $e) {
			
									$resultado = "id_tarjetas = '$id_new'" . "id:".$id ;
								}
			
								if (count($resTar) > 0)
								{
									///act documentos
									$colval = " id_tarjetas = '$id_new' ";
									$tabla  = "documentos_legal";
									$where = "id_tarjetas = '$id' ";
									$documentos_legal->UpdateBy($colval, $tabla, $where);
			
									//delete los proveedores
									$tarjetas->deleteBy("id_tarjetas", $id);
								}
			
								 
							}
								
								
						}
							
							
							
					}
			
				}
			
				$resultEdit = "";
				if (isset($_POST["btn_index_id"]))
				{
					$resultTar=$tarjetas->getAll("id_tarjetas");
					$id_consulta = "tarjetas.id_tarjetas";
				}
					
				if (isset($_POST["btn_index_numero"]))
				{
					$id_consulta = "tarjetas.numero_tarjetas";
				}
					
					
					
			
					
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Editar Tarjetas"
			
				));
			
			
			}
				
			
			
			
			
			$nombre_controladores = "Tarjetas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tarjetas->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_tarjetas"])   )
				{
					$nombre_controladores = "Tarjetas";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tarjetas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
					if (!empty($resultPer))
					{
					
					
						$_id_tarjetas = $_GET["id_tarjetas"];
						
						$resultEdit = $tarjetas->getBy("id_tarjetas = '$_id_tarjetas' ") ;
						
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Edición a Tarjetas"
					
						));
					
						exit();
						
					}
						
				}
		

				///aqui va la paginacion  ///
				$articulosTotales = 0;
				$paginasTotales = 0;
				$paginaActual = 0;
				$ultima_pagina = 1;
				if(isset($_POST["pagina"])){
				
					// en caso que haya datos, los casteamos a int
					$paginaActual = (int)$_POST["pagina"];
					$ultima_pagina = (int)$_POST["ultima_pagina"] - 10;
				}
				
				if(isset($_POST["siguiente_pagina"])){
				
					// en caso que haya datos, los casteamos a int
					$ultima_pagina = (int)$_POST["ultima_pagina"];
				}
				
					
			if(isset($_POST["btn_navegar_pagina"])){
				
					// en caso que haya datos, los casteamos a int
					$ultima_pagina = (int)$_POST["txt_navegar_pagina"];
				}
				
				
		    	if(isset($_POST["anterior_pagina"])){
				
						if ((int)$_POST["ultima_pagina"] - 20 > 0)
						{
							$ultima_pagina = (int)$_POST["ultima_pagina"] - 20;
						}
						else 
						{
							$ultima_pagina = 1;
						}
						
						
					
				}
				
				
				
				
				if ($resultTar != "")
				{
						
					foreach($resultTar as $res)
					{
						$articulosTotales = $res->contador;
					}
				
				
					$articulosPorPagina = 100;
				
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
				
					$columnas = " tarjetas.id_tarjetas , tarjetas.numero_tarjetas ";
					$tablas   = "tarjetas, documentos_legal";
					$where_to = " tarjetas.id_tarjetas = documentos_legal.id_tarjetas GROUP BY tarjetas.id_tarjetas, tarjetas.numero_tarjetas";
				
				
					//agregamos el limit
					$limit = " LIMIT   '$articulosPorPagina' OFFSET '$articuloInicial'";
				
					//volvemos a pedir el resultset con la pginacion
				
					$resultTar=$tarjetas->getCondicionesPag($columnas ,$tablas ,$where_to,  $id_consulta, $limit );
				
				
				
				}  //
				
				$this->view("Tarjetas",array(
						"resultTar"=>$resultTar, "resultEdit" =>$resultEdit
						, "paginasTotales"=>$paginasTotales, "registrosTotales"=> $articulosTotales,"pagina_actual"=>$paginaActual,
						"ultima_pagina"=>$ultima_pagina
							
				));
				
				
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No Tiene Permisos de Acceso a Clientes/Proveedor"
					));
				
				
			}
				
		}
		else 
		{
				$this->view("ErrorSesion",array(
						"resultSet"=>""
			
				));
		
		}
	
	}
	
	public function Update()
	{
			
		
		
	}
	
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$categorias=new CategoriasModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $categorias->getByPDF("id_categorias, nombre_categorias, path_categorias", " nombre_categorias != '' ");
			$this->report("Categorias",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	

	public function ReporteTotal(){
	
	
		//Creamos el objeto usuario
		$categorias=new CategoriasModel();
		//Conseguimos todos los usuarios
	
		$documentos_legal=new DocumentosLegalModel();
		
	
		$columnas = " categorias.nombre_categorias, COUNT(documentos_legal.paginas_documentos_legal) AS lecturas_documentos, SUM(documentos_legal.paginas_documentos_legal)  AS paginas_documentos";
		$tablas   = " public.categorias, public.subcategorias, public.documentos_legal";
		$where    = " subcategorias.id_categorias = categorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias GROUP BY categorias.nombre_categorias";
		$id       = "categorias.nombre_categorias";
	
	
		$columnas2 = " 'TOTALES' AS totales,  SUM(paginas_documentos_legal) AS total_paginas, COUNT(id_documentos_legal) AS total_documentos";
		$where2 = "id_documentos_legal > 0";
		
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $categorias->getCondicionesPDF($columnas, $tablas, $where, $id);

			$resultRep2 = $documentos_legal->getByPDF($columnas2, $where2);
			
				
			
			
			$this->report("CategoriasDocumentos",array(	"resultRep"=>$resultRep, "resultRep2"=>$resultRep2));
	
		}
			
	
	
	}
	
	
}
?>