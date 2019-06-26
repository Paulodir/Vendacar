<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Model extends CI_Model {

    const table = 'usuario';

    public function login($email, $senha) {
        $this->db->where('email', $email);
        $this->db->where('senha', sha1($senha . 'paulodirSENAC'));
        $usuario = $this->db->get('usuario');
        return $usuario->row(0);
    }

    public function verificaLogin() {
        //resgata na sessao o status logado e o id do usuario
        $logado = $this->session->userdata('logado');
        $idUsuario = $this->session->userdata('idUsuario');
        //verifica se o status esta setado, ou nao essta true,ou naao tem idUsuario
        if ((!isset($logado)) || ($logado != true) || ( $idUsuario <= 0)) {
            //redireciona obrigando a logar
            redirect($this->config->base_url() . 'Usuario/logar');
        }
    }

    public function getAll() {
        $this->db->select('id,email');
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

    public function getPass($email = null) {
        $this->db->select('usuario.senha');
        $this->db->from(self::table);
        $this->db->where('email', $email);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    public function updatePass($email, $data = array()) {
        if ($email != null) {
            $this->db->where('email', $email);
            $this->db->update(self::table, $data);
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

}
