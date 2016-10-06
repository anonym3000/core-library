<?php
namespace CoreLibrary\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\Mvc\MvcEvent;
/**
 *
 * @author lucian.duta
 *
 */
abstract class CoreController extends AbstractActionController
{
    // TODO - CoreController - acl, doctrine

    public function __construct()
    {
    }

    public function onDispatch(MvcEvent $event)
    {
        $this->_appSection = $this->params('controller');

        //$this->getUserEntity();
        //$this->checkRights();

        return parent::onDispatch($event);
    }

    public function notAllowedAction()
    {
        $response   = $this->response;
        $event      = $this->getEvent();
        $routeMatch = $event->getRouteMatch();

        $response->setStatusCode(403);
        $routeMatch->setParam('action', 'not-allowed');

        $view = new ViewModel();
        return $view;
    }

    /**
     * TODO - Checks rights on the current appSection
     *
     */
    protected function checkRights()
    {
    }

    /**
     * TODO - get user entity
     */
    protected function getUserEntity()
    {
    }

    protected function attachDefaultParmas($params)
    {
        //$params['_authenticatedUser'] = $this->_authenticatedUser;
        //$params['_appSection'] = $this->_appSection;
        $params['_query'] = $this->params()->fromQuery();

        return $params;
    }

    public function getAclActions()
    {
        return $this->_aclActions;
    }
}