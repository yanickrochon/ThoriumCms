<?php

namespace ThoriumCms\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;

class AdminController extends ActionController
{
    /**
     * @var Form
     */
    protected $pageEditForm;
    

    public function editAction()
    {
        $pageName = $this->getEvent()->getRouteMatch()->getParam('page', 'index');

        $pageAccessPluginClass = get_class($this->thoriumCmsPageAccess());
        if (!$this->thoriumCmsPageAccess()->validate($pageName, $pageAccessPluginClass::ACCESS_EDIT)) {
            // TODO : find a better way of generating the login url... this is ugly
            $backUrl = $this->getEvent()->getRouter()->assemble(array(
                    'page' => $pageName,
                ), array(
                    'name' => $this->getEvent()->getRouteMatch()->getMatchedRouteName(),
                ));
            $loginUrl = $this->getEvent()->getRouter()->assemble(array(), array(
                    'name' => 'zfcuser/login',
                )) . '?redirect=' . urlencode($backUrl);
            return $this->redirect()->toUrl($loginUrl);
        }


        $service = $this->getServiceLocator()->get('thoriumcms_page_service');

        $page = $service->getPageByName($pageName);
        if ($page) {
            $pageContent = $service->getContentForPage($page);
            if (!$pageContent) {
                $pageContent = null;
            }
        } else {
            $pageContent = null;
        }

        return new ViewModel(array(
            'pageName'    => $pageName,  // pass it to have a default page name if $page is null
            'page'        => $page,
            'pageContent' => $pageContent,
            'editForm'    => $this->getPageEditForm(),
        ));
    }


    public function getPageEditForm()
    {
        if (null === $this->pageEditForm) {
            $this->pageEditForm = $this->getServiceLocator()->get('thoriumcms_pageedit_form');
        }
        return $this->pageEditForm;
    }

}
