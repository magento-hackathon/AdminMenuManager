<?php

namespace Hack\AdminMenuManager\Model\Resource;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Action extends AbstractDb {
    protected function _construct()
    {
        $this->_init('amm_actions', 'id');
    }
}