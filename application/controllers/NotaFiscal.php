<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class NotaFiscal extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
//        $this->load->model('Usuario_model');
//        $this->Usuario_model->verificaLogin();
        $this->load->model('NotaFiscal_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['notasfiscais'] = $this->NotaFiscal_Model->getAll();
        $this->load->view('Fixo/Header');
        $this->load->view('NotaFiscal/lista', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
        $this->form_validation->set_rules('NotaFiscal', 'NotaFiscal', 'required');
        $this->form_validation->set_rules('Montadora', 'Montadora', 'required');
        $this->form_validation->set_rules('Categoria', 'Categoria', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('Fixo/Header');
            $this->load->view('NotaFiscal/Formulario', $data);
            $this->load->view('Fixo/Footer');
        } else {
            $this->load->model('NotaFiscal_Model');
            $data = array(
                'nomeNotaFiscal' => $this->input->post('NotaFiscal'),
                'montadora_id' => $this->input->post('Montadora'),
                'tipoNotaFiscal' => $this->input->post('Categoria')
            );
            if ($this->NotaFiscal_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> NotaFiscal cadastrado com sucesso</div>');
                redirect('NotaFiscal/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao cadastrar NotaFiscal!!!</div>');
                redirect('NotaFiscal/cadastrar');
            }
        }
    }

    public function alterar($id) {
        if ($id > 0) {
            $this->form_validation->set_rules('NotaFiscal', 'NotaFiscal', 'required');
            $this->form_validation->set_rules('Montadora', 'Montadora', 'required');
            $this->form_validation->set_rules('Categoria', 'Categoria', 'required');
            if ($this->form_validation->run() == false) {
                $data['notafiscal'] = $this->NotaFiscal_Model->getOne($id);
                $this->load->view('Fixo/Header');
                $this->load->view('NotaFiscal/Formulario', $data);
                $this->load->view('Fixo/Footer');
            } else {
                $data = array(
                    'nomeNotaFiscal' => $this->input->post('NotaFiscal'),
                    'montadora_id' => $this->input->post('Montadora'),
                    'tipoNotaFiscal' => $this->input->post('Categoria')
                );
                if ($this->NotaFiscal_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> NotaFiscal alterado com sucesso!</div>');
                    redirect('NotaFiscal/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao alterar NotaFiscal...</div>');
                    redirect('NotaFiscal/alterar/' . $id);
                }
            }
        } else {
            redirect('NotaFiscal/listar');
        }
    }

    public function deletar($id) {
        if ($id > 0) {
            if ($this->NotaFiscal_Model->delete($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> NotaFiscal deletado com sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar NotaFiscal...</div>');
            }
        }
        redirect('NotaFiscal/listar');
    }

    public function indisponivel() {
        $this->session->set_flashdata('retorno', '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Não é possivel deletar NotaFiscals com Veículos cadastrados. Caso desejar deletar este NotaFiscal exclua primeiramente os Veículos...</div>');
        redirect('NotaFiscal/listar');
    }

}
