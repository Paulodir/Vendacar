<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class Modelo extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        $this->load->model('Usuario_Model');
        $this->Usuario_Model->verificaLogin();
        $this->load->model('Modelo_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['modelos'] = $this->Modelo_Model->getAll();
        $this->load->view('Fixo/Header');
        $this->load->view('Modelo/ListaModelos', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
        $this->form_validation->set_rules('Modelo', 'Modelo', 'required');
        $this->form_validation->set_rules('Montadora', 'Montadora', 'required');
        $this->form_validation->set_rules('Categoria', 'Categoria', 'required');
        if ($this->form_validation->run() == false) {
            $data['montadoras'] = $this->Modelo_Model->getMontadoras();
            $this->load->view('Fixo/Header');
            $this->load->view('Modelo/FormularioModelo', $data);
            $this->load->view('Fixo/Footer');
        } else {
            $this->load->model('Modelo_Model');
            $data = array(
                'nomeModelo' => $this->input->post('Modelo'),
                'montadora_id' => $this->input->post('Montadora'),
                'tipoModelo' => $this->input->post('Categoria')
            );
            if ($this->Modelo_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Modelo cadastrado com sucesso</div>');
                redirect('Modelo/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao cadastrar Modelo!!!</div>');
                redirect('Modelo/cadastrar');
            }
        }
    }

    public function alterar($id) {
        if ($id > 0) {
            $this->form_validation->set_rules('Modelo', 'Modelo', 'required');
            $this->form_validation->set_rules('Montadora', 'Montadora', 'required');
            $this->form_validation->set_rules('Categoria', 'Categoria', 'required');
            if ($this->form_validation->run() == false) {
                $data['modelo'] = $this->Modelo_Model->getOne($id);
                $data['montadoras'] = $this->Modelo_Model->getMontadoras();
                $this->load->view('Fixo/Header');
                $this->load->view('Modelo/FormularioModelo', $data);
                $this->load->view('Fixo/Footer');
            } else {
                $data = array(
                    'nomeModelo' => $this->input->post('Modelo'),
                    'montadora_id' => $this->input->post('Montadora'),
                    'tipoModelo' => $this->input->post('Categoria')
                );
                if ($this->Modelo_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Modelo alterado com sucesso!</div>');
                    redirect('Modelo/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao alterar Modelo...</div>');
                    redirect('Modelo/alterar/' . $id);
                }
            }
        } else {
            redirect('Modelo/listar');
        }
    }

    public function deletar($id) {
        if ($id > 0) {
            if ($this->Modelo_Model->delete($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Modelo deletado com sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar Modelo...</div>');
            }
        }
        redirect('Modelo/listar');
    }

    public function indisponivel() {
        $this->session->set_flashdata('retorno', '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Não é possivel deletar Modelos com Veículos cadastrados. Caso desejar deletar este Modelo exclua primeiramente os Veículos...</div>');
        redirect('Modelo/listar');
    }

}
