<?php

class Qiub_Slideshow_Model_Source_PreloadImages
{
    public function toOptionArray()
    {			
        return array(
			array('value'=>'all', 'label'=>Mage::helper('adminhtml')->__('All')),
			array('value'=>'visible', 'label'=>Mage::helper('adminhtml')->__('Visible')),
        );
    }
}
