<?php
namespace Hack\AdminMenuManager\Controller\Adminhtml\View;

class Index extends \Magento\Backend\App\Action
{
    protected $_context;

    protected $_resultPageFactory;
    protected $_resultForwardFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory) {

        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);

    }

    public function execute() {
        die('aha');
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