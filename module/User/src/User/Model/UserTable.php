<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 6/4/2017
 * Time: 12:06 AM
 */
namespace User\Model;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class UserTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($paginated=false)
    {


        if ($paginated) {
            // create a new Select object for the table user
            $select = new Select('user');
            // create a new result set based on the user entity
            $resultSetPrototype = new ResultSet();

            $resultSetPrototype->setArrayObjectPrototype(new User());
            // create a new pagination adapter object
            $paginatorAdapter = new DbSelect(
            // our configured select object
                $select,
                // the adapter to run it against
                $this->tableGateway->getAdapter(),
                // the result set to hydrate
                $resultSetPrototype
            );
            $paginator = new Paginator($paginatorAdapter);
            return $paginator;
        }
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }
    public function saveUser(User $user)
    {
        $data = array(
            'name' => $user->name,
            'email'  => $user->email,
            'address'  => $user->address,
            'mobile'  => $user->mobile,
        );

        $id = (int)$user->id;
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



         public function deleteUser($id)
         {
             $this->tableGateway->delete(array('id' => $id));
         }
}