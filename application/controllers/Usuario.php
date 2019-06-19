<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function index() {
        $this->load->view('Login');
    }

    public function logar() {
        //cria as regras de validação do formulário
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        
        $this->form_validation->set_rules('senha', 'senha', 'required');
 
        if ($this->form_validation->run() == false) {

            $this->load->view('Login');
        } else {
            $this->load->model('Usuario_model');
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');
            $usuario = $this->Usuario_model->login($email, $senha);
            if ($usuario) {
                $data=array(
                    'idUsuario'=> $usuario->id,
                    'email'=>$usuario->email,
                    'logado'=>TRUE
                );
                $this->session->set_userdata($data);
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Usuario '.$email.' logado.</div>');
                redirect($this->config->base_url()); 
            } else {
                $this->session->set_flashdata('retorno', '<div class=" alert alert-danger"><i class="far fa-hand-paper"></i> Usuario ou senha incoretos...</div>');                
            }redirect(base_url('Usuario/logar'));
        }
    }
    public function deslogar() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}