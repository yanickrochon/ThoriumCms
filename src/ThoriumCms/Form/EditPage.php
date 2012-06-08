<?php

namespace ThoriumCms\Form;

use Zend\Form\Form,
    Zend\Form\Element\Csrf,
    ThoriumCms\Mapper\PageInterface as PageMapper,
    ZfcBase\Form\ProvidesEventsForm;

class Base extends ProvidesEventsForm
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'label' => 'Page name',
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'content',
            'attributes' => array(
                'label' => 'Page Content',
                'type' => 'textarea'
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Submit',
                'type' => 'submit'
            ),
        ));

        $this->add(array(
            'name' => 'pageId',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));

        $this->add(new Csrf('csrf'));

        $this->events()->trigger('init', $this);
    }
}
