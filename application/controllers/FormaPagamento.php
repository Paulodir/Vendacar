<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class FormaPagamento extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        //$this->load->model('Usuario_model');
        //$this->Usuario_model->verificaLogin();
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
            $this->form_validation->set_rules('Pagamento', 'Pagamento', 'required');
             $this->form_validation->set_rules('555', 'Forma de Pagamento', 'required');
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
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> FormaPagamento cadastrado com sucesso</div>');
                redirect('FormaPagamento/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao cadastrar FormaPagamento!!!</div>');
                redirect('FormaPagamento/cadastrar');
            }
        }
    }

    public function alterar($id) {
        if ($id > 0) {
            $this->form_validation->set_rules('Pagamento', 'Pagamento', 'required');
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
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> FormaPagamento alterado com sucesso!</div>');
                    redirect('FormaPagamento/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao alterar FormaPagamento...</div>');
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
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> FormaPagamento deletado com sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar FormaPagamento...</div>');
            }
        }
        redirect('FormaPagamento/listar');
    }

    public function indisponivel() {
        $this->session->set_flashdata('retorno', '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Não é possivel deletar FormaPagamentos com notas fiscais emitidas em seu nome ou FormaPagamentos que se tornaram Funcionários...</div>');
        redirect('FormaPagamento/listar');
    }

}
