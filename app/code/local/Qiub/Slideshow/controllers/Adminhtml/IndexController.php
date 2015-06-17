<?php

class Qiub_Slideshow_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction()
	{
		$this->loadLayout()
			->_setActiveMenu('slideshow/manage_slideshow')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Slide Manager'), Mage::helper('adminhtml')->__('Slide Manager'));
		return $this;
	}

	public function indexAction() {
		$this->_initAction();       
		$this->_addContent($this->getLayout()->createBlock('slideshow/adminhtml_slideshow'));
		$this->renderLayout();
	}

	public function editAction()
	{
		$slideshowId     = $this->getRequest()->getParam('id');
		$slideshowModel  = Mage::getModel('slideshow/slideshow')->load($slideshowId);
 
		if ($slideshowModel->getId() || $slideshowId == 0) {
 
			Mage::register('slideshow_data', $slideshowModel);
 
			$this->loadLayout();
			$this->_setActiveMenu('slideshow/manage_slideshow');
		   
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Slide Manager'), Mage::helper('adminhtml')->__('Slide Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Slide'), Mage::helper('adminhtml')->__('Slide'));
		   
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            	$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            }
		   
			$this->_addContent($this->getLayout()->createBlock('slideshow/adminhtml_slideshow_edit'))
				 ->_addLeft($this->getLayout()->createBlock('slideshow/adminhtml_slideshow_edit_tabs'));
			   
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('slideshow')->__('Slide does not exist'));
			$this->_redirect('*/*/');
		}
	}
   
	public function newAction()
	{
		$this->_forward('edit');
	}
   
	public function saveAction()
	{
		if ( $this->getRequest()->getPost() ) {
			try {
				$postData = $this->getRequest()->getPost();
				$slideshowModel = Mage::getModel('slideshow/slideshow');

			$slidesPath = Mage::helper('slideshow')->getSlidesPath();
			
			if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {
				try {	
				
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('filename');
					
					// Any extention would work
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(true);
					
					// Set the file upload mode 
					// false -> get the file directly in the specified folder
					// true -> get the file in the product like folders 
					//	(file.jpg will go in something like /media/f/i/file.jpg)
					$uploader->setFilesDispersion(false);
							
					// We set media as the upload dir
					$path = Mage::getBaseDir('media') . DS . $slidesPath ;
					$result = $uploader->save($path, $_FILES['filename']['name'] );
					
					//For thumb
					Mage::helper('slideshow')->resizeImg($result['file'], 100, 75);
					//For thumb ends
					
					$test = $slidesPath.$result['file'];
					
					//$postData['filename'] = $slidesPath.$result['file'];
					
					if(isset($postData['filename']['delete']) && $postData['filename']['delete'] == 1)
					{
						//Mage_Core_Model_Store::URL_TYPE_MEDIA. DS .$postData['filename']['value'];
						unlink(Mage_Core_Model_Store::URL_TYPE_MEDIA. DS .$postData['filename']['value']);
						unlink(Mage_Core_Model_Store::URL_TYPE_MEDIA. DS . Mage::helper('slideshow')->getThumbsPath($postData['filename']['value']));
					}
					$postData['filename'] = $test;

				} catch (Exception $e) {
					$postData['filename'] = $_FILES['filename']['name'];
		        }
			}
			else {       
			
				if(isset($postData['filename']['delete']) && $postData['filename']['delete'] == 1){
					unlink(Mage_Core_Model_Store::URL_TYPE_MEDIA. DS .$postData['filename']['value']);
					unlink(Mage_Core_Model_Store::URL_TYPE_MEDIA. DS .Mage::helper('slideshow')->getThumbsPath($postData['filename']['value']));
					$postData['filename'] = '';
					}
				else
					unset($postData['filename']);
			}
			
				$slideshowModel->setId($this->getRequest()->getParam('id'))
					->setTitle($postData['title'])
					->setSlideUrl($postData['slide_url'])
					->setSlideTarget($postData['slide_target'])
					->setSlideContent($postData['slide_content'])
					->setActionButtonText($postData['action_button_text'])
					->setStartDate($postData['start_date'])
					->setEndDate($postData['end_date'])
					->setFilename($postData['filename'])
					->setSortOrder($postData['sort_order'])
					->setStatus($postData['status'])
					->save();

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Slide was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setSlideshowData(false);
 
				$this->_redirect('*/*/');
				return;
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setSlideshowData($this->getRequest()->getPost());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		$this->_redirect('*/*/');
	}
   
	public function deleteAction()
	{
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$slideshowModel = Mage::getModel('slideshow/slideshow');
			   
				$slideshowModel->setId($this->getRequest()->getParam('id'))
					->delete();
				   
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Slide was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}
	/**
	 * Product grid for AJAX request.
	 * Sort and filter result for example.
	 */
	public function gridAction()
	{
		$this->loadLayout();
		$this->getResponse()->setBody(
			   $this->getLayout()->createBlock('slideshow/adminhtml_slideshow_grid')->toHtml()
		);
	}
}
?>