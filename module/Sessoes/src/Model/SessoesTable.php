<?php 

namespace Sessoes\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use Sessoes\Model\Sessoes;
use RuntimeException;

class SessoesTable 
{

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        // construtor recebe como dependencia $tableGateway
        $this->tableGateway = $tableGateway;
    }

    public function getAll()
    {
        try {
            
            // obtem todos os registros da tabela
            return $this->tableGateway->select();

        } catch (\RuntimeException $th) {
            return $th;
        }
    }

    public function getSessao($id)
    {
        try {

            $id = (int) $id;
            $rowset = $this->tableGateway->select(['id' => $id]);
            $row = $rowset->current();

            if(!$row) {
                throw new RuntimeException(sprintf("Não foi possível encontrar a sessão com o id %d", $id));
            }
            return $row;

        } catch (\RuntimeException $th) {
            return $th;
        }
       
    }

    public function salvarSessao(Sessoes $sessao)
    {
        try {

            // seta os valores
            $data = [
                'id' => $sessao->getId(),
                'name' => $sessao->getName(),
                'description' => $sessao->getDescription(),
               
                'server' => $sessao->getServer(),
                'apitoken' => $sessao->getApitoken(),
                'sessionkey' => $sessao->getSessionkey(),
                'session' => $sessao->getSession(),
                'status' => $sessao->getStatus(),
               
                'wh_status' => $sessao->getWh_status(),
                'wh_message' => $sessao->getWh_message(),
                'wh_qrcode' => $sessao->getWh_qrcode(),
                'wh_connect' => $sessao->getWh_connect(),
            ];

            // pega o id da sessão
            $id = (int) $sessao->getId();

            // se nao existe id, entao cria novo registro
            if($id === 0) { 
                $this->tableGateway->insert($data);
                return; 
            }

            // se existe id, entao atualiza registro
            $this->tableGateway->update($data, ['id' => $id] ); return;

            exit();
        } catch (\RuntimeException $th) {
            return $th;
        }
    }

    public function deletarSessao($id)
    {
        // pega o id como paramentro e converte para inteiro e remove o registro
        $this->tableGateway->delete(['id' => (int) $id]);
    }

}
