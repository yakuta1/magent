<?php

class Qiub_Slideshow_Model_Source_AutoDirection
{
    public function toOptionArray()
    {			
        return array(
			array('value'=>'next', 'label'=>Mage::helper('adminhtml')->__('Next')),
			array('value'=>'prev', 'label'=>Mage::helper('adminhtml')->__('Prev')),
        );
    }
}
