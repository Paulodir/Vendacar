<?php

class Modelo_Model extends CI_Model {

    const table = 'modelo';

    public function getAll() {
        $this->db->select("modelo.*,(montadora.nomeMontadora) AS Montadora,(SELECT COUNT(modelo_id) FROM veiculo WHERE modelo_id=modelo.id) as modeloEmUso");
        //(SELECT COUNT(modelo_id) FROM veiculo WHERE modelo_id=modelo.id) as ModeloEmUso
        $this->db->from(self::table);
        $this->db->join('montadora', 'montadora.id = modelo.montadora_id', 'inner');
        //nome da tabela no banco de dados  
        $this->db->order_by('nomeMontadora');
        $query = $this->db->get();
        //echo $this->db->last_query();exit; 
        //result já nos retorna em formato de array
        return $query->result();
    }

    public function getMontadoras() {
        $query = $this->db->get('montadora');
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
