<?php
/**
 * Doctrine_Task_GenerateModelsYaml
 *
 * @package     Doctrine
 * @subpackage  Task
 */
class Doctrine_Task_ZucchiGenerateModelsYaml extends Doctrine_Task
{
    public $description          =   'Generates your Doctrine_Record definitions from a Yaml schema file',
           $requiredArguments    =   array('yaml_schema_path'   =>  'Specify the complete directory path to your yaml schema files.',
                                           'models_path'        =>  'Specify complete path to your Doctrine_Record definitions.'),
           $optionalArguments    =   array('generate_models_options'    =>  'Array of options for generating models');
    
    public function execute()
    {
        
        $options = array(
            'pearStyle' => true,
            'generateTableClasses' => true,
            'classPrefix' => 'Model_',
            'baseClassPrefix' => 'Base_',
            'baseClassesDirectory' => null,
            'classPrefixFiles' => false,
            'generateAccessors' => false,
        );
        
        Doctrine_Core::generateModelsFromYaml($this->getArgument('yaml_schema_path'), $this->getArgument('models_path'), $this->getArgument('generate_models_options', $options));
        
        $this->notify('Generated models successfully from YAML schema');
    }
}