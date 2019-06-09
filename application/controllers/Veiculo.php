<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class Veiculo extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        //$this->load->model('Usuario_model');
        //$this->Usuario_model->verificaLogin();
        $this->load->model('Veiculo_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['veiculos'] = $this->Veiculo_Model->getAll();
        $this->load->view('Fixo/Header');
        $this->load->view('Veiculo/ListaVeiculos', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
        $this->form_validation->set_rules('Modelo', 'Modelo', 'required');
        $this->form_validation->set_rules('Montadora', 'Montadora', 'required');
        $this->form_validation->set_rules('Ano', 'Ano', 'required');
        $this->form_validation->set_rules('Cor', 'Cor', 'required');
        $this->form_validation->set_rules('Renavam', 'Renavam', 'required');
        $this->form_validation->set_rules('Valor', 'Valor', 'required');
        if ($this->form_validation->run() == false) {
            $data['montadoras'] = $this->Veiculo_Model->getMontadoras();
            $this->load->view('Fixo/Header');
            $this->load->view('Veiculo/FormularioVeiculo', $data);
            $this->load->view('Fixo/Footer');
        } else {
            $this->load->model('Veiculo_Model');
            $data = array(
                'modelo_id' => $this->input->post('Modelo'),
                'Ano' => $this->input->post('Ano'),
                'cor' => $this->input->post('Cor'),
                'renavam' => $this->input->post('Renavam'),
                'valorVeiculo' => $this->input->post('Valor')
            );
            if ($this->Veiculo_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Veiculo cadastrado com sucesso</div>');
                redirect('Veiculo/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao cadastrar Veiculo!!!</div>');
                redirect('Veiculo/cadastrar');
            }
        }
    }

    
    public function deletar($id) {
        if ($id > 0) {
            if ($this->Veiculo_Model->delete($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Veiculo deletado com sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar Veiculo...</div>');
            }
        }
        redirect('Veiculo/listar');
    }

    public function indisponivel() {
        $this->session->set_flashdata('retorno', '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Não é possivel deletar Veículos que estão inseridos em Notas Fiscais cadastradas. Caso desejar deletar este Veículo verifique se há alguma nota fiscal de saida do mesmo</div>');
        redirect('Veiculo/listar');
    }
    public function getModelos() {
        $montadora_id=$this->input->post('montadora_id');
        echo $this->Veiculo_Model->selectModelos($montadora_id);
    }
}
