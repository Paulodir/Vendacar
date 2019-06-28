<?php

class NotaFiscal_Model extends CI_Model {

    const table = 'notafiscal';

    public function getAll() {
        $this->db->select("notafiscal.*,DATE_FORMAT(dataEmissao,'%d/%m/%Y %Hh:%im:%ss ') AS dataHora");
        $this->db->select(",CONCAT(nomeMontadora, ' ',nomeModelo) AS 'nomeVeiculo'");
        $this->db->select(",funcionario.nomeFuncionario");
        $this->db->select(",cliente.nomeCliente");
        //(SELECT COUNT(modelo_id) FROM veiculo WHERE modelo_id=modelo.id) as ModeloEmUso
        $this->db->from(self::table);
        $this->db->join('funcionario', 'funcionario.id = notafiscal.funcionario_id', 'inner');
        $this->db->join('cliente', 'cliente.id = notafiscal.cliente_id', 'inner');
        $this->db->join('veiculo', 'veiculo.id = notafiscal.veiculo_id', 'inner');
        $this->db->join('modelo', 'modelo.id = veiculo.modelo_id', 'inner');
        $this->db->join('montadora', 'montadora.id = modelo.montadora_id', 'inner');
        //nome da tabela no banco de dados  
        $this->db->order_by('notafiscal.id');
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

    public function cancel($id) {
        if ($id > 0) {
            $this->db->where('id', $id);            
            $this->db->update(self::table, array('status' => 0));
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

}
