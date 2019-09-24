<?php

class Veiculo_Model extends CI_Model {

    const table = 'veiculo';

    public function getAll() {
        $this->db->select("veiculo.*,CONCAT(nomeMontadora, ' ',nomeModelo) AS 'nomeVeiculo',");
        $this->db->select("(SELECT COUNT(veiculo_id) FROM notafiscal WHERE veiculo_id=veiculo.id) as veiculoEmUso");
        $this->db->from(self::table);
        $this->db->join('modelo', 'modelo.id = veiculo.modelo_id', 'inner');
        $this->db->join('montadora', 'montadora.id=modelo.montadora_id', 'inner');
        $this->db->order_by('nomeVeiculo');
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        return $query->result();
    }

    public function getMontadoras() {
        $query = $this->db->get('montadora');
        return $query->result();
    }

    public function getModelos() {
        $query = $this->db->get('modelo');
        return $query->result();
    }

    public function getModelosByMontadora($montadora_id = null) {
        $this->db->where('montadora_id', $montadora_id);
        $this->db->order_by('nomeModelo');
        $query = $this->db->get('modelo');
        //echo $this->db->last_query();exit; 
        return $query->result();
    }

    public function insert($data = array()) {
        $this->db->insert(self::table, $data);
        return $this->db->affected_rows();
    }

    public function getOne($id) {
        $this->db->select("veiculo.*,CONCAT(nomeMontadora,' ',nomeModelo) AS 'nomeVeiculo',montadora_id");
        $this->db->join('modelo', 'modelo.id = veiculo.modelo_id', 'inner');
        $this->db->join('montadora', 'montadora.id=modelo.montadora_id', 'inner');
        $query = $this->db->get_where(self::table, array('veiculo.id' => $id));
        //echo $this->db->last_query();exit; 
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

    public function getAcessoriosByVeiculo($veiculo_id = null) {
        $this->db->select('veiculoacessorio.*,');
        $this->db->select('acessorio.descricaoAcessorio, acessorio.tipoAcessorio, acessorio.valorAcessorio');
        $this->db->from(self::table);
        $this->db->join('veiculoacessorio', 'veiculoacessorio.veiculo_id=veiculo.id', 'left');
        $this->db->join('acessorio', 'veiculoacessorio.acessorio_id=acessorio.id', 'left');
        $this->db->where('veiculo_id', $veiculo_id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    public function deleteAcessorios($id) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->delete('veiculoacessorio');
            //echo $this->db->last_query();exit;
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    public function insertAcessorios($data = array()) {
        $this->db->insert('veiculoacessorio', $data);
        return $this->db->affected_rows();
    }

    public function getValorVeiculo($veiculo_id = null) {
        $this->db->select('veiculo.valorVeiculo');
        $this->db->from(self::table);
        $this->db->where('id', $veiculo_id);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result();
    }

}
