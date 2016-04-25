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
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();

        /** @var \Hack\AdminMenuManager\Model\Action $action */
        $action = $this->_objectManager->create('Hack\AdminMenuManager\Model\Action');
        $actionId = $this->getRequest()->getParam('action_id', null);
        if ($actionId) {
            $action->load($actionId);
        }

        $this->_coreRegistry->register('current_amm_action', $action);

        /** @var \Hack\AdminMenuManager\Block\Adminhtml\View\Edit $block */
        $block = $resultPage->getLayout()->createBlock('Hack\AdminMenuManager\Block\Adminhtml\View\Edit');

        $resultPage->addContent($block);
        return $resultPage;
    }
}
