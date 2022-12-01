<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['main'] = "welcome/inicio";

$route['solicitante'] = "solicitante/index";
$route['solicitante/nuevo/(:any)'] = "solicitante/insert/$1";
$route['solicitante/aggiornare/(:any)/(:any)'] = "solicitante/editar/$1/$2";

$route['funcionario'] = "Funcionario/index";
$route['funcionario/nuevo/(:any)'] = "Funcionario/insert/$1";
$route['funcionario/aggiornare/(:any)/(:any)'] = "Funcionario/editar/$1/$2";
$route['funcionario/editar'] = "Funcionario/editarDBPerfil";

$route['utente'] = "Usuario/index"; 
$route['usuario/nuevo'] = "Usuario/insert";
$route['usuario/aggiornare/(:any)'] = "Usuario/editar/$1";
$route['usuario/edit/(:any)'] = "Usuario/update/$1";
$route['utente/entrare'] = "Usuario/ingresar"; 
$route['utente/salir'] = "Usuario/cerrarSesion";
$route['utente/ver/(:any)'] = "Usuario/perfil/$1";
$route['usuario/modificar/(:any)'] = "Usuario/editarBoth/$1";
$route['usuario/editar'] = "Usuario/updateDB";

$route['tipotramite/requisitos'] = "Tipotramite/getTramiteRequisitos";
$route['tipotramite/lista'] = "TipoTramite/index";
$route['tipotramite/nuevo'] = "TipoTramite/insert";
$route['tipotramite/guardar'] = "TipoTramite/guardarDB";
$route['tipotramite/editar/(:any)'] = "TipoTramite/editar/$1";
$route['tipotramite/modificar'] = "TipoTramite/editarDB";

$route['proceso/lista/(:any)'] = "ProcesoTramite/index/$1";
$route['proceso/listar/(:any)'] = "ProcesoTramite/listar/$1";
$route['proceso/cargarrequisitos/(:any)'] = "ProcesoTramite/getTramiteRequisitos/$1";
$route['proceso/nuevo'] = "ProcesoTramite/insert";
$route['proceso/guardar'] = "ProcesoTramite/guardarDB";
$route['proceso/buscar'] = "ProcesoTramite/find";
$route['proceso/aggiornare/(:any)/(:any)'] = "ProcesoTramite/editar/$1/$2";
$route['proceso/aggiornare/editar'] = "ProcesoTramite/editarDB";
$route['proceso/pdf/(:any)'] = "ProcesoTramite/abrirPdf/$1";
$route['proceso/manual/(:any)'] = "ProcesoTramite/abrirNamualPdf/$1";
$route['proceso/cambiar/(:any)/(:any)'] = "ProcesoTramite/cambiarEstado/$1/$2";
$route['proceso/requisitos/(:any)'] = "ProcesoTramite/docs/$1";
$route['proceso/sumardias/(:any)'] = "ProcesoTramite/getTramiteDias/$1";
$route['proceso/nuevo-tramite/(:any)/(:any)/(:any)'] = "ProcesoTramite/nuevo/$1/$2/$3";

//$route['proceso/reporte-en-curso/(:any)/(:any)'] = "ProcesoTramite/reporteTramite/$1/$2";

$route['norma'] = "Norma/index";
$route['norma/nuevo'] = "Norma/insert";
$route['norma/guardar'] = "Norma/guardarDB";
$route['norma/modificar/(:any)'] = "Norma/editar/$1";
$route['norma/editar'] = "Norma/editarDB";
$route['norma/eliminar/(:any)/(:any)'] = "Norma/cambiarEstado/$1/$2";

$route['perfil/ver/(:any)'] = "usuario/perfil/$1";

$route['asignado/view/(:any)'] = "Asignados/insert/$1";
$route['asignado/guardar'] = "Asignados/guardarDB";
$route['asignados/imprimir/(:any)'] = "Asignados/reporte2/$1";

