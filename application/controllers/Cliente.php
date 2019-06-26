<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class Cliente extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        $this->load->model('Usuario_Model');
        $this->Usuario_Model->verificaLogin();
        $this->load->model('Cliente_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['clientes'] = $this->Cliente_Model->getAll();
        $this->load->view('Fixo/Header');
        $this->load->view('Cliente/ListaClientes', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
        $this->form_validation->set_rules('Nome', 'Nome', 'required');
        $this->form_validation->set_rules('CpfCnpj', 'Cpf ou Cnpj', 'required');
        $this->form_validation->set_rules('RgIe', 'Rg ou Inscrição Estadual', 'required');
        $this->form_validation->set_rules('Genero', 'Gênero', 'required');
        $this->form_validation->set_rules('Nascimento', 'Data de Nascimento', 'required');
        $this->form_validation->set_rules('Endereco', 'Endereço', 'required');
        $this->form_validation->set_rules('Bairro', 'Bairro', 'required');
        $this->form_validation->set_rules('Cidade', 'Cidade', 'required');
        $this->form_validation->set_rules('Estado', 'Estado', 'required');
        $this->form_validation->set_rules('Celular', 'Celular', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('Fixo/Header');
            $this->load->view('Cliente/FormularioCliente');
            $this->load->view('Fixo/Footer');
        } else {
            $this->load->model('Cliente_Model');
            $data = array(
                'nomeCliente' => $this->input->post('Nome'),
                'cnpjCpf' => $this->input->post('CpfCnpj'),
                'ieRg' => $this->input->post('RgIe'),
                'genero' => $this->input->post('Genero'),
                'dataNascimento' => $this->input->post('Nascimento'),
                'endereco' => $this->input->post('Endereco'),
                'bairro' => $this->input->post('Bairro'),
                'cidade' => $this->input->post('Cidade'),
                'estado' => $this->input->post('Estado'),
                'celular' => $this->input->post('Celular')
            );
            if ($this->Cliente_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Cliente Cadastrado com Sucesso!</div>');
                redirect('Cliente/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao Cadastrar Cliente!!!</div>');
                redirect('Cliente/cadastrar');
            }
        }
    }

    public function alterar($id) {
        if ($id > 0) {
            $this->form_validation->set_rules('Nome', 'Nome', 'required');
            $this->form_validation->set_rules('CpfCnpj', 'Cpf ou Cnpj', 'required');
            $this->form_validation->set_rules('RgIe', 'Rg ou Inscrição Estadual', 'required');
            $this->form_validation->set_rules('Genero', 'Gênero', 'required');
            $this->form_validation->set_rules('Nascimento', 'Data de Nascimento', 'required');
            $this->form_validation->set_rules('Endereco', 'Endereço', 'required');
            $this->form_validation->set_rules('Bairro', 'Bairro', 'required');
            $this->form_validation->set_rules('Cidade', 'Cidade', 'required');
            $this->form_validation->set_rules('Estado', 'Estado', 'required');
            $this->form_validation->set_rules('Celular', 'Celular', 'required');
            if ($this->form_validation->run() == false) {
                $data['cliente'] = $this->Cliente_Model->getOne($id);
                $this->load->view('Fixo/Header');
                $this->load->view('Cliente/FormularioCliente', $data);
                $this->load->view('Fixo/Footer');
            } else {
                $data = array(
                    'nomeCliente' => $this->input->post('Nome'),
                    'cnpjCpf' => $this->input->post('CpfCnpj'),
                    'ieRg' => $this->input->post('RgIe'),
                    'genero' => $this->input->post('Genero'),
                    'dataNascimento' => $this->input->post('Nascimento'),
                    'endereco' => $this->input->post('Endereco'),
                    'bairro' => $this->input->post('Bairro'),
                    'cidade' => $this->input->post('Cidade'),
                    'estado' => $this->input->post('Estado'),
                    'celular' => $this->input->post('Celular')
                );
                if ($this->Cliente_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Cliente Alterado com Sucesso!</div>');
                    redirect('Cliente/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Alterar Cliente...</div>');
                    redirect('Cliente/alterar/' . $id);
                }
            }
        } else {
            redirect('Cliente/listar');
        }
    }

    public function deletar($id) {
        if ($id > 0) {
            if ($this->Cliente_Model->delete($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Cliente Deletado com Sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar Cliente...</div>');
            }
        }
        redirect('Cliente/listar');
    }

    public function indisponivel() {
        $this->session->set_flashdata('retorno', '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Não é possivel deletar Clientes com notas fiscais emitidas em seu Nome...</div>');
        redirect('Cliente/listar');
    }

}
