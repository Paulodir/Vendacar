<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class Montadora extends CI_Controller {
     public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();

        //chama o método que faz a validação de login de usuário
        //$this->load->model('Usuario_model');
        //$this->Usuario_model->verificaLogin();
        $this->load->model('Montadora_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {

        $data['montadoras'] = $this->Montadora_Model->getAll('*,(SELECT COUNT(montadora_id) FROM modelo WHERE montadora_id=montadora.id) as utilizados');
        $this->load->view('Fixo/Header');
        $this->load->view('Montadora/ListaMontadoras', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
        $this->form_validation->set_rules('Nome', 'Nome', 'required');

        if ($this->form_validation->run() == false) {
            //$this->load->view('Fixo/Header');
            $this->load->view('FormularioMontadora');
            //$this->load->view('Fixo/Footer');
        } else {
            $data = array(
                'nome' => $this->input->post('Nome'),
            );
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 100;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('imagem')) {
                $error = array('error'=>$this->upload->display_errors());
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> ' . $this->upload->display_errors() . '</div>');
                    redirect(base_url('Montadora/cadastrar'));exit();
            }else{
                $data['imagem'] = $this->upload->data()['file_name'];
            }
            if ($this->Montadora_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Montadora cadastrada com sucesso</div>');
                redirect('Montadora/listar');
            } else {
                unlink('./uploads/'.$data['imagem']);
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao cadastrar Montadora!!!</div>');
                redirect('Montadora/cadastrar');
            }
        }
    }

    public function alterar($id) {
        if ($id > 0) {
            $this->form_validation->set_rules('Nome', 'Nome', 'required');
            if ($this->form_validation->run() == false) {
                $data['montadora'] = $this->Montadora_Model->getOne($id);
                $this->load->view('Fixo/Header');
                $this->load->view('FormularioMontadora', $data);
                $this->load->view('Fixo/Footer');
            } else {
                $data = array(
                    'nome' => $this->input->post('Nome'),
                );
                $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 100;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('imagem')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> ' . $this->upload->display_errors() . '</div>');
                    redirect(base_url('Montadora/alterar'));exit();
            }else{
                 $data['imagem'] = $this->upload->data()['file_name'];
                    $actualimage = $this->Montadora_Model->getOne($id)->imagem;
                    if (!empty($actualimage) && file_exists('uploads/' . $actualimage)) 
                        unlink('uploads/' . $actualimage);
            }
                if ($this->Montadora_Model->update($id, $data)) {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Montadora alterada com sucesso!</div>');
                    redirect('Montadora/listar');
                } else {
                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao alterar Montadora...</div>');
                    redirect('Montadora/alterar/' . $id);
                }
            }
        } else {
            redirect('Montadora/listar');
        }
    }

        public function deletar($id) {
        $excluir = $this->Montadora_Model->getOne($id);
        if ($excluir) {
            if ($this->Montadora_Model->delete($id) > 0) {
                if (!empty($excluir->imagem) && file_exists('uploads/' . $excluir->imagem)) {
                    unlink('uploads/' . $excluir->imagem);
                }
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Montadora deletada com sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Deletar Montadora...</div>');
            }
        } else {
            $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Montadora não encontrada</div>');
        }
        redirect('Montadora/listar');
    }
    public function mensagem() {
        $this->session->set_flashdata('retorno', '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Não é possivel deletar montadoras com modelos cadastrados. Caso desejar deletar esta montadora exclua primeiramente os modelos...</div>');
        redirect('Montadora/listar');
    }
}
