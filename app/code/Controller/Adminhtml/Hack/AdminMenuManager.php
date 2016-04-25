<?php
namespace Hack\AdminMenuManager\Controller\Adminhtml\Hack;

use Magento\Backend\App\Action;

/**
 * Admin menu manager admin controller
 */
abstract class AdminMenuManager extends Action
{
    /**
     * Initialize Variable object
     *
     * @return \Magento\Variable\Model\Variable
     */
    protected function _initAction()
    {
        $actionId = $this->getRequest()->getParam('action_id', null);
        $storeId = (int)$this->getRequest()->getParam('store', 0);

        /* @var $action \Hack\AdminMenuManager\Model\Action */
        $action = $this->_objectManager->create('Hack\AdminMenuManager\Model\Action');
        if ($actionId) {
            $action->setStoreId($storeId)->load($actionId);
        }
        return $action;
    }
}
