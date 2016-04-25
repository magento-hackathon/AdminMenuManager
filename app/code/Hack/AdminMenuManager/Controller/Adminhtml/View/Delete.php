<?php

namespace Hack\AdminMenuManager\Controller\Adminhtml\View;

use \Hack\AdminMenuManager\Controller\Adminhtml\View\Index;

class Delete extends Index
{
    /**
     * Delete Action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $action = $this->_initCurrentAction();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($action->getId()) {
            try {
                $action->delete();
                $this->messageManager->addSuccess(__('You deleted the AdminMenu Action.'));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('amm/*/edit', ['_current' => true]);
            }
        }
        return $resultRedirect->setPath('amm/*/');
    }
}
