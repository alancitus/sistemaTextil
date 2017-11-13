<?php 
Class ProcesoproyectoModel extends CI_Model
{
	public function Actualizar($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('proyecto', $data);
		
		$this->responsemodel->SetResponse(true);
 		return $this->responsemodel;
	}
	public function Registrar($data)
	{
		$this->db->insert('proyecto', $data);
		
		$this->responsemodel->SetResponse(true);
		$this->responsemodel->href   = 'proyectos/' . $this->db->insert_id();
		
		return $this->responsemodel;
	}
	public function Obtener($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('proyecto')->row();
	}
	public function Eliminar($id)
	{
		$sql = "
			SELECT COUNT(*) Total FROM cronogramaproyecto WHERE proyecto_id = $id 
		";

		if($this->db->query($sql)->row()->Total > 0)
		{
			$this->responsemodel->SetResponse(false, 'Este <b>registro</b> no puede ser eliminado.');
		}
		else
		{
			$this->db->where('id', $id);
			$this->db->delete('proyecto');
			
			$this->responsemodel->SetResponse(true);
			$this->responsemodel->href   = 'proyectos/index';			
		}
	
		return $this->responsemodel;

	}
	public function Listar($proyecto_id)
	{
		//$where = 'proyecto_id = ' . $this->proyecto->proyecto_id . ' ';
		$where = 'proyecto_id = '.$proyecto_id.' ';
		$this->filter = isset($_REQUEST['filters']) ? json_decode($_REQUEST['filters']) : null;

		
		if($this->filter != null)
		{
			foreach($this->filter->{'rules'} as $f)
			{
				if($f->field == 'id') $where .= "AND id = '" . $f->data . "' ";
				if($f->field == 'Nombre') $where .= "AND Nombre LIKE '" . $f->data . "%' ";
				if($f->field == 'Marca')  $where .= "AND Marca LIKE '" . $f->data . "%' ";
				if($f->field == 'UnidadMedida_id' && $f->data != 't')  $where .= "AND UnidadMedida_id = '" . $f->data . "' ";
			}
		}
		
		$this->db->where($where);
		$this->jqgridmodel->Config($this->db->SELECT('COUNT(*) Total FROM procesoproyecto')->get()->row()->Total);
		
		$this->db->order_by($this->jqgridmodel->sord);
		$this->db->where($where);
		$this->db->join('proyecto','procesoproyecto.proyecto_id = proyecto.id');
		$this->db->join('proceso','procesoproyecto.proceso_id = proceso.id');
		$this->db->select('procesoproyecto.*,proceso.nombre as nombreproceso, proyecto.nombre as nombreproyecto');
		
		$this->jqgridmodel->DataSource(
			$this->db->get(
				'procesoproyecto', 
				$this->jqgridmodel->limit, 
				$this->jqgridmodel->start)->result());
			
		return $this->jqgridmodel;
	}
	public function Buscar($criterio)
	{
		$sql = "
			SELECT * FROM proyecto
			WHERE Nombre LIKE '%$criterio%'
			ORDER BY Nombre
			LIMIT 0,10
		";
		return $this->db->query($sql)->result();
	}
}