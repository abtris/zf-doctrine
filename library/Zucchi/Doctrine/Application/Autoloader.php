<?php
/**
 * Resource loader for application module classes
 * 
 * @uses       Zucchi_Doctrine_Application_Autoloader
 * @package    Zucchi_Doctrine
 * @subpackage Application
 * @copyright  Copyright (c) 2009 Zucchi.co.uk
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zucchi_Doctrine_Application_Autoloader extends Zend_Loader_Autoloader_Resource
{
    /**
     * Constructor
     * 
     * @param  array|Zend_Config $options 
     * @return void
     */
    public function __construct($options)
    {
        parent::__construct($options);
        $this->initDefaultResourceTypes();
    }

    /**
     * Initialize default resource types for module resource classes
     * 
     * @return void
     */
    public function initDefaultResourceTypes()
    {
        $basePath = $this->getBasePath();
        $this->addResourceTypes(array(
            'dbtable' => array(
                'namespace' => 'Model_DbTable',
                'path'      => 'models/DbTable',
            ),
            'model'   => array(
                'namespace' => 'Model',
                'path'      => 'models',
            ),
            'modelbase'   => array(
                'namespace' => 'Model_Base',
                'path'      => 'models/Base',
            )
        ));
        $this->setDefaultResourceType('model');
    }
}