<?php
namespace Hack\AdminMenuManager\Controller\Adminhtml\View;

use \Hack\AdminMenuManager\Controller\Adminhtml\View\Index;

class Edit extends Index
{
    /**
     * Edit Action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $this->_initCurrentAction();

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();

        /** @var \Hack\AdminMenuManager\Block\Adminhtml\View\Edit $block */
        $block = $resultPage->getLayout()->createBlock('Hack\AdminMenuManager\Block\Adminhtml\View\Edit');

        $resultPage->addContent($block);
        return $resultPage;
    }
}
