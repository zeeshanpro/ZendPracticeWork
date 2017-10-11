<?php
namespace Auth\Model;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
// the object will be hydrated by Zend\Db\TableGateway\TableGateway
class Auth implements InputFilterAwareInterface
{
    public $id;
    public $name;
    public $password;

    public $email;

    // Hydration
    // ArrayObject, or at least implement exchangeArray. For Zend\Db\ResultSet\ResultSet to work
    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->password = (!empty($data['password'])) ? $data['password'] : null;

        $this->email = (!empty($data['email'])) ? $data['email'] : null;

       /* $this->password_salt = (!empty($data['password_salt'])) ? $data['password_salt'] : null;*/

    }
    // Extraction. The Registration from the tutorial works even without it.
    // The standard Hydrator of the Form expects getArrayCopy to be able to bind
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    protected $inputFilter;
    // Add content to these methods:
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            $inputFilter->add($factory->createInput(array(
                'name'     => 'usr_name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'usr_password',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}