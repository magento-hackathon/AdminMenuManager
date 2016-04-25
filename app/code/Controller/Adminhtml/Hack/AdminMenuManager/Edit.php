<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hack\AdminMenuManager\Controller\Adminhtml\Hack\AdminMenuManager;

use Hack\AdminMenuManager\Controller\Adminhtml\Hack\AdminMenuManager;

class Edit extends AdminMenuManager
{
    /**
     * Edit Action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $action = $this->_initAction();
    }
}
