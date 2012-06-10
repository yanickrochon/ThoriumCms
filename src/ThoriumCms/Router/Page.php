<?php

namespace ThoriumCms\Router;

use Zend\Mvc\Router\Http\RouteInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Mvc\Router\Exception;  // TODO : create domain exception
use ThoriumCms\Service\Page as PageService;

class Page implements RouteInterface, ServiceLocatorAwareInterface
{

    /**
     * Default values.
     *
     * @var array
     */
    protected $defaults;

    /**
     * route value.
     *
     * @var string
     */
    protected $prefix;

    /**
     * Priority used for route stacks.
     *
     * @var integer
     */
    public $priority = 2000;


    protected $serviceLocator;

    /**
     * Create a new page route.
     *
     * @param  string $route
     * @param  array  $defaults
     */
    public function __construct($route, array $defaults = array())
    {
        $this->defaults = $defaults;
        $this->prefix   = $route;   // TODO : format route
    }
     

    /**
     * Create a new route with given options.
     *
     * @param  array|\Traversable $options
     * @return void
     */
    public static function factory($options = array())
    {
        if ($options instanceof Traversable) {
            $options = ArrayUtils::iteratorToArray($options);
        } elseif (!is_array($options)) {
            throw new Exception\InvalidArgumentException(__METHOD__ . ' expects an array or Traversable set of options');
        }

        if (!isset($options['route'])) {
            throw new Exception\InvalidArgumentException('Missing "route" in options array');
        }

        if (!isset($options['defaults'])) {
            $options['defaults'] = array();
        }

        return new static($options['route'], $options['defaults']);
    }

    /**
     * Match a given request.
     *
     * @param  Request $request
     * @return RouteMatch
     */
    public function match(Request $request)
    {
        if (!method_exists($request, 'uri')) {
            return null;
        }

        throw new Exception('all necessary features not currently implemented for this router to work properly');   // FIXME

        return null;
    }

    /**
     * Assemble the route.
     *
     * @param  array $params
     * @param  array $options
     * @return mixed
     */
    public function assemble(array $params = array(), array $options = array())
    {
        throw new Exception('not implemented');   // TODO 
    }

    /**
     * Get a list of parameters used while assembling.
     * 
     * @return array
     */
    public function getAssembledParams()
    {
        throw new Exception('not implemented');   // TODO 
    }

    public function getPageService()
    {
        return $this->getServiceLocator()->get('thoriumcms_page_service');
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        echo "foo"; exit;
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }


}
