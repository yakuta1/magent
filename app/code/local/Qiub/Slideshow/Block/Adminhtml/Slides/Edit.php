    <?php
     
    class Qiub_Slideshow_Block_Adminhtml_Slides_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
    {
        public function __construct()
        {
            parent::__construct();
                   
            $this->_objectId = 'id';
            $this->_blockGroup = 'slideshow';
            $this->_controller = 'adminhtml_slides';
     
            $this->_updateButton('save', 'label', Mage::helper('slideshow')->__('Save Slide'));
            $this->_updateButton('delete', 'label', Mage::helper('slideshow')->__('Delete Slide'));
        }
     
        public function getHeaderText()
        {
            if( Mage::registry('slideshow_data') && Mage::registry('slideshow_data')->getId() ) {
                return Mage::helper('slideshow')->__("Edit Slide '%s'", $this->htmlEscape(Mage::registry('slideshow_data')->getTitle()));
            } else {
                return Mage::helper('slideshow')->__('Add Slide');
            }
        }
		
		public function getHeaderCssClass()
		{
			$cssclass = parent::getHeaderCssClass();
			
			if( Mage::registry('slideshow_data') && Mage::registry('slideshow_data')->getId() ) {
                $cssclass .= ' edit_slide';
            } else {
                $cssclass .= ' add_slide';
            }
			
			return $cssclass;
		}
		
    }