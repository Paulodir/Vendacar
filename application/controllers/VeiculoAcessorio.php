<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class VeiculoAcessorio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        //$this->load->model('Usuario_model');
        //$this->Usuario_model->verificaLogin();
        $this->load->model('VeiculoAcessorio_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar($id) {
        $this->load->model('Veiculo_Model');
        $data['veiculo'] = $this->Veiculo_Model->getOne($id);
        $data['veiculoacessorios'] = $this->VeiculoAcessorio_Model->getAcessoriosByVeiculo($id);
        $this->load->view('Fixo/Header');
        $this->load->view('Veiculo/Acessorios', $data);
        $this->load->view('Fixo/Footer');
    }

    public function incluirAcessorios($id) {
        $this->form_validation->set_rules('Veiculo', 'Veiculo', 'required');
        $this->form_validation->set_rules('Acessorio', 'Acessorio', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->model('Veiculo_Model');
            $data['veiculos'] = $this->Veiculo_Model->getAll();
            $data['veiculo'] = $this->Veiculo_Model->getOne($id);
            $this->load->model('Acessorio_Model');
            $data['acessorios'] = $this->Acessorio_Model->getAll();
            $this->load->view('Fixo/Header');
            $this->load->view('Veiculo/AdicionaAcessorios', $data);
            $this->load->view('Fixo/Footer');
        } else {
            $data = array(
                'acessorio_id' => $this->input->post('Acessorio'),
                'veiculo_id' => $this->input->post('Veiculo')
            );
            if ($this->VeiculoAcessorio_Model->insertAcessorios($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Acessório adicionado ao Veículo com sucesso</div>');
                redirect('VeiculoAcessorio/listar/' . $id);
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao Adicionar Acessório!!!</div>');
                redirect('Veiculo/incluirAcessorios' . $id);
            }
        }
    }

    public function AlterarAcessorios($id, $veiculo_id) {
        if ($id > 0) {
            $this->form_validation->set_rules('Veiculo', 'Veiculo', 'required');
            $this->form_validation->set_rules('Acessorio', 'Acessorio', 'required');
            if ($this->form_validation->run() == false) {
                $data['veiculoacessorios'] = $this->VeiculoAcessorio_Model->getAcessoriosByVeiculo($id);
                $this->load->model('Veiculo_Model');
                $data['veiculos'] = $this->Veiculo_Model->getAll();
                $this->load->model('Acessorio_Model');
                $data['acessorios'] = $this->Acessorio_Model->getAll();
                $data['veiculoacessorio'] = $this->VeiculoAcessorio_Model->getOne($id);
                $this->load->view('Fixo/Header');
                $this->load->view('Veiculo/AdicionaAcessorios', $data);
                $this->load->view('Fixo/Footer');
            } else {
                $data = array(
                    'acessorio_id' => $this->input->post('Acessorio'),
                    'veiculo_id' => $this->input->post('Veiculo')
                );
                if ($this->VeiculoAcessorio_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Acessório adicionado ao Veículo com sucesso</div>');
                    redirect('VeiculoAcessorio/listar/' . $veiculo_id);
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao Adicionar Acessório!!!</div>');
                    redirect('Veiculo/incluirAcessorios' . $veiculo_id);
                }
            }
        } else {
            redirect('VeiculoAcessorio/listar/' . $veiculo_id);
        }
    }

    public function deletarAcessorios($id, $veiculo_id) {
        if (($id > 0)) {

            if ($this->VeiculoAcessorio_Model->deleteAcessorios($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Acessório deletado do Veículo com sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar Acessório do Veículo...</div>');
            }
        }
        redirect('VeiculoAcessorio/listar/' . $veiculo_id);
    }

}
