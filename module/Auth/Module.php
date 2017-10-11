<?php
namespace Auth;

use Auth\Model\Auth;
use Auth\Model\AuthTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Auth\Model\AuthTable' =>  function($sm) {
                    $tableGateway = $sm->get('AuthTableGateway');
                    $table = new AuthTable($tableGateway);
                    return $table;
                },
                'AuthTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Auth());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
