<?php

namespace Sessoes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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
            
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }
    }
    
    public function adicionarAction()
    {
        return new ViewModel();
    }

    public function salvarAction()
    {
        return new ViewModel();
    }

    public function editarAction()
    {
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