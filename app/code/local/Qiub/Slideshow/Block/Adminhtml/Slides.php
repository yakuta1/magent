<?php
class Qiub_Slideshow_Block_Adminhtml_Slides extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
    {
        $this->_controller = 'adminhtml_slides';
        $this->_blockGroup = 'slideshow';
        $this->_headerText = Mage::helper('slideshow')->__('Slide Manager');
        $this->_addButtonLabel = Mage::helper('slideshow')->__('Add Slide');
        parent::__construct();
    }
}
