<?php

class Qiub_Slideshow_Model_Mysql4_Slides extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('slideshow/slides', 'slide_id');
    }
}