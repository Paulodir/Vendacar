<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class FormaPagamento extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        $this->load->model('Usuario_Model');
        $this->Usuario_Model->verificaLogin();
        $this->load->model('FormaPagamento_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['formaspagamento'] = $this->FormaPagamento_Model->getAll();
        $this->load->view('Fixo/Header');
        $this->load->view('FormaPagamento/Lista', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
            $this->form_validation->set_rules('Pagamento', 'Forma de Pagamento', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('Fixo/Header');
            $this->load->view('FormaPagamento/Formulario');
            $this->load->view('Fixo/Footer');
        } else {
            $this->load->model('FormaPagamento_Model');
            $data = array(
                'descricaoPagamento' => $this->input->post('Pagamento')
            );
            if ($this->FormaPagamento_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Forma de Pagamento Cadastrado com Sucesso!</div>');
                redirect('FormaPagamento/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao Cadastrar Forma de Pagamento!!!</div>');
                redirect('FormaPagamento/cadastrar');
            }
        }
    }

    public function alterar($id) {
        if ($id > 0) {
            $this->form_validation->set_rules('Pagamento', 'Forma de Pagamento', 'required');
            if ($this->form_validation->run() == false) {
                $data['formapagamento'] = $this->FormaPagamento_Model->getOne($id);
                $this->load->view('Fixo/Header');
                $this->load->view('FormaPagamento/Formulario', $data);
                $this->load->view('Fixo/Footer');
            } else {
                $data = array(
                    'descricaoPagamento' => $this->input->post('Pagamento')
                );
                if ($this->FormaPagamento_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Descriçao da Forma de Pagamento Alterada com Sucesso!</div>');
                    redirect('FormaPagamento/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Alterar Forma de Pagamento...</div>');
                    redirect('FormaPagamento/alterar/' . $id);
                }
            }
        } else {
            redirect('FormaPagamento/listar');
        }
    }

    public function deletar($id) {
        if ($id > 0) {
            if ($this->FormaPagamento_Model->delete($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Forma Pagamento Deletada com Sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar Forma Pagamento...</div>');
            }
        }
        redirect('FormaPagamento/listar');
    }

    public function indisponivel() {
        $this->session->set_flashdata('retorno', '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Não é possivel deletar Formas de Pagamento que foram utilizadas em notas fiscais emitidas...</div>');
        redirect('FormaPagamento/listar');
    }

}
