<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class secuenciaoperaciones extends CI_Controller 
{
	public function __CONSTRUCT()
	{
		parent::__construct();
		$this->load->model('procesomodel', 'pcm');
		$this->load->model('proyectomodel', 'pym');
		$this->load->model('procesoproyectomodel', 'ppm');
	}
	public function procesos()
	{
		// Verificamos si tiene permiso
		if(!$this->menumodel->VerificarAcceso()) redirect('inicio');
		
		$this->load->view('header');
		$this->load->view('secuenciaoperaciones/procesos');
		$this->load->view('footer');		
	}
	public function proceso($id=0)
	{
		$p = $id > 0 ? $this->pcm->Obtener($id) : null;
		 
 		$this->load->view('header');
		$this->load->view('secuenciaoperaciones/proceso', 
							array( 
								'proceso' => $p
								));
		$this->load->view('footer');		
	}
	public function Procesoscrud()
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		print_r(json_encode(isset($_POST['id']) ? $this->pcm->Actualizar(SafeRequestParameters($_POST)) : $this->pcm->Registrar(SafeRequestParameters($_POST))));		
	}
	public function procesoeliminar($id)
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		print_r(json_encode($this->pcm->Eliminar($id)));		
	}
	public function proyectos()
	{
		// Verificamos si tiene permiso
		if(!$this->menumodel->VerificarAcceso()) redirect('inicio');
		
		$this->load->view('header');
		$this->load->view('secuenciaoperaciones/proyectos');
		$this->load->view('footer');		
	}
	public function proyecto($id=0)
	{
		$p = $id > 0 ? $this->pym->Obtener($id) : null;
		
		$this->load->view('header');
		$this->load->view('secuenciaoperaciones/proyecto',
					array(
						'proyecto' => $p
					));
		$this->load->view('footer');		
	}
	public function proyectotiempo($id=0)
	{
		$p = $id > 0 ? $this->pym->Obtener($id) : null;
		
		$this->load->view('header');
		$this->load->view('secuenciaoperaciones/proyectotiempo',
					array(
						'proyecto' => $p
					));
		$this->load->view('footer');		
	}
	public function Proyectoscrud()
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		
        if(IS_DEMO == 1)
        {
            print_r(json_encode(array('response' => false, 'message' => 'La <b>versión DEMO</b> no permite guardar los datos de los Usuarios.')));            
        } else {
            print_r(json_encode( isset($_POST['id']) ? $this->pym->Actualizar(SafeRequestParameters($_POST)) : $this->pym->Registrar(SafeRequestParameters($_POST))) );            
        }
	}
	public function proyectoeliminar($id)
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		
		print_r(json_encode($this->pym->Eliminar($id)));
	}
	public function cliente($id=0)
	{
		$c = $id > 0 ? $this->clm->Obtener($id) : null;
		
		$this->load->view('header');
		$this->load->view('mantenimiento/cliente',
					array(
						'cliente' => $c
					));
		$this->load->view('footer');		
	}
	public function clientecrud()
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		print_r(json_encode(isset($_POST['id']) ? $this->clm->Actualizar(SafeRequestParameters($_POST)) : $this->clm->Registrar(SafeRequestParameters($_POST))));		
	}
	public function clienteeliminar($id)
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		print_r(json_encode($this->clm->Eliminar($id)));		
	}
	public function productos()
	{
		// Verificamos si tiene permiso
		if(!$this->menumodel->VerificarAcceso()) redirect('inicio');
		
		$this->load->view('header');
		$this->load->view('mantenimiento/productos');
		$this->load->view('footer');		
	}
	public function producto($id=0)
	{
		$p = $id > 0 ? $this->pm->Obtener($id) : null;
		 
 		$this->load->view('header');
		$this->load->view('mantenimiento/producto', 
							array( 
								'producto' => $p,
								'asignada' => $id > 0 ? $this->pm->HaSidoAsignada($id) : false
								)
							);
		$this->load->view('footer');		
	}
	public function productocrud()
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		if(count($_POST)){
			print_r(json_encode(isset($_POST['id']) ? $this->pm->Actualizar(SafeRequestParameters($_POST)) : $this->pm->Registrar(SafeRequestParameters($_POST))));		
		}else{
			print_r(json_encode(['message'=>'error en guardar']));
		}
	}
	public function productoeliminar($id)
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		print_r(json_encode($this->pm->Eliminar($id)));		
	}
	public function servicios()
	{
		// Verificamos si tiene permiso
		if(!$this->menumodel->VerificarAcceso()) redirect('inicio');
		
		$this->load->view('header');
		$this->load->view('mantenimiento/servicios');
		$this->load->view('footer');		
	}
	public function impresora($tipo)
	{
		$this->load->library('EnLetras', 'el');		
		$this->load->view('ventas/impresion', array(
			'comprobante' => $this->cpm->ObtenerPrueba($tipo),
			'EnLetras'    => new EnLetras()
		));
	}
	public function configuracion()
	{
		// Verificamos si tiene permiso
		if(!$this->menumodel->VerificarAcceso()) redirect('inicio');
		
		$this->load->view('header');
		$this->load->view('mantenimiento/configuracion', 
							array( 
								'configuracion' => $this->configuracionmodel->Obtener(),
								'monedas'       => $this->mm->Listar()
								));
		$this->load->view('footer');		
	}
	public function ConfiguracionActualizar()
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		print_r(json_encode($this->configuracionmodel->Actualizar(SafeRequestParameters($_POST))));
	}
	public function Ajax($action)
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		switch($action)
		{
			case 'AgregarProcesosProyecto':
				print_r(json_encode($this->ppm->Registrar($_POST)));
				break;
			case 'EliminarProcesosProyecto':
				print_r(json_encode($this->ppm->Eliminar($_POST['id'])));
				break;
			case 'CargarProyectos':
				print_r(json_encode($this->pym->Listar()));
				break;
			case 'CargarProcesosProyecto':
				print_r(json_encode($this->ppm->Listar($_GET['proyecto_id'])));
				break;
			case 'CargarClientes':
				print_r(json_encode($this->clm->Listar()));
				break;
			case 'CargarProcesos':
				print_r(json_encode($this->pcm->Listar()));
				break;
			case 'GuardarConfiguracionImpresora':
				print_r(json_encode($this->cfm->GuardarConfiguracionImpresora($this->input->post('f'), $this->input->post('tipo'))));
				break;
		}
	}
}