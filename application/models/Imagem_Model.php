<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Imagem_Model extends CI_Model {

    const table = 'foto';

    public function getFotoByVeiculo($veiculo_id = null) {
        $this->db->select('foto.*,');
        $this->db->from(self::table);
        $this->db->join('veiculo', 'foto.veiculo_id=veiculo.id', 'inner');
        $this->db->where('veiculo_id', $veiculo_id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result();
    }
    public function insert($data = array()) {
        $insert = $this->db->insert_batch(self::table, $data);
        // echo $this->db->last_query();exit;
        return $insert ? true : false;
    }
    public function getOne($id) {
        $query = $this->db->get_where(self::table, array('id' => $id));
        return $query->result();
    }

    public function delete($id) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->delete(self::table);
            //echo $this->db->last_query();exit;
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

}
