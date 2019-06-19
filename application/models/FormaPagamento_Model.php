<?php

class FormaPagamento_Model extends CI_Model {

    const table = 'formapagamento';

    public function getAll() {
        $this->db->select('formapagamento.*,');
        $this->db->select('(SELECT COUNT(formaPagamento_id) FROM notafiscal WHERE formaPagamento_id=formapagamento.id) as formaPagamentoEmUso');
        $this->db->from(self::table);
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        return $query->result();
    }

    public function insert($data = array()) {
        $this->db->insert(self::table, $data);
        return $this->db->affected_rows();
    }

    public function getOne($id) {
        $query = $this->db->get_where(self::table, array('id' => $id));
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
