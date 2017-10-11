<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 6/9/2017
 * Time: 12:37 AM
 */

namespace Auth\Form;


use Zend\Form\Form;

class RegistrationForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->setAttribute('method','post');
         $this->add(array(
            'name'=> 'name',
             'attributes' => array(
               'type'=>'text',
                 'class'=>'form-control',
             ),
             'options'=>array(
               'label'=>'Username'
             ),
         ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
                'class'=>'form-control',
            ),
            'options' => array(
                'label' => 'E-mail',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'class'=>'form-control',
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));
        $this->add(array(
            'name' => 'password_confirm',
            'attributes' => array(
                'type'  => 'password',
                'class'=>'form-control',
            ),
            'options' => array(
                'label' => 'Confirm Password',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => array(
                'label' => 'Please verify you are human',
                'captcha' => new \Zend\Captcha\Figlet(),
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}