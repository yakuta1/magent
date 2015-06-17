    <?php
     
    class Qiub_Slideshow_Block_Adminhtml_Slides_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
    {
     
        public function __construct()
        {
            parent::__construct();
            $this->setId('slides_tabs');
            $this->setDestElementId('edit_form');
            $this->setTitle(Mage::helper('slideshow')->__('Manage Slide'));
        }
     
        protected function _beforeToHtml()
        {
            $this->addTab('form_section', array(
                'label'     => Mage::helper('slideshow')->__('Slide Information'),
                'title'     => Mage::helper('slideshow')->__('Slide Information'),
                'content'   => $this->getLayout()->createBlock('slideshow/adminhtml_slides_edit_tab_form')->toHtml(),
            ));
           
            return parent::_beforeToHtml();
        }
    }