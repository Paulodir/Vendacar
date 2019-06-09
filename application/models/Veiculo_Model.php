<?php

class Veiculo_Model extends CI_Model {

    const table = 'veiculo';

    public function getAll() {
        $this->db->select("veiculo.*,CONCAT(nomeMontadora, ' ',nomeModelo) AS 'Veiculo',(SELECT COUNT(veiculo_id) FROM notafiscal WHERE veiculo_id=veiculo.id) as veiculoEmUso");
        //(SELECT COUNT(modelo_id) FROM veiculo WHERE veiculo_id=veiculo.id) as ModeloEmUso
        $this->db->from(self::table);
        $this->db->join('modelo', 'modelo.id = veiculo.modelo_id', 'inner');
        $this->db->join('montadora', 'montadora.id=modelo.montadora_id', 'inner');
        $this->db->order_by('modelo_id');
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        return $query->result();
    }

    public function getMontadoras() {
        $query = $this->db->get('Montadora');
        return $query->result();
    }

    //public function getModelos() {
    //$query = $this->db->get('modelo');
    // return $query->result();
    //}

    public function getModelosByMontadora($montadora_id = null) {
        $this->db->where('montadora_id', $montadora_id);
        $this->db->order_by('nomeModelo');
        $query = $this->db->get('modelo');
        //echo $this->db->last_query();exit; 
        return $query->result();;
    }

    public function selectModelos($montadora_id = null) {
        $modelos = $this->getModelosByMontadora($montadora_id);
        $options = '<option>Selecione o Modelo</option>';
        foreach ($modelos as $modelo) {
            $options .= '<option value=' . $modelo->id . '">' . $modelo->nomeModelo . '</option>' . PHP_EOL;
        }
        return $options;
        //$this->db->last_query();exit;
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
