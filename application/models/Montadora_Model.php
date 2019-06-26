<?php

class Montadora_Model extends CI_Model {
    const table = 'montadora';
    public function getAll($data='*') {
        $this->db->select($data);
        $query = $this->db->get(self::table);
        //echo $this->db->last_query();exit; comando que mostra como é feita a consulta no banco
        return $query->result();
    }
    public function insert($data = array()) {
        $this->db->insert(self::table, $data);
        return $this->db->affected_rows();
    }
    public function getOne($id) {
        $query = $this->db->get_where(self::table, array('id'=>$id));
        return $query->row();
    }
    public function update($id, $data = array()) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->update(self::table, $data);
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }
    public function delete($id) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->delete(self::table);
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }
}
