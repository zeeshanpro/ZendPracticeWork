<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan
 * Date: 10/9/2017
 * Time: 11:42 PM
 */

namespace Blog\Form;
use Zend\Form\Form;
use Zend\Form\Element;
class add extends Form
{

    public function __construct()
    {
        parent::__construct('add');
        $title =new Element\Text('Title');
        $title->setLabel('Title');
        $title->setAttribute('class','form-control');

        $slug= new Element\Text('Slug');
        $slug->setLabel('Slug');
        $slug->setAttribute('class','form-control');

        $content=new Element\Textarea('Content');
        $content->setLabel('Content');
        $content->setAttribute('class','form-control');

        $category=new Element\Select('Category');
        $category->setLabel('Category');
        $category->setAttribute('class','form-control');
        $category->setValueOptions(array(
            1=>'Php',
            2=>'Zend',
            3=>'Mysql',
        ));

        $submit=new Element\Submit('submit');
        $submit->setValue('Add Post');
        $submit->setAttribute('class','btn btn-primary');

        $this->add($title);
        $this->add($slug);
        $this->add($content);
        $this->add($category);
        $this->add($submit);
    }
}
