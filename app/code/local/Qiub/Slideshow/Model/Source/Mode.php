<?php

class Qiub_Slideshow_Model_Source_Mode
{
    public function toOptionArray()
    {			
        return array(
			array('value'=>'fade', 'label'=>Mage::helper('adminhtml')->__('Fade')),
			array('value'=>'horizontal', 'label'=>Mage::helper('adminhtml')->__('Horizontal')),
			array('value'=>'vertical', 'label'=>Mage::helper('adminhtml')->__('Vertical')),
        );
    }
}
