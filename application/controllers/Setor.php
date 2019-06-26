<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class Setor extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        $this->load->model('Usuario_Model');
        $this->Usuario_Model->verificaLogin();
        $this->load->model('Setor_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['setores'] = $this->Setor_Model->getAll();
        $this->load->view('Fixo/Header');
        $this->load->view('Setor/ListaSetores', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
        $this->form_validation->set_rules('Setor', 'Setor', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('Fixo/Header');
            $this->load->view('Setor/FormularioSetor');
            $this->load->view('Fixo/Footer');
        } else {
            $this->load->model('Setor_Model');
            $data = array(
                'nomeSetor' => $this->input->post('Setor')
            );
            if ($this->Setor_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Setor cadastrado com sucesso</div>');
                redirect('Setor/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao cadastrar Setor!!!</div>');
                redirect('Setor/cadastrar');
            }
        }
    }

    public function alterar($id) {
        if ($id > 0) {
            $this->form_validation->set_rules('Setor', 'Setor', 'required');
            if ($this->form_validation->run() == false) {
                $data['setor'] = $this->Setor_Model->getOne($id);
                $this->load->view('Fixo/Header');
                $this->load->view('Setor/FormularioSetor', $data);
                $this->load->view('Fixo/Footer');
            } else {
                $data = array(
                    'nomeSetor' => $this->input->post('Setor')
                );
                if ($this->Setor_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Setor alterado com sucesso!</div>');
                    redirect('Setor/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao alterar Setor...</div>');
                    redirect('Setor/alterar/' . $id);
                }
            }
        } else {
            redirect('Setor/listar');
        }
    }

    public function deletar($id) {
        if ($id > 0) {
            if ($this->Setor_Model->delete($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Setor deletado com sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar Setor...</div>');
            }
        }
        redirect('Setor/listar');
    }

    public function indisponivel() {
        $this->session->set_flashdata('retorno', '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Não é possivel deletar Setores com Funcionários...</div>');
        redirect('Setor/listar');
    }

}
