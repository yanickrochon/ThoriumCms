<?php

namespace ThoriumCms\Service;

use DateTime;
use Zend\Authentication\AuthenticationService;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use ZfcBase\EventManager\EventProvider;
use ThoriumCms\Model\PageInterface;
use ThoriumCms\Mapper\PageInterface as PageMapper;
use ThoriumCms\Mapper\PageContentInterface as PageContentMapper;
use ThoriumCms\Module as ThoriumCms;

class Page extends EventProvider implements ServiceManagerAwareInterface
{

    /**
     * @var PageMapper
     */
    protected $pageMapper;

    /**
     * @var PageContentMapper
     */
    protected $pageContentMapper;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * Get a page entity by it's name
     *
     * @param string $pageName
     * @return \ThoriumCms\Model\PageInterface
     */
    public function getPageByName($pageName)
    {
        return $this->getPageMapper()->findByName($pageName);
    }

    /**
     * Get the content for a given page
     *
     * @param PageInterface $page the page
     * @param string|Zend\Locale\Locale $locale (optional)
     * @return PageContentInterface
     */
    public function getContentForPage(PageInterface $page, $locale = null)
    {
        return $this->getPageContentMapper()->findByIdAndLocale($page->getPageId(), $locale);
    }

    /**
     * Get page content mapper 
     * 
     * @return PageContentMapper
     */
    public function getPageContentMapper()
    {
        if (null === $this->pageContentMapper) {
            $this->pageContentMapper = $this->getServiceManager()->get('thoriumcms_pagecontent_mapper');
        }
        return $this->pageContentMapper;
    }

    /**
     * Set the page content mapper
     *
     * @param PageContentMapper $pageContentMapper
     * @return Page
     */
    public function setPageContentMapper(PageContentMapper $pageContentMapper)
    {
        $this->pageContentMapper = $pageContentMapper;
        return $this;
    }
    
    /**
     * Get page mapper 
     * 
     * @return PageMapper
     */
    public function getPageMapper()
    {
        if (null === $this->pageMapper) {
            $this->pageMapper = $this->getServiceManager()->get('thoriumcms_page_mapper');
        }
        return $this->pageMapper;
    }

    /**
     * Set page mapper
     *
     * @param PageMapper $pageMapper
     * @return Page
     */
    public function setPageMapper(PageMapper $pageMapper)
    {
        $this->pageMapper = $pageMapper;
        return $this;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $locator
     * @return void
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }
}
