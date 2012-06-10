<?php

namespace ThoriumCms\Form;

use Zend\Form\Form,
    Zend\Form\Element\Csrf,
    ThoriumCms\Mapper\PageInterface as PageMapper,
    ZfcBase\Form\ProvidesEventsForm;

class PageEdit extends ProvidesEventsForm
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'label' => 'Page name',
                'type' => 'text',
            ),
        ));

        $this->add(array(
            'name' => 'active',
            'attributes' => array(
                'label' => 'Active',
                'type' => 'checkbox',
            ),
        ));

        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'label' => 'Page title',
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'keywords',
            'attributes' => array(
                'label' => 'Keywords',
                'type' => 'textarea'
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
            'name' => 'locale',
            'attributes' => array(
                'label' => 'Locale',
                'type' => 'text'
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
