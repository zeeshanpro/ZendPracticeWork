<?php

namespace User\Controller;

use User\Form\UserFilter;
use User\Form\UserForm;
use User\Model\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

use Zend\View\View;

class UserController extends AbstractActionController
{
    protected $userTable;

    public function indexAction()
    {
       // $data=$this->getUserTable()->fetchAll();

           $paginator=$this->getUserTable()->fetchAll(true);

           $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $paginator->setItemCountPerPage(5);

        return new ViewModel(array(
            'paginator' => $paginator
        ));
    }

    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('User\Model\UserTable');
        }
        return $this->userTable;
    }
    public function createAction()
    {
        $form = new UserForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $user->exchangeArray($form->getData());
                $this->getUserTable()->saveUser($user);

                // Redirect to list of albums
                return $this->redirect()->toRoute('user');
            }
        }
        return array('form' => $form);
    }
    public function updateAction()
    {

        $id = (int) $this->params()->fromRoute('id', 0);
        if(!$id)
        {
            return
        $this->redirect()->toRoute('user',array('action'=> 'create'));
        }

        try{
          $user=$this->getUserTable()->getUser($id);
        }catch (\Exception $ex){
           return $this->redirect()->toRoute('user',array('action'=>'index'));

        }
        $form  = new UserForm();
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {

            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getUserTable()->saveUser($user);

                // Redirect to list of albums
                return $this->redirect()->toRoute('user');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }
    public function deleteAction(){
        $id=(int) $this->params()->fromRoute('id',0);
        if (!$id)
        {
            $this->redirect()->toRoute('user');
        }
       $request= $this->getRequest();
        if ($request->isPost()){
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getUserTable()->deleteUser($id);

            }
            $this->redirect()->toRoute('user');
        }
        return array(
            'id'    => $id,
            'User' => $this->getUserTable()->getUser($id)
        );
    }

}

