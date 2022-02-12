<?php
namespace Sessoes;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        // TODO: Implement getConfig() method.
        return include __DIR__ . '/../config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\SessoesTable::class => function($container) {
                    $tableGateway = $container->get(Model\SessoesTableGateway::class);
                    return new Model\SessoesTable($tableGateway);
                },
                Model\SessoesTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(\Zend\Db\Adapter\AdapterInterface::class);
                    $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Sessoes());
                    return new \Zend\Db\TableGateway\TableGateway('sessoes', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [

                // criamos um factory para o controller como dependencia
                \Sessoes\Controller\SessoesController::class => function($container) {
                    return new \Sessoes\Controller\SessoesController(
                        $container->get(Model\SessoesTable::class)
                    );
                },
            ],
        ];
    }

}