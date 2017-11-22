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
	
	public function Ajax($action)
	{
		if (!$this->input->is_ajax_request()) exit('No direct script access allowed');
		switch($action)
		{
			case 'AgregarProcesosProyecto':
				print_r(json_encode($this->ppm->Registrar($_POST)));
				break;
			case 'EditarProcesosProyecto':
				unset($_POST['oper']);
				print_r(json_encode($this->ppm->Actualizar($_POST)));
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
			case 'CargarProcesos':
				print_r(json_encode($this->pcm->Listar()));
				break;
		}
	}
}