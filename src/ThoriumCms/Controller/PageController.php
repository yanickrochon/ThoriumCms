<?php

namespace ThoriumCms\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;

class PageController extends ActionController
{
    public function indexAction()
    {
        $pageName = $this->getEvent()->getRouteMatch()->getParam('page', 'index');

        $service = $this->getServiceLocator()->get('thoriumcms_page_service');

        $page = $service->getPageByName($pageName);
        if (!$page) {
            return $this->notFoundAction();
        }
        
        $pageContent = $service->getContentForPage($page);
        if (!$pageContent) {
            return $this->notFoundAction();
        }
        
        return new ViewModel(array(
            'page' => $page,
            'pageContent' => $pageContent,
        ));
    }
}
