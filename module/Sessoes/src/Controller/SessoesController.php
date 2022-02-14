<?php

namespace Sessoes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Sessoes\Form\SessoesForm;
use ApiGratis\ApiBrasil;

class SessoesController extends AbstractActionController
{

    private $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        try {
         
            // obtem todos os registros da tabela sessoes
            $sessoes = $this->table->getAll();
            
            // retorna para a view
            return new ViewModel(['sessoes' => $sessoes]);
            
        } catch (\RuntimeException $th) {
            return $th;
        }
    }

    public function checarAction()
    {
        $sessoes = $this->table->getAll();

        foreach($sessoes as $sessao){

            $chave = (string) $this->params()->fromPost('chave');
            header('Content-Type: application/json');
    
            if($chave != CHAVE_WEBHOOK) {
                echo json_encode(['error' => "Chave: A chave ".$chave." esta incorreta."]);die;
            }
    
            $sessao = $this->table->getSessao($sessao->getId());
    
            if(isset($sessao)) {

                $check = ApiBrasil::WhatsAppService("getHostDevice", [
                    "serverhost" => $sessao->getServer(), //required
                    "session" => $sessao->getSession() ?? '', //required
                    "sessionkey" => $sessao->getSessionkey() ?? '', //required
                ]);
    
                $check = json_decode($check, true);

                if($check['result'] == 200 and isset($check['connected'])){
                    $sessao->setStatus( $check['connected'] );
                }else{
                    $sessao->setStatus(0);
                }
                $this->table->salvarSessao($sessao);
            }
    
        }
        
        echo json_encode(['success' => "Checagem realizada com sucesso."]);die;

    }
    
    public function adicionarAction()
    {
        try {
            
            $form = new SessoesForm();
            $form->get('submit')->setValue('Salvar sessão');
            $request = $this->getRequest();

            // se nao for uma requisicao post retorna para a view
            if(!$request->isPost()) {
                return new ViewModel(['form' => $form]);
            }

            $sessao = new \Sessoes\Model\Sessoes();
            $form->setData($request->getPost());

            // se nao for valido retorna para a view
            if(!$form->isValid()) {
                return new ViewModel(['form' => $form]);
            }

            $sessao->exchangeArray($form->getData());
            $this->table->salvarSessao($sessao);
            
            return $this->redirect()->toRoute('sessoes');

        } catch (\RuntimeException $th) {
            return $th;
        }
    }

    public function editarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if(!$id) {
            return $this->redirect()->toRoute('sessoes', ['action' => 'adicionar']);
        }

        try {
            
            $sessao = $this->table->getSessao($id);
            $form = new SessoesForm();
            $form->bind($sessao);

            $form->get('submit')->setAttribute('value', 'Atualizar sessão');
            $request = $this->getRequest();
            $viewData = ['id' => $id, 'form' => $form];

            // se nao for uma requisicao post retorna para a view
            if(!$request->isPost()) {
                return $viewData;
            }

            $form->setData($request->getPost());
            if(!$form->isValid()) {
                return $viewData;
            }

            $this->table->salvarSessao($form->getData());
            return $this->redirect()->toRoute('sessoes', ['action' => 'index']);

        } catch (\RuntimeException $th) {
            return $th;
        }

        return new ViewModel();
    }

    public function iniciarAction()
    {
        $request = $this->getRequest();
        $body = json_decode(file_get_contents('php://input'), true);

        if(!$request->isPost()) {
            echo json_encode(['status' => 'error', 'message' => 'Requisição inválida']);die;
        }

        if(!$body['id']) {
            echo json_encode(['status' => 'error', 'message' => 'ID não informado']);die;
        }

        $sessao = $this->table->getSessao($body['id']);

        $start = ApiBrasil::WhatsAppService("start", [
            "serverhost" => $sessao->getServer(), //required
            "method" => "POST", //optional
            "apitoken" => $sessao->getApiToken() ?? '', //required
            "session" => $sessao->getSession() ?? '', //required
            "sessionkey" => $sessao->getSessionkey() ?? '', //required
            "wh_status" => $sessao->getWh_status() ?? '', //optional
            "wh_message" => $sessao->getWh_message() ?? '', //optional
            "wh_connect" => $sessao->getWh_connect() ?? '', //optional
            "wh_qrcode" => $sessao->getWh_qrcode() ?? '', //optional
        ]);

        $result = json_decode($start);

        if($result->result === 'success'){
            echo $start;die;
        };

        echo json_encode(['status' => 'error', 'message' => $result]);die;
    }

    public function removerAction()
    {
        return new ViewModel();
    }

    public function confirmacaoAction()
    {
        return new ViewModel();
    }
}
