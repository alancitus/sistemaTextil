<?php
class MaquinariaModel extends CI_Model
{
	public function Actualizar($data)
	{
 		$this->db->trans_start();
 		unset($data['Foto']);
		
		$FConfig = 	array(
			'upload_path'   => './machines',
			'allowed_types' => 'jpg|png',
			'max_size'      => '2000',
			'max_width'     => '2000',
			'max_height'    => '2000',
			'overwrite'     => true
		);
		$foto = true;
		if(isset($_FILES['Foto']))
		{
			$FConfig['file_name'] = $data['id'] . '_maquinaria';
			$this->upload->initialize($FConfig);
			if ( ! $this->upload->do_upload('Foto') )
			{
				$this->responsemodel->message = $this->upload->display_errors();
				$foto = false;
			}
			else
			{
				$upload = $this->upload->data();
				$data['Foto'] = $upload['file_name'];	
			}
		}
 		 		
		$id = $data['id'];
		
		$validacion = true;
		if($validacion)
		{
			$this->db->where('id', $data['id']);
			$this->db->update('maquinaria', $data);
	
			$this->responsemodel->SetResponse(true);				
		}
		
		$this->db->trans_complete();
		 
		if ($this->db->trans_status() === FALSE)
		{
			log_message('1', __CLASS__ . '->' . __METHOD__);
			$this->responsemodel->SetResponse(false);	
		}
				
		$this->responsemodel->href   = 'self';
 		return $this->responsemodel;
	}
	public function Registrar($data)
	{

		
		$data['Marca'] = strtolower($data['Marca']);
		

	$data['Empresa_id'] = $this->user->Empresa_id;
		$this->db->insert('maquinaria', $data);
		$new_id = $this->db->insert_id();

		unset($data['Foto']);
		$FConfig = 	array(
			'upload_path'   => './machines',
			'allowed_types' => 'jpg|png',
			'max_size'      => '2000',
			'max_width'     => '2000',
			'max_height'    => '2000',
			'overwrite'     => true
		);
		$foto = true;
		if(isset($_FILES['Foto']))
		{
			$FConfig['file_name'] = $new_id . '_maquinaria';
			$this->upload->initialize($FConfig);
			if ( ! $this->upload->do_upload('Foto') )
			{
				$this->responsemodel->message = $this->upload->display_errors();
				$foto = false;
			}
			else
			{
				$upload = $this->upload->data();
				$this->db->where('id',$new_id)->update('maquinaria', ['Foto'=>$upload['file_name']]);	
			}
		}


		$this->responsemodel->SetResponse(true);
		$this->responsemodel->href   = 'mantenimiento/maquinaria/' . $new_id;

		
		return $this->responsemodel;
	

	
	
	}
	public function Obtener($id)
	{
		$this->db->where('Empresa_id', $this->user->Empresa_id);
		$this->db->where('id', $id);
		return $this->db->get('maquinaria')->row();
	}
	public function Eliminar($id)
	{
		
		$this->db->where('Empresa_id', $this->user->Empresa_id);
		$this->db->where('id', $id);
		$this->db->delete('maquinaria');
		
		$this->responsemodel->SetResponse(true);
		$this->responsemodel->href = 'mantenimiento/maquinarias/';		
		
		return $this->responsemodel;
	}
	public function Listar()
	{
		$where  = "Empresa_id = " . $this->user->Empresa_id . ' ';;
		
		$this->filter = isset($_REQUEST['filters']) ? json_decode($_REQUEST['filters']) : null;

		if($this->filter != null)
		{
			foreach($this->filter->{'rules'} as $f)
			{
				if($f->field == 'Nombre') $where .= "AND Nombre LIKE '" . $f->data . "%' ";
				//if($f->field == 'Identidad') $where .= "AND Identidad LIKE '" . $f->data . "%' ";
			}
		}

		$this->db->where($where);
		$this->jqgridmodel->Config($this->db->SELECT('COUNT(*) Total FROM maquinaria')->get()->row()->Total);
		
	/*	$sql = "
			SELECT 
				*,
				IF(Ruc = '', Dni, Ruc) AS Identidad
			FROM maquinaria
			WHERE $where
			ORDER BY " . $this->jqgridmodel->sord . "
			LIMIT " . $this->jqgridmodel->start . "," . $this->jqgridmodel->limit;
*/

	$sql = "
			SELECT 
				*
			FROM maquinaria
			WHERE $where
			ORDER BY " . $this->jqgridmodel->sord . "
			LIMIT " . $this->jqgridmodel->start . "," . $this->jqgridmodel->limit;

		$this->db->where($where);
		$this->jqgridmodel->DataSource($this->db->query($sql)->result());
			
		return $this->jqgridmodel;
	}
	public function Buscar($criterio, $tipo=0)
	{
		// 1 Tiene Ruc 2 Solo Dni
		$select = "*, IF(Ruc = '', Dni, Ruc) AS Identidad";
		
		if($tipo == '3') $select = '*, Ruc Identidad';
		if($tipo == '2') $select = '*, Dni Identidad';
		
		$sql = "
			SELECT $select FROM maquinaria
			WHERE Nombre LIKE '%$criterio%'
			AND Empresa_id = " . $this->user->Empresa_id . "
			ORDER BY Nombre
			LIMIT 10
		";		

		return $this->db->query($sql)->result();
	}
}