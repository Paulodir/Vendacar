<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class Acessorio extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        $this->load->model('Usuario_Model');
        $this->Usuario_Model->verificaLogin();
        $this->load->model('Acessorio_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['acessorios'] = $this->Acessorio_Model->getAll();
        $this->load->view('Fixo/Header');
        $this->load->view('Acessorio/Lista', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
        $this->form_validation->set_rules('Acessorio', 'Acessório', 'required');
        $this->form_validation->set_rules('Tipo', 'Tipo do Acessório', 'required');
        $this->form_validation->set_rules('Valor', 'Valor', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('Fixo/Header');
            $this->load->view('Acessorio/Formulario');
            $this->load->view('Fixo/Footer');
        } else {
            $this->load->model('Acessorio_Model');
            $data = array(
                'descricaoAcessorio' => $this->input->post('Acessorio'),
                'tipoAcessorio' => $this->input->post('Tipo'),
                'valorAcessorio' => str_replace(',', '.', str_replace('.', '', $this->input->post('Valor')))
            );
            if ($this->Acessorio_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Acessório Cadastrado com Sucesso!</div>');
                redirect('Acessorio/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Erro ao Cadastrar Acessório!!!</div>');
                redirect('Acessorio/cadastrar');
            }
        }
    }

    public function alterar($id) {
        if ($id > 0) {
            $this->form_validation->set_rules('Acessorio', 'Acessório', 'required');
            $this->form_validation->set_rules('Tipo', 'Tipo do Acessório', 'required');
            $this->form_validation->set_rules('Valor', 'Valor', 'required');
            if ($this->form_validation->run() == false) {
                $data['acessorio'] = $this->Acessorio_Model->getOne($id);
                $this->load->view('Fixo/Header');
                $this->load->view('Acessorio/Formulario', $data);
                $this->load->view('Fixo/Footer');
            } else {
                $data = array(
                    'descricaoAcessorio' => $this->input->post('Acessorio'),
                    'tipoAcessorio' => $this->input->post('Tipo'),
                    'valorAcessorio' =>str_replace(',', '.', str_replace('.', '', $this->input->post('Valor')))
                );
                if ($this->Acessorio_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Acessório Alterado com Sucesso!</div>');
                    redirect('Acessorio/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Falha ao Alterar Acessório...</div>');
                    redirect('Acessorio/alterar/' . $id);
                }
            }
        } else {
            redirect('Acessorio/listar');
        }
    }

    public function deletar($id) {
        if ($id > 0) {
            if ($this->Acessorio_Model->delete($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Acessório Deletado com Sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Falha ao Deletar Acessório...</div>');
            }
        }
        redirect('Acessorio/listar');
    }

}
