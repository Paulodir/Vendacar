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
        $data['veiculos'] = $this->Visitante_Model->getLastVeiculos();
        $data['acessorios'] = $this->Visitante_Model->getAcessorios();
        $this->load->view('Visitante/Header');
        $this->load->view('Visitante/Home', $data);
        $this->load->view('Visitante/Footer');
    }

    public function veiculos() {
        $data['veiculos'] = $this->Visitante_Model->getAllVeiculos();
        $data['acessorios'] = $this->Visitante_Model->getAcessorios();
        $this->load->view('Visitante/Header');
        $this->load->view('Visitante/Home', $data);
        $this->load->view('Visitante/Footer');
    }
        public function contato() {
        $this->load->view('Visitante/Header');
        $this->load->view('Visitante/Contato');
        $this->load->view('Visitante/Footer');
    }

}
