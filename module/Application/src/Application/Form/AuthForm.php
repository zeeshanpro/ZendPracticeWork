<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 6/7/2017
 * Time: 4:38 PM
 */

namespace Application\Form;


use Zend\Form\Form;

class AuthForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->setAttribute('method','post');


        $this->add(array(
            'name'=>'username',
            'attributes' => array(
                'type'=> 'text',
                'required' => 'required',
                'placeholder'=> 'Enter Username',
            ),
            'options'=> array(
                'label'=> 'Username',

            ),


        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'required' => 'required',
                'placeholder' => 'Enter Password'
            ),
            'options' => array(
                'label' => 'Password',

            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' =>'GO',
                'id' => 'submitbutton',
            ),
        ));

    }

}