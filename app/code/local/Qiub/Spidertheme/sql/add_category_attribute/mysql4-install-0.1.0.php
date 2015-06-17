<?php
$this->startSetup();
$this->addAttribute('catalog_category', 'top_bg_image', array(
    'group'         => 'General Information',
	'position'		=> 5,
    //'input'         => 'textarea',
    //'type'          => 'text',
    //'backend'       => '',
	'type'    => 'varchar',
	'input'   => 'image',
	'backend' => 'catalog/category_attribute_backend_image',
    'label'         => 'Top Content Background Image',
    'visible'       => true,
    'required'      => false,
    'visible_on_front' => true,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
));
$this->addAttribute('catalog_category', 'top_title', array(
    'group'         => 'General Information',
	'position'		=> 6,
    'input'         => 'text',
    'type'          => 'varchar',
    //'backend'       => '',
	//'backend' => 'catalog/category_attribute_backend_image',
    'label'         => 'Top Content Title',
    'visible'       => true,
    'required'      => false,
    'visible_on_front' => true,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
	'default'       => ''
));
 
$this->endSetup();