<?php
/*/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 6/10/2017
 * Time: 12:41 PM
 */

namespace Auth\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class RegistrationFilter extends InputFilter
{
    public function __construct($sm)
    {

        $this->add(array(
            'name' => 'name',
            'require' => 'true',
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
                array(
                    'name' => 'Zend\Validator\Db\NoRecordExists',
                    'options' => array(
                        'table' => 'user',
                        'field' => 'name',
                        'adapter' => $sm->get('Zend\Db\Adapter\Adapter'),
                    )
                )
            )
        ));
        $this->add(array(
            'name' => 'email',
            'required' => 'true',
            'validators' => array(
                array(
                    'name' => 'EmailAddress'
                ),
                array(
                    'name' => 'Zend\Validator\Db\NoRecordExists',
                    'options' => array(
                        'table' => 'user',
                        'field' => 'email',
                        'adapter' => $sm->get('Zend\Db\Adapter\Adapter'),
                    ),
                ),
            ),

        ));
        $this->add(array(
            'name' => 'password',
            'required'=> 'true',
             'filters'=>array(
                 array('name' => 'StripTags'),
                 array('name' => 'StringTrim'),
             ),
            'validators'=>array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 6,
                        'max' => 12,
                    ),
                ),
            ),
        ));
        $this->add(array(
            'name' => 'password_confirm',
            'required'=> 'true',
            'filters'=>array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators'=>array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 6,
                        'max' => 12,
                    ),
                ),
                array(
                   'name'=> 'Identical',
                    'options'=>array(
                        'token'=>'password',
                    ),
                ),
            ),
        ));

    }

}

