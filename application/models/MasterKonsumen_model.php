<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterKonsumen_model extends CI_Model {

	public function get_data($table)
	{
		return $this->db->get($table);
	}	

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function update_data($data, $table)
	{
		$this->db->where('id_konsumen', $data['id_konsumen']);
		$this->db->update($table, $data);
	}

	public function delete($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

}

/* End of file MasterKonsumen_model.php */
/* Location: ./application/models/MasterKonsumen_model.php */