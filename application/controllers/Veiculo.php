<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Veiculo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        $this->load->model('Usuario_Model');
        $this->Usuario_Model->verificaLogin();
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
        $this->form_validation->set_rules('Placa', 'Placa', 'required');
        $this->form_validation->set_rules('Renavam', 'Renavam', 'required');
        $this->form_validation->set_rules('Valor', 'Valor', 'required');
        if ($this->form_validation->run() == false) {
            $data['montadoras'] = $this->Veiculo_Model->getMontadoras();
            $this->load->view('Fixo/Header');
            $this->load->view('Veiculo/FormularioVeiculo', $data);
            $this->load->view('Fixo/Footer');
        } else {
            $this->load->model('Setor_Model');
            $this->load->model('Veiculo_Model');
            $data = array(
                'modelo_id' => $this->input->post('Modelo'),
                'Ano' => $this->input->post('Ano'),
                'cor' => $this->input->post('Cor'),
                'placa' => strtoupper($this->input->post('Placa')),
                'renavam' => $this->input->post('Renavam'),
                'valorVeiculo' => str_replace(',', '.', str_replace('.', '', $this->input->post('Valor')))
            );
            if ($this->Veiculo_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Veículo Cadastrado com Sucesso!</div>');
                redirect('Veiculo/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Erro ao Cadastrar Veículo!!!</div>');
                redirect('Veiculo/cadastrar');
            }
        }
    }

    public function getModelosAjax() {
        $montadora_id = $this->input->post('montadora_id');
        echo $this->selectModelos($montadora_id);
    }

    public function selectModelos($montadora_id = null) {
        $modelos = $this->Veiculo_Model->getModelosByMontadora($montadora_id);
        $options = '<option>Selecione o Modelo</option>';
        foreach ($modelos as $modelo) {
            $options .= '<option value="' . $modelo->id . '">' . $modelo->nomeModelo . '</option>' . PHP_EOL;
        }
        return $options;
        //$this->db->last_query();exit;
    }

    public function alterar($id) {
        if ($id > 0) {
            $this->form_validation->set_rules('Modelo', 'Modelo', 'required');
            $this->form_validation->set_rules('Montadora', 'Montadora', 'required');
            $this->form_validation->set_rules('Ano', 'Ano', 'required');
            $this->form_validation->set_rules('Cor', 'Cor', 'required');
            $this->form_validation->set_rules('Placa', 'Placa', 'required');
            $this->form_validation->set_rules('Renavam', 'Renavam', 'required');
            $this->form_validation->set_rules('Valor', 'Valor', 'required');
            if ($this->form_validation->run() == false) {
                $data['veiculo'] = $this->Veiculo_Model->getOne($id);
                $data['montadoras'] = $this->Veiculo_Model->getMontadoras();
                $data['modelos'] = $this->Veiculo_Model->getModelos();
                $this->load->view('Fixo/Header');
                $this->load->view('Veiculo/FormularioVeiculo', $data);
                $this->load->view('Fixo/Footer');
            } else {
                $data = array(
                    'modelo_id' => $this->input->post('Modelo'),
                    'Ano' => $this->input->post('Ano'), 
                    'cor' => $this->input->post('Cor'),
                    'placa' => strtoupper($this->input->post('Placa')),
                    'renavam' => $this->input->post('Renavam'),
                    'valorVeiculo' => str_replace(',', '.', str_replace('.', '', $this->input->post('Valor')))
                );
                if ($this->Veiculo_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Veículo Alterado com Sucesso!</div>');
                    redirect('Veiculo/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Falha ao Alterar Veículo...</div>');
                    redirect('Veiculo/alterar/' . $id);
                }
            }
        } else {
            redirect('Veiculo/Acessorios');
        }
    }

    public function deletar($id) {
        if ($id > 0) {
            if ($this->Veiculo_Model->delete($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Veiculo deletado com Sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Falha ao Deletar Veiculo...</div>');
            }
        }
        redirect('Veiculo/listar');
    }

    public function indisponivel() {
        $this->session->set_flashdata('retorno', '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Não é possivel Deletar Veículos que estão inseridos em Notas Fiscais Emitidas. Caso desejar deletar este Veículo verifique se há alguma nota fiscal de saída do mesmo.</div>');
        redirect('Veiculo/listar');
    }

    public function getValorAjax() {
        $veiculo_id = $this->input->post('veiculo_id');
        $valorVeiculo = $this->Veiculo_Model->getValorVeiculo($veiculo_id);
        foreach ($valorVeiculo as $valor)
            echo $valor->valorVeiculo;
    }

}
