<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 10/9/2017
 * Time: 2:36 AM
 */

namespace Blog\Controller;


use Blog\Form\add;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends  AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel(); // TODO: Change the autogenerated stub
    }

    public function addAction()
    {
        $form = new add();

        if ($this->request->isPost())
        {
          /* $form->setData($this->request->getPost()) ;*/
        }
        return new ViewModel(array(
            'form'=> $form,
        ));
    }


}