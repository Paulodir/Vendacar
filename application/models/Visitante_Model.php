<?php

class Visitante_Model extends CI_Model {

    public function getLastVeiculos() {
        $this->db->select("veiculo.*,CONCAT(nomeMontadora, ' ',nomeModelo) AS 'nomeVeiculo',montadora.nomeMontadora");
        $this->db->select("(SELECT COUNT(veiculo_id) FROM notafiscal WHERE veiculo_id=veiculo.id) as veiculoEmUso");
        $this->db->from('veiculo');
        $this->db->join('modelo', 'modelo.id = veiculo.modelo_id', 'inner');
        $this->db->join('montadora', 'montadora.id=modelo.montadora_id', 'inner');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        return $query->result();
    }

    public function getPrimeiraFoto() {
        $this->db->select("foto.*,MIN(foto.id) AS 'foto_id'");
        $this->db->from('foto');
        $this->db->group_by('foto.veiculo_id');
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        return $query->result();
    }

    public function getAcessorios() {
        $this->db->select("veiculo.id,IFNULL(descricaoAcessorio, 'Sem Acessórios Cadastrados')AS opcionais,tipoAcessorio");
        $this->db->from('veiculo');
        $this->db->join('veiculoacessorio', 'veiculoacessorio.veiculo_id=veiculo.id', 'LEFT');
        $this->db->join('acessorio', 'veiculoacessorio.acessorio_id=acessorio.id', 'LEFT');
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        return $query->result();
    }

    public function getAllVeiculos() {
        $this->db->select("veiculo.*,CONCAT(nomeMontadora, ' ',nomeModelo) AS 'nomeVeiculo',montadora.nomeMontadora");
        $this->db->select("(SELECT COUNT(veiculo_id) FROM notafiscal WHERE veiculo_id=veiculo.id) as veiculoEmUso");
        $this->db->from('veiculo');
        $this->db->join('modelo', 'modelo.id = veiculo.modelo_id', 'inner');
        $this->db->join('montadora', 'montadora.id=modelo.montadora_id', 'inner');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        return $query->result();
    }

}
