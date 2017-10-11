<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 6/9/2017
 * Time: 12:34 AM
 */
namespace Auth\Controller;


use Auth\Form\RegistrationFilter;
use Auth\Form\RegistrationForm;
use Auth\Model\Auth;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class RegistrationController extends AbstractActionController
{
     protected $authTable;
    public function IndexAction()
    {
       $reg_form = new RegistrationForm();
       $reg_form->get('submit')->setValue('Register');
      $request= $this->getRequest();
       if ($request->isPost())
       {

           $reg_form->setInputFilter(new RegistrationFilter($this->getServiceLocator()));
           $reg_form->setData($request->getPost());

           if ($reg_form->isValid())
           {
               $data=$reg_form->getData();
               $auth= new Auth();
               $auth->exchangeArray($data);
               $this->getAuthTable()->saveUser($auth);
               return $this->redirect()->toRoute('auth', array('controller' => 'Index', 'action' => 'index'));

           }


       }
        return new ViewModel(array('form'=> $reg_form));
    }
    public function getAuthTable()
    {
        if (!$this->authTable) {
            $sm = $this->getServiceLocator();
            $this->authTable = $sm->get('Auth\Model\AuthTable');
        }
        return $this->authTable;
    }


}