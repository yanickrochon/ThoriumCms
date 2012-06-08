<?php

namespace ThoriumCms\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;

class AdminController extends ActionController
{
    public function indexAction()
    {
        // TODO : check if Zfc-user exist and if the user is logged in

        $page = $this->getEvent()->getRouteMatch()->getParam('page', 'index');

        // TODO : check if page exists

        return new ViewModel(array(
            'page' => $page,
        ));
    }
}
