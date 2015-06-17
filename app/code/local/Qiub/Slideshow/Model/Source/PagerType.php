<?php

class Qiub_Slideshow_Model_Source_PagerType
{
    public function toOptionArray()
    {			
        return array(
			array('value'=>'full', 'label'=>Mage::helper('adminhtml')->__('Full')),
			array('value'=>'short', 'label'=>Mage::helper('adminhtml')->__('Short')),
        );
    }
}
