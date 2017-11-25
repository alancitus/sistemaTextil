<?php 
Class ProyectoModel extends CI_Model
{
	public function Actualizar($data)
	{
		$data['Empresa_id'] = $this->user->Empresa_id;
		$data['Fecha_inicio'] = ToDate($data['Fecha_inicio']);
		$data['Fecha_fin'] = ToDate($data['Fecha_fin']);
		
		$this->db->where('id', $data['id']);
		$this->db->update('proyecto', $data);
		
		$this->responsemodel->SetResponse(true);
 		return $this->responsemodel;
	}
	public function Registrar($data)
	{
		$data['Empresa_id'] = $this->user->Empresa_id;
		$this->db->insert('proyecto', $data);
		$data['Fecha_inicio'] = ToDate($data['Fecha_inicio']);
		$data['Fecha_fin'] = ToDate($data['Fecha_fin']);
		
		$this->responsemodel->SetResponse(true);
		$this->responsemodel->href   = 'secuenciaoperaciones/proyecto/' . $this->db->insert_id();
		
		return $this->responsemodel;
	}
	public function Obtener($id)
	{
		$this->db->where('Empresa_id', $this->user->Empresa_id);
		$this->db->where('id', $id);
		return $this->db->get('proyecto')->row();
	}
	public function Eliminar($id)
	{
		$sql = "
			SELECT COUNT(*) Total FROM procesoproyecto WHERE proyecto_id = $id 
		";
		if($this->db->query($sql)->row()->Total > 0)
		{
			$this->responsemodel->SetResponse(false, 'Este <b>registro</b> no puede ser eliminado.');
		}
		else
		{
			$this->db->where('Empresa_id', $this->user->Empresa_id);
			$this->db->where('id', $id);
			$this->db->delete('proyecto');
			
			$this->responsemodel->SetResponse(true);
			$this->responsemodel->href   = 'secuenciaoperaciones/proyectos';			
		}
	
		return $this->responsemodel;

	}
	public function Listar()
	{
		$where = 'Empresa_id = ' . $this->user->Empresa_id . ' ';
		$this->filter = isset($_REQUEST['filters']) ? json_decode($_REQUEST['filters']) : null;

		if($this->filter != null)
		{
			foreach($this->filter->{'rules'} as $f)
			{
				if($f->field == 'id') $where .= "AND id = '" . $f->data . "' ";
				if($f->field == 'Nombre') $where .= "AND Nombre LIKE '" . $f->data . "%' ";
			}
		}

		$this->db->where($where);
		$this->jqgridmodel->Config($this->db->SELECT('COUNT(*) Total FROM proyecto')->get()->row()->Total);
		
		$this->db->order_by($this->jqgridmodel->sord);
		$this->db->where($where);
		$this->jqgridmodel->DataSource(
			$this->db->get(
				'proyecto', 
				$this->jqgridmodel->limit, 
				$this->jqgridmodel->start)->result());
			
		return $this->jqgridmodel;
	}
	public function Buscar($criterio)
	{
		$sql = "
			SELECT * FROM proyecto
			WHERE Nombre LIKE '%$criterio%'
			AND Empresa_id = " . $this->user->Empresa_id . "
			ORDER BY Nombre
			LIMIT 0,10
		";
		return $this->db->query($sql)->result();
	}
}