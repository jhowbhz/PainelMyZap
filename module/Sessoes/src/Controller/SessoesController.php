<?php

namespace Sessoes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Sessoes\Form\SessoesForm;

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
    
    public function adicionarAction()
    {
        try {
            
            $form = new SessoesForm();
            $form->get('submit')->setValue('Salvar sessão');
            $request = $this->getRequest();

            //var_dump($request->getPost());
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

    public function removerAction()
    {
        return new ViewModel();
    }

    public function confirmacaoAction()
    {
        return new ViewModel();
    }
}