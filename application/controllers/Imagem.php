<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Imagem extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Usuario_Model');
        $this->Usuario_Model->verificaLogin();
        $this->load->model('Imagem_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar($id) {
        $this->load->model('Veiculo_Model');
        $data['veiculo'] = $this->Veiculo_Model->getOne($id);
        $data['fotos'] = $this->Imagem_Model->getFotoByVeiculo($id);
        $this->load->view('Fixo/Header');
        $this->load->view('Veiculo/Galeria', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar($id) {
        $data = array();
        if ($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])) {
            $filesCount = count($_FILES['files']['name']);
            $error = FALSE;
            $mensagemError = '';
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['userFile']['name'] = $_FILES['files']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['files']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['files']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['files']['size'][$i];

                $uploadPath = 'Uploads/' . $id;
                $config['upload_path'] = $uploadPath;
                if (!is_dir($config['upload_path']))
                    mkdir($config['upload_path'], 0777, TRUE);
                $config['allowed_types'] = 'gif|jpg|png|jpeg|';
                $config['max_size'] = 600;
                $config['max_width'] = 1024;
                $config['max_height'] = 768;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('userFile')) {
                    $fileData = $this->upload->data();
                    $uploadData[$i]['nome'] = $fileData['file_name'];
                    $uploadData[$i]['veiculo_id'] = $id;
                } else {
                    $error = TRUE;
                    $mensagemError .= $this->upload->display_errors();
                }
            }
            if (!empty($uploadData) && $error == FALSE) {
                echo 'teste';
                // Insere os arquivos no banco de dados
                $insert = $this->Imagem_Model->insert($uploadData);
                $retorno = $insert ? '<div class="alert alert-success">Imagens Adicionadas a Galeria</div>' : '<div class="alert alert-danger"> opa não foi dessa vez</div>';
                $this->session->set_flashdata('retorno', $retorno);
                redirect('Imagem/listar/' . $id);
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><h4><i class="fas fa-ban"></i></h4>' . $mensagemError . '</div>');
            }
        }

        $this->listar($id);
    }

    public function deletar($veiculo_id, $foto_id) {
        if (($veiculo_id > 0 && $foto_id > 0)) {
            $fotos = $this->Imagem_Model->getOne($foto_id);
            foreach ($fotos as $foto) {
                $nome = $foto->nome;
            }
            if ($this->Imagem_Model->delete($foto_id) > 0) {
                if (!empty($nome) && file_exists('Uploads/' . $veiculo_id . '/' . $nome)) {
                    unlink('Uploads/' . $veiculo_id . '/' . $nome);
                }
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Imagem deletada com Sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Falha ao Deletar Imagem...</div>');
            }
        } else {
            $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="fas fa-ban"></i> Veículo não encontrado</div>');
        }
        redirect('Imagem/cadastrar/' . $veiculo_id);
    }

}
