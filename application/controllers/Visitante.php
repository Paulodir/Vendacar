<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class Visitante extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Visitante_Model');
    }

    public function index() {
        $this->home();
    }

    public function home() {
        $data['foto'] = $this->Visitante_Model->getPrimeiraFoto();
        $data['veiculos'] = $this->Visitante_Model->getLastVeiculos();
        $data['acessorios'] = $this->Visitante_Model->getAcessorios();
//        $data['resultados'] = $this->Visitante_Model->search();
        $this->load->view('Visitante/Header');
        $this->load->view('Visitante/Home', $data);
        $this->load->view('Visitante/Footer');
    }

    public function veiculos() {
        $data['foto'] = $this->Visitante_Model->getPrimeiraFoto();
        $data['veiculos'] = $this->Visitante_Model->getAllVeiculos();
        $data['acessorios'] = $this->Visitante_Model->getAcessorios();
//        $data['resultados'] = $this->Visitante_Model->search();
        $this->load->view('Visitante/Header');
        $this->load->view('Visitante/Home', $data);
        $this->load->view('Visitante/Footer');
    }

    public function contato() {
        $this->load->view('Visitante/Header');
        $this->load->view('Visitante/Contato');
        $this->load->view('Visitante/Footer');
    }

    public function veiculo($id) {
        $this->load->model('Veiculo_Model');
        $data['veiculo'] = $this->Veiculo_Model->getOne($id);
        $data['veiculoacessorios'] = $this->Visitante_Model->getAcessorios();
        $this->load->model('Imagem_Model');
        $data['fotos'] = $this->Imagem_Model->getFotoByVeiculo($id);
        $this->load->view('Visitante/Header');
        $this->load->view('Visitante/Veiculo', $data);
        $this->load->view('Visitante/Footer');
    }

}
