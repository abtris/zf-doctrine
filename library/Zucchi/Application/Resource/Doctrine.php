<?php
/**
 * Resource for initializing doctrine
 *
 * @category   Zucchi
 * @package    Zucchi_Application
 * @subpackage Resource
 * @copyright  Copyright (c) 2009 Zucchi.co.uk
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zucchi_Application_Resource_Doctrine extends Zend_Application_Resource_ResourceAbstract {

        private $_doctrine;
        
    public function init()
    {
        return $this->build();
    }

    public function build()
    {
                if (null === $this->_doctrine) {
                        $options = $this->getOptions();
                        if (isset($options['compiled']) && $options['compiled'] == true &&
                    file_exists(APPLICATION_PATH . '/../library/Doctrine.compiled.php')){
                    require_once 'Doctrine.compiled.php';
                } else {
                    require_once 'Doctrine.php';
                }       
                
                        $this->getBootstrap()
                                 ->getApplication()
                                 ->getAutoloader()
                 ->pushAutoloader(array('Doctrine', 'autoload'), 'Doctrine')
                 ->pushAutoLoader(new Zucchi_Doctrine_Application_Autoloader(array(
                                'namespace' => '',
                                'basePath'  => APPLICATION_PATH,
                            )), 'ZucchiDoctrine');
                               
                $this->_doctrine = Doctrine_Manager::getInstance();
                
                        $this->_doctrine->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);

                // set models to be autoloaded and not included (Doctrine::MODEL_LOADING_AGGRESSIVE)
                $this->_doctrine->setAttribute(
                    Doctrine::ATTR_MODEL_LOADING,
                    Doctrine::MODEL_LOADING_CONSERVATIVE
                );
                
                // enable ModelTable classes to be loaded automatically
                $this->_doctrine->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, true);
                
                // enable validation on save()
                $this->_doctrine->setAttribute(
                Doctrine::ATTR_VALIDATE,
                Doctrine::VALIDATE_ALL
                );
                
                // enable automatic queries resource freeing
                $this->_doctrine->setAttribute(
                    Doctrine_Core::ATTR_AUTO_FREE_QUERY_OBJECTS,
                    true
                );
                
                    if (!isset($options['connection_string'])) {
                        throw new Exception('You must define a connection for doctrine to connect with');
                }
                // connect to database
                $this->_doctrine->openConnection($options['connection_string'], 'doctrine');
                
                if (isset($options['charset'])) {
                        // set charset
                $this->_doctrine->connection()->setCharset($options['charset']);
                }
                        if (isset($options['cache']) && $options['cache']) {
                        // set cache
                        // implement cacheing here
                }
                
                $this->_doctrine->connection()->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, true);
                }
            
                return $this->_doctrine;        
    } 
    
        
}