<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 6/10/2017
 * Time: 8:46 PM
 */

namespace Auth\Model;


use Zend\Db\TableGateway\TableGateway;

class AuthTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    public function saveUser(Auth $auth)
    {
        $data = array(
            'name' => $auth->name,
            'email'  => $auth->email,
            'password'  => $auth->password,

        );

        $id = (int)$auth->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    public function getUser($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
}