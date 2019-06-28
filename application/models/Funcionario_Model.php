<?php

class Funcionario_Model extends CI_Model {

    const table = 'funcionario';

    public function getAll() {
        $this->db->select("funcionario.*,setor.nomeSetor,DATE_FORMAT(dataNascimento,'%d/%m/%Y') AS nascimento");
        $this->db->select('(SELECT COUNT(funcionario_id) FROM notafiscal WHERE funcionario_id=funcionario.id) as funcionarioEmUso');
        $this->db->from(self::table);
        $this->db->join('setor', 'setor.id = funcionario.setor_id', 'inner');
        //nome da tabela no banco de dados  
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
