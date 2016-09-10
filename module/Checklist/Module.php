<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Checklist;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Checklist\Mapper\NewsTableMapper;
use Checklist\Mapper\NbateamTableMapper;
use Checklist\Mapper\UsersTableMapper;

/**
 * @author meng.xu
 *
 */

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /*
     * Fixed function name--not change--- gerServiceConfig
     *
     * */
     public function getServiceConfig()
     {
         return array(
             'factories' => array(
             	 'dbAdapter'=>function($sm){
             		return $sm->get('Zend\Db\Adapter\Adapter');
             	 },
                 'newsTableMapper' => function ($sm) {
                 	return new NewsTableMapper($sm->get('dbAdapter'),"news");
                 },
                 'nbateamTableMapper' => function ($sm) {
              	    return new NbateamTableMapper($sm->get('dbAdapter'),"nbateam");
                 },
                 'usersTableMapper' => function ($sm) {
                 	return new UsersTableMapper($sm->get('dbAdapter'),"users");
                 },
             ),

         );
     }

}
