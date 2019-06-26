<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Todo controller do codeigniter precisa extender (ser filho)
//da classe CI_Controller
class NotaFiscal extends CI_Controller {

    public function __construct() {
        //chama o contrutor da classe pai CI_Controller
        parent::__construct();
        //chama o método que faz a validação de login de usuário
        $this->load->model('Usuario_Model');
        $this->Usuario_Model->verificaLogin();
        $this->load->model('NotaFiscal_Model');
    }

    public function index() {
        $this->listar();
    }

    public function listar() {
        $data['notasfiscais'] = $this->NotaFiscal_Model->getAll();
        $this->load->view('Fixo/Header');
        $this->load->view('NotaFiscal/lista', $data);
        $this->load->view('Fixo/Footer');
    }

    public function cadastrar() {
        $this->form_validation->set_rules('Veiculo', 'Veiculo', 'required');
        $this->form_validation->set_rules('Cliente', 'Cliente', 'required');
        $this->form_validation->set_rules('Vendedor', 'Vendedor', 'required');
        $this->form_validation->set_rules('Pagamento', 'Pagamento', 'required');
        $this->form_validation->set_rules('emissao', 'emissao', 'required');
        $this->form_validation->set_rules('AcrescimoDesconto', 'AcrescimoDesconto', 'required');
        $this->form_validation->set_rules('ValorVeiculo', 'ValorVeiculo', 'required');
        $this->form_validation->set_rules('ValorFinal', 'ValorFinal', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->model('Veiculo_Model');
            $data['veiculos'] = $this->Veiculo_Model->getAll();
            $this->load->model('Cliente_Model');
            $data['clientes'] = $this->Cliente_Model->getAll();
            $this->load->model('Funcionario_Model');
            $data['funcionarios'] = $this->Funcionario_Model->getAll();
            $this->load->model('FormaPagamento_Model');
            $data['formaspagamento'] = $this->FormaPagamento_Model->getAll();
            $this->load->view('Fixo/Header');
            $this->load->view('NotaFiscal/Formulario', $data);
            $this->load->view('Fixo/Footer');
        } else {
            $this->load->model('NotaFiscal_Model');
            $data = array(
                'veiculo_id' => $this->input->post('Veiculo'),
                'cliente_id' => $this->input->post('Cliente'),
                'funcionario_id' => $this->input->post('Vendedor'),
                'formapagamento_id' => $this->input->post('Pagamento'),
                'acrescimoDesconto' => $this->input->post('AcrescimoDesconto'),
                'dataEmissao' => $this->input->post('emissao'),
                'icms' => $this->input->post('ValorFinal')*0.12,
                'valorInicial' => $this->input->post('ValorVeiculo'),
                'valorFinal' => $this->input->post('ValorFinal'),
                'status'=>$this->input->post('')+1
            );
            if ($this->NotaFiscal_Model->insert($data)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> NotaFiscal cadastrado com sucesso</div>');
                redirect('NotaFiscal/listar');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Erro ao cadastrar NotaFiscal!!!</div>');
                redirect('NotaFiscal/cadastrar');
            }
        }
    }

//    public function alterar($id) {
//        if ($id > 0) {
//            $this->form_validation->set_rules('Veiculo', 'Veiculo', 'required');
//            $this->form_validation->set_rules('Cliente', 'Cliente', 'required');
//            $this->form_validation->set_rules('Vendedor', 'Vendedor', 'required');
//            $this->form_validation->set_rules('Pagamento', 'Pagamento', 'required');
//            $this->form_validation->set_rules('emissao', 'emissao', 'required');
//            $this->form_validation->set_rules('AcrescimoDesconto', 'AcrescimoDesconto', 'required');
//            $this->form_validation->set_rules('ValorVeiculo', 'ValorVeiculo', 'required');
//            $this->form_validation->set_rules('ValorFinal', 'ValorFinal', 'required');
//            if ($this->form_validation->run() == false) {
//                $data['notafiscal'] = $this->NotaFiscal_Model->getOne($id);
//                $this->load->model('Veiculo_Model');
//                $data['veiculos'] = $this->Veiculo_Model->getAll();
//                $this->load->model('Cliente_Model');
//                $data['clientes'] = $this->Cliente_Model->getAll();
//                $this->load->model('Funcionario_Model');
//                $data['funcionarios'] = $this->Funcionario_Model->getAll();
//                $this->load->model('FormaPagamento_Model');
//                $data['formaspagamento'] = $this->FormaPagamento_Model->getAll();
//                $this->load->view('Fixo/Header');
//                $this->load->view('NotaFiscal/Formulario', $data);
//                $this->load->view('Fixo/Footer');
//            } else {
//                $data = array(
//                    'veiculo_id' => $this->input->post('Veiculo'),
//                    'cliente_id' => $this->input->post('Cliente'),
//                    'funcionario_id' => $this->input->post('Vendedor'),
//                    'formapagamento_id' => $this->input->post('Pagamento'),
//                    'acrescimoDesconto' => $this->input->post('AcrescimoDesconto'),
//                    'dataEmissao' => $this->input->post('emissao'),
//                    'valorInicial' => $this->input->post('ValorVeiculo'),
//                    'icms' => $this->input->post('ValorFinal')*0.12,
//                    'status'=>$this->input->post('')+1,
//                    'valorFinal' => $this->input->post('ValorFinal')
//                );
//
//                if ($this->NotaFiscal_Model->update($id, $data)) {
//                    $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> NotaFiscal alterado com sucesso!</div>');
//                    redirect('NotaFiscal/listar');
//                } else {
//                    $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao alterar NotaFiscal...</div>');
//                    redirect('NotaFiscal/alterar/' . $id);
//                }
//            }
//        } else {
//            redirect('NotaFiscal/listar');
//        }
//    }

    public function cancelar($id) {
        if ($id > 0) {
            if ($this->NotaFiscal_Model->cancel($id)) {
                $this->session->set_flashdata('retorno', '<div class="alert alert-success"><i class="fas fa-check-double"></i> Nota Fiscal Cancelada com Sucesso!</div>');
            } else {
                $this->session->set_flashdata('retorno', '<div class="alert alert-danger"><i class="far fa-hand-paper"></i> Falha ao Cancelar Nota Fiscal...</div>');
            }
        }
        redirect('NotaFiscal/listar');
    }
}
