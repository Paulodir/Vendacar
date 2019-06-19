<?php

class VeiculoAcessorio_Model extends CI_Model {

    const table = 'veiculoacessorio';

    public function getAcessoriosByVeiculo($veiculo_id = null) {
        $this->db->select('veiculoacessorio.*,');
        $this->db->select('acessorio.descricaoAcessorio, acessorio.tipoAcessorio, acessorio.valorAcessorio');
        $this->db->from('veiculo');
        $this->db->join('veiculoacessorio', 'veiculoacessorio.veiculo_id=veiculo.id', 'left');
        $this->db->join('acessorio', 'veiculoacessorio.acessorio_id=acessorio.id', 'left');
        $this->db->where('veiculo_id', $veiculo_id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    public function getOne($id) {
        $query = $this->db->get_where(self::table, array('id' => $id));
        return $query->row();
    }

    public function insertAcessorios($data = array()) {
        $this->db->insert(self::table, $data);
        return $this->db->affected_rows();
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

    public function deleteAcessorios($id) {
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
