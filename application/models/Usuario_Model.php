<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function login($email, $senha) {
        $this->db->where('email', $email);
        $this->db->where('senha', sha1($senha.'paulodirSENAC'));
        $usuario = $this->db->get('usuario');
        return $usuario->row(0);
    }

    /*
     * metodo que verifica se o usuario esta logado
     */

    public function verificaLogin() {
        //resgata na sessao o status logado e o id do usuario
        $logado = $this->session->userdata('logado');
        $idUsuario = $this->session->userdata('idUsuario');
        //verifica se o status esta setado, ou nao essta true,ou naao tem idUsuario
        if ((!isset($logado)) || ($logado != true) || ( $idUsuario <= 0)) {
            //redireciona obrigando a logar
            redirect($this->config->base_url().'Usuario/logar');
        }
    }

}
