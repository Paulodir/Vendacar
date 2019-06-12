<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class Funcionario extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        //$this->load->model('Usuario_model');
        //$this->Usuario_model->verificaLogin();
        $this->load->model('Funcionario_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['funcionarios'] = $this->Funcionario_Model->getAll();
        $this->load->view('Fixo/Header');
        $this->load->view('Funcionario/ListaFuncionarios', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
        $this->form_validation->set_rules('Nome', 'Nome', 'required');
        $this->form_validation->set_rules('Cpf', 'Cpf', 'required');
        $this->form_validation->set_rules('Rg', 'Rg', 'required');
        $this->form_validation->set_rules('Genero', 'Genero', 'required');
        $this->form_validation->set_rules('Nascimento', 'Nascimento', 'required');
        $this->form_validation->set_rules('Endereco', 'Endereco', 'required');
        $this->form_validation->set_rules('Bairro', 'Bairro', 'required');
        $this->form_validation->set_rules('Cidade', 'Cidade', 'required');
        $this->form_validation->set_rules('Estado', 'Estado', 'required');
        $this->form_validation->set_rules('Celular', 'Celular', 'required');
        $this->form_validation->set_rules('Salario', 'Salario', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('Fixo/Header');
            $this->load->view('Funcionario/FormularioFuncionario');
            $this->load->view('Fixo/Footer');
        } else {
            $this->load->model('Funcionario_Model');
            $data = array(
                'nomeFuncionario' => $this->input->post('Nome'),
                'cpf' => $this->input->post('Cpf'),
                'rg' => $this->input->post('Rg'),
                'genero' => $this->input->post('Genero'),
                'dataNascimento' => $this->input->post('Nascimento'),
                'endereco' => $this->input->post('Endereco'),
                'bairro' => $this->input->post('Bairro'),
                'cidade' => $this->input->post('Cidade'),
                'estado' => $this->input->post('Estado'),
                'celular' => $this->input->post('Celular'),
                'salario' => $this->input->post('Salario')
            );
            if ($this->Funcionario_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Funcionário cadastrado com sucesso</div>');
                redirect('Funcionario/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao cadastrar Funcionário!!!</div>');
                redirect('Funcionario/cadastrar');
            }
        }
    }

    public function alterar($id) {
        if ($id > 0) {
            $this->form_validation->set_rules('Nome', 'Nome', 'required');
            $this->form_validation->set_rules('Cpf', 'Cpf', 'required');
            $this->form_validation->set_rules('Rg', 'Rg', 'required');
            $this->form_validation->set_rules('Genero', 'Genero', 'required');
            $this->form_validation->set_rules('Nascimento', 'Nascimento', 'required');
            $this->form_validation->set_rules('Endereco', 'Endereco', 'required');
            $this->form_validation->set_rules('Bairro', 'Bairro', 'required');
            $this->form_validation->set_rules('Cidade', 'Cidade', 'required');
            $this->form_validation->set_rules('Estado', 'Estado', 'required');
            $this->form_validation->set_rules('Celular', 'Celular', 'required');
            $this->form_validation->set_rules('Salario', 'Salario', 'required');
            if ($this->form_validation->run() == false) {
                $data['funcionario'] = $this->Funcionario_Model->getOne($id);
                $this->load->view('Fixo/Header');
                $this->load->view('Funcionario/FormularioFuncionario', $data);
                $this->load->view('Fixo/Footer');
            } else {
                $data = array(
                    'nomeFuncionario' => $this->input->post('Nome'),
                    'cpf' => $this->input->post('Cpf'),
                    'rg' => $this->input->post('Rg'),
                    'genero' => $this->input->post('Genero'),
                    'dataNascimento' => $this->input->post('Nascimento'),
                    'endereco' => $this->input->post('Endereco'),
                    'bairro' => $this->input->post('Bairro'),
                    'cidade' => $this->input->post('Cidade'),
                    'estado' => $this->input->post('Estado'),
                    'celular' => $this->input->post('Celular'),
                    'salario' => $this->input->post('Salario')
                );
                if ($this->Funcionario_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Funcionário alterado com sucesso!</div>');
                    redirect('Funcionario/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao alterar Funcionário...</div>');
                    redirect('Funcionario/alterar/' . $id);
                }
            }
        } else {
            redirect('Funcionario/listar');
        }
    }

    public function deletar($id) {
        if ($id > 0) {
            if ($this->Funcionario_Model->delete($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Funcionário deletado com sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar Funcionário...</div>');
            }
        }
        redirect('Funcionario/listar');
    }

    public function indisponivel() {
        $this->session->set_flashdata('retorno', '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Não é possivel deletar Funcionários com notas fiscais emitidas...</div>');
        redirect('Funcionario/listar');
    }

}
