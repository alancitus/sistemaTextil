<?php 
Class CompraModel extends CI_Model
{
	public function Actualizar($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->where('Empresa_id', $this->user->Empresa_id);
		$this->db->update('compra', $data);
		
		$this->responsemodel->SetResponse(true);
 		return $this->responsemodel;
	}
	public function Registrar($data)
	{
		$data['Empresa_id'] = $this->user->Empresa_id;
		$this->db->insert('compra', $data);
		
		$this->responsemodel->SetResponse(true);
		$this->responsemodel->href   = 'registro/compra/' . $this->db->insert_id();
		
		return $this->responsemodel;
	}
	public function Obtener($id)
	{
		$this->db->where('Empresa_id', $this->user->Empresa_id);
		$this->db->where('id', $id);
		return $this->db->get('compra')->row();
	}
	public function Eliminar($id)
	{
		
		$this->db->where('Empresa_id', $this->user->Empresa_id);
		$this->db->where('id', $id);
		$this->db->delete('compra');
		
		$this->responsemodel->SetResponse(true);
		$this->responsemodel->href   = 'registro/compras';
		
	
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
		$this->jqgridmodel->Config($this->db->SELECT('COUNT(*) Total FROM compra')->get()->row()->Total);
		
		$this->db->order_by($this->jqgridmodel->sord);
		$this->db->where($where);
		$this->jqgridmodel->DataSource(
			$this->db->get(
				'compra', 
				$this->jqgridmodel->limit, 
				$this->jqgridmodel->start)->result());
			
		return $this->jqgridmodel;
	}
	public function Buscar($criterio)
	{
		$sql = "
			SELECT * FROM compra
			WHERE Nombre LIKE '%$criterio%'
			AND Empresa_id = " . $this->user->Empresa_id . "
			ORDER BY Nombre
			LIMIT 0,10
		";
		return $this->db->query($sql)->result();
	}
}