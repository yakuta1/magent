<?php
class Qiub_Slideshow_Block_Adminhtml_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if($row->getData($this->getColumn()->getIndex())==""){
            return "";
        }
        else{
			$html = sprintf('<img id="%s" width="60" height="45" src="%s" class="grid-image %s" />', 
							$this->getColumn()->getId(),
							Mage::getBaseUrl("media") . Mage::helper('slideshow')->getThumbsPath($row->getData($this->getColumn()->getIndex())), 
							$this->getColumn()->getInlineCss()
					);
            return $html;
        }
    }
} 