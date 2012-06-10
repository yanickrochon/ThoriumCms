<?php

namespace ThoriumCms\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class ThoriumCmsPageAccess extends AbstractPlugin implements ServiceManagerAwareInterface
{

    const ACCESS_VIEW   = 'view';
    const ACCESS_EDIT   = 'edit';
    const ACCESS_DELETE = 'delete';

    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * Validate access to the given page
     *
     * @param string $pageName the name of the page
     * @param string $accessMode (default is view mode)
     * @return boolean
     */
    public function validate($pageName, $accessMode = 'view')
    {
        // TODO : add user ACL support
        if ($accessMode == static::ACCESS_VIEW) {
            return true;
        } else {
            return $this->getAuthService()->hasIdentity();
        }
    }

    /**
     * Get authService.
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        if (null === $this->authService) {
            // TODO : zfcuser or do we create an configurable alias???
            $this->authService = $this->getServiceManager()->get('zfcuser_auth_service');
        }
        return $this->authService;
    }
 
    /**
     * Set authService.
     *
     * @param AuthenticationService $authService
     */
    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
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
