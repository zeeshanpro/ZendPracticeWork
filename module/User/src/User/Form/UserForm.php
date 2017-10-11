<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 6/5/2017
 * Time: 1:45 AM
 */

namespace User\Form;

use Zend\Form\Form;

class UserForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user');
        $this->setAttribute('method','post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'name',

            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),

            'options' => array(
                'label' => 'UserName',

            ),
        ));
        $this->add(array(
            'name' => 'email',

            'attributes' => array(
                'type' => 'email',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));
        $this->add(array(
            'name' => 'address',

            'attributes' => array(
                'type' => 'Text',
                'class' => 'form-control',
            ),

            'options' => array(
                'label' => 'Address',
            ),
        ));
        $this->add(array(
            'name' => 'mobile',

            'attributes' => array(
                'type' => 'Text',
                'class' => 'form-control',
            ),

            'options' => array(
                'label' => 'Mobile#',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));


    }

}

