<?php

namespace Hack\AdminMenuManager\Controller\Adminhtml\View;

class Index extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    protected $_context;

    protected $_resultPageFactory;
    protected $_resultForwardFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory) {

        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultForwardFactory = $resultForwardFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);

    }

    /**
     * @return \Hack\AdminMenuManager\Model\Action
     */
    protected function _initCurrentAction()
    {
        /** @var \Hack\AdminMenuManager\Model\Action $action */
        $action = $this->_objectManager->create('Hack\AdminMenuManager\Model\Action');
        $actionId = $this->getRequest()->getParam('id', null);
        if ($actionId) {
            $action->load($actionId);
        }

        $this->_coreRegistry->register('current_amm_action', $action);

        return $action;
    }

    public function execute() {
        if ($this->getRequest()->getQuery('ajax')) {
            $resultForward = $this->_resultForwardFactory->create();
            $resultForward->forward('grid');
            return $resultForward;
        }
        $resultPage = $this->_resultPageFactory->create();

        $resultPage->getConfig()->getTitle()->prepend(__('Admin Menu Manager'));

        $resultPage->addBreadcrumb(__('Admin Menu Manager'), __('Admin Menu Manager'));


        return $resultPage;
    }
}