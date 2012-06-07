<?php

namespace SpeckCms\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;

class IndexController extends ActionController
{
    public function indexAction()
    {
        $page = $this->getEvent()->getRouteMatch()->getParam('page', 'index');

        // TODO : check if page exists

        return new ViewModel(array(
            'page' => $page,
        ));
    }
}
