<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hack\AdminMenuManager\Controller\Adminhtml\View;

use \Hack\AdminMenuManager\Controller\Adminhtml\View\Index;

class Save extends Index
{
    /**
     * Save Action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $action = $this->_initCurrentAction();

        $data = $this->getRequest()->getPost('action');
        $back = $this->getRequest()->getParam('back', false);
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data['id'] = $action->getId();
            $action->setData($data);
            try {
                $action->save();
                $this->messageManager->addSuccess(__('You saved the AdminMenu Action.'));
                if ($back) {
                    $resultRedirect->setPath(
                        'amm/*/edit',
                        ['_current' => true, 'id' => $action->getId()]
                    );
                } else {
                    $resultRedirect->setPath('amm/*/');
                }
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('amm/*/edit', ['_current' => true]);
            }
        }
        return $resultRedirect->setPath('amm/*/');
    }
}