$route['requisito/lista'] = "Requisito/index";
$route['requisito/nuevo'] = "Requisito/insert";
$route['requisito/guardar'] = "Requisito/guardarDB";
$route['requisito/modificar/(:any)/(:any)'] = "Requisito/editar/$1/$2";
$route['requisito/editar'] = "Requisito/editarDB";
$route['requisito/eliminar/(:any)/(:any)'] = "Requisito/cambiarEstado/$1/$2";

$route['nombretramite/lista'] = "Tipotramite/index";
$route['nombretramite/nuevo'] = "Tipotramite/insert";
$route['nombretramite/guardar'] = "Tipotramite/guardarDB";
$route['nombretramite/modificar/(:any)/(:any)'] = "Tipotramite/editar/$1/$2";
$route['nombretramite/editar'] = "Tipotramite/editarDB";
$route['nombretramite/eliminar/(:any)/(:any)'] = "TipoTramite/cambiarEstado/$1/$2";

$route['seguimiento'] = "seguimiento/index";

$route['seguimiento/hoja/(:any)/(:any)'] = "Seguimiento/hojaderuta/$1/$2";
$route['seguimiento/buscar'] = "Seguimiento/buscarByCi";
$route['seguimiento/horaderuta'] = "Seguimiento/hojaruta";
$route['seguimiento/reportehojaderuta'] = "Seguimiento/buscarHoja";
$route['seguimiento/bitacora/(:any)'] = "Seguimiento/bitacora/$1";

$route['imprimir/datosfuncionario'] = "Funcionario/reporteFuncionario";
$route['imprimir/solicitantes'] = "Solicitante/reportePersona";
$route['imprimir/norma'] = "Norma/reporteNorma";
$route['imprimir/requisito'] = "Requisito/reporteRequisito";
$route['imprimir/tipotramite'] = "TipoTramite/reporteTipoTramite";
$route['imprimir/procesotramite'] = "ProcesoTramite/reporteTramite";
$route['imprimir/usuarios'] = "Usuario/reporteUsuario";
$route['imprimir/reporte-en-curso/(:any)'] = "ProcesoTramite/enCurso/$1";
$route['imprimir/grafico'] = "ProcesoTramite/graficos";
$route['imprimir/imprimir-en-curso'] = "ProcesoTramite/reporteTramite";
$route['imprimir/imprimir-aprobados'] = "ProcesoTramite/reporteTramitesAprobados";
$route['ver/grafico'] = "ProcesoTramite/verGrafico";
$route['imprimir/imprimir-fases'] = "ProcesoTramite/reporteFases";


$route['mapa/ver/(:any)/(:any)'] = "Mapa/index/$1/$2";
 
$route['formulario'] = "Form/insert";
$route['formulario/datos'] = "Form/datoTecnicos";
$route['formulario/guardar'] = "Form/guardarDT";
$route['formulario/save'] = "Form/guardarDB";
$route['formulario/lista'] = "Form/listaSolicitud";


$route['validar/(:any)'] = "Solicitante/validarCi/$1";

$route['predio/lista'] = "Predio/index";
$route['predio/tramites-asignados'] = "Predio/tramitesasignados";
$route['predio/nuevo/(:any)/(:any)/(:any)'] = "Predio/insert/$1/$2/$3";
$route['predio/guardar'] = "Predio/guardarDB";
$route['predio/nueva-caracteristica/(:any)/(:any)/(:any)'] = "Predio/insertCaracteristica/$1/$2/$3";
$route['predio/guardar-caracteristica'] = "Predio/guardarCaracteristica";
$route['predio/imprimir/(:any)/(:any)'] = "Predio/imprimir/$1/$2";
$route['predio/editar/(:any)'] = "Predio/editar/$1";
$route['predio/modificar'] = "Predio/editarDB";
$route['predio/eliminar/(:any)/(:any)'] = "Predio/cambiarEstado/$1/$2";

/*
$route['norma/modificar/(:any)'] = "Norma/editar/$1";
$route['norma/editar'] = "Norma/editarDB";
$route['norma/eliminar/(:any)/(:any)'] = "Norma/cambiarEstado/$1/$2";
*/



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
