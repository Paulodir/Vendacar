<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Veiculo extends CI_Controller {

    public function __construct() {
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

    public function getModelosAjax() {
        $montadora_id = $this->input->post('montadora_id');
        echo $this->selectModelos($montadora_id);
    }

    public function selectModelos($montadora_id = null) {
        $modelos = $this->Veiculo_Model->getModelosByMontadora($montadora_id);
        $options = '<option>Selecione o Modelo</option>';
        foreach ($modelos as $modelo) {
            $options .= '<option value=' . $modelo->id . '">' . $modelo->nomeModelo . '</option>' . PHP_EOL;
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
                    'renavam' => $this->input->post('Renavam'),
                    'valorVeiculo' => $this->input->post('Valor')
                );
                if ($this->Veiculo_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Veiculo alterado com sucesso!</div>');
                    redirect('Veiculo/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao alterar Veiculo...</div>');
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

//    public function listarAcessorios($id) {
//        $data['veiculo'] = $this->Veiculo_Model->getOne($id);
//        // $data['veiculoacessorios'] = $this->VeiculoAcessorios_Model->getAcessoriosByVeiculo($veiculo_id);
//        $this->load->view('Fixo/Header');
//        $this->load->view('Veiculo/Acessorios');
//        $this->load->view('Fixo/Footer');
//    }

    public function listarAcessorios($id) {
        $data['veiculo'] = $this->Veiculo_Model->getOne($id);
        $data['veiculoacessorios'] = $this->Veiculo_Model->getAcessoriosByVeiculo($id);
        $this->load->view('Fixo/Header');
        $this->load->view('Veiculo/Acessorios', $data);
        $this->load->view('Fixo/Footer');
    }

    public function incluirAcessorios($id) {
        $this->form_validation->set_rules('Veiculo', 'Veiculo', 'required');
        $this->form_validation->set_rules('Acessorio', 'Acessorio', 'required');
        if ($this->form_validation->run() == false) {
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
            if ($this->Veiculo_Model->insertAcessorios($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Acessório adicionado ao Veículo com sucesso</div>');
                redirect('Veiculo/listarAcessorios/' . $id);
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
                $data['veiculos'] = $this->Veiculo_Model->getAll();
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
                if ($this->Veiculo_Model->updateAcessorios($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Acessório adicionado ao Veículo com sucesso</div>');
                    redirect('Veiculo/listarAcessorios/' . $veiculo_id);
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao Adicionar Acessório!!!</div>');
                    redirect('Veiculo/incluirAcessorios' . $veiculo_id);
                }
            }
        } else {
            redirect('Veiculo/listarAcessorios/' . $veiculo_id);
        }
    }

    public function deletarAcessorios($id, $veiculo_id) {
        if (($id > 0)) {

            if ($this->Veiculo_Model->deleteAcessorios($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Acessório deletado do Veículo com sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar Acessório do Veículo...</div>');
            }
        }
        redirect('Veiculo/listarAcessorios/' . $veiculo_id);
    }

}
