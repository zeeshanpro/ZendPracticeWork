<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 10/11/2017
 * Time: 1:39 AM
 */

namespace Blog\InputFilter;


use Zend\I18n\Validator\Alnum;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

class AddPost extends Input
{


    public function __construct()
    {
        parent::__construct('AddPost');
        $item= new Input('Title');
        $item->setRequired(true);
        $item->setValidatorChain($this->gerTitleValidatorChain());


       /* $slug=new Input('slug');
        $slug->setRequired(true);
        $slug->*/
    }

    /**
     * @return ValidatorChain
     */

    public function gerTitleValidatorChain()
    {
        $stringLength=new StringLength();
        $stringLength->setMin(5);
        $stringLength->setMax(50);


       $validatorChain =new ValidatorChain();
       $validatorChain->attach(new Alnum(true));
       $validatorChain->attach($stringLength);

       return $validatorChain;
    }
}