<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        $this->load->model('Usuario_Model');
    }

    public function index() {
        $this->logar();
    }

    public function listar() {
        $this->Usuario_Model->verificaLogin();
        $data['usuarios'] = $this->Usuario_Model->getAll();
        $this->load->view('Fixo/Header');
        $this->load->view('Usuario/Lista', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
        $this->Usuario_Model->verificaLogin();
        $this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('Usuario/Header');
            $this->load->view('Usuario/Login');
            $this->load->view('Usuario/Footer');
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'senha' => sha1($this->input->post('senha') . 'paulodirSENAC')
            );
            if ($this->Usuario_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Usuário Cadastrado com Sucesso!</div>');
                redirect('Usuario/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Erro ao Cadastrar Usuário!!!</div>');
                redirect('Usuario/cadastrar');
            }
        }
    }

    public function alterar($id) {
        $this->Usuario_Model->verificaLogin();
        if ($id > 0) {
            $this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email');
            $this->form_validation->set_rules('senha', 'Senha', 'required');
            if ($this->form_validation->run() == false) {
                $data['usuario'] = $this->Usuario_Model->getOne($id);
                $this->load->view('Usuario/Header');
                $this->load->view('Usuario/Login', $data);
                $this->load->view('Usuario/Footer');
            } else {
                $data = array(
                    'email' => $this->input->post('email'),
                    'senha' => sha1($this->input->post('senha') . 'paulodirSENAC')
                );
                if ($this->Usuario_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Dados do Usuário Alterado com Sucesso!</div>');
                    redirect('Usuario/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Erro ao Alterar Usuário!!!</div>');
                    redirect('Usuario/alterar/' . $id);
                }
            }
        } else {
            $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Usuário Inválido!!!</div>');
            redirect('Usuario/listar');
        }
    }

    public function deletar($id) {
        $this->Usuario_Model->verificaLogin();
        if ($id > 0) {
            if ($this->Usuario_Model->delete($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Usuário Deletado com Sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Falha ao Deletar Usuário...</div>');
            }
        }
        redirect('Setor/listar');
    }

    public function redefinir() {
        $this->form_validation->set_rules('email', 'E-Mail', 'required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha Atual', 'required');
        $this->form_validation->set_rules('nova', 'Nova Senha', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('Usuario/Header');
            $this->load->view('Usuario/Redefine');
            $this->load->view('Usuario/Footer');
        } else {
            $email = $this->input->post('email');
            $senha = $this->Usuario_Model->getPass($email);
            $atual = sha1($this->input->post('senha') . 'paulodirSENAC');
            foreach ($senha as $s)
                ;
            if ($s->senha === $atual) {
                $data = array(
                    'senha' => sha1($this->input->post('nova') . 'paulodirSENAC')
                );
                if ($this->Usuario_Model->updatePass($email, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Senha Alterada com Sucesso!</div>');
                    redirect('Usuario/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Falha ao Alterar Senha...</div>');
                    redirect('Usuario/Redefinir');
                }
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Senha Atual Incorreta...</div>');
                redirect('Usuario/Redefinir');
            }
        }
    }

    public function logar() {
        //cria as regras de validação do formulário
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('senha', 'senha', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('Usuario/Header');
            $this->load->view('Usuario/Login');
            $this->load->view('Usuario/Footer');
        } else {
            $this->load->model('Usuario_Model');
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');
            $usuario = $this->Usuario_Model->login($email, $senha);
            if ($usuario) {
                $data = array(
                    'idUsuario' => $usuario->id,
                    'email' => $usuario->email,
                    'logado' => TRUE
                );
                $this->session->set_userdata($data);
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Usuário ' . $email . ' Logado.</div>');
                redirect($this->config->base_url('Veiculo/listar'));
            } else {
                $this->session->set_flashdata('retorno', '<div class=" alert alert-danger"><i class="fas fa-ban"></i> Usuário ou Senha Incoretos...</div>');
            }redirect(base_url('Usuario/logar'));
        }
    }

    public function deslogar() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

}
