<?php

class Qiub_Slideshow_Model_Slides extends Mage_Core_Model_Abstract
{
	public function _construct()
    {
        parent::_construct();
        $this->_init('slideshow/slides');
    }
}