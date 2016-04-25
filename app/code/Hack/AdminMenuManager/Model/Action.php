<?php

namespace Hack\AdminMenuManager\Model;

use Magento\Framework\Model\AbstractModel;

class Action extends AbstractModel
{
    const CACHE_TAG = 'amm_action';
    protected $_cacheTag = 'amm_action';
    protected $_eventPrefix = 'amm_action';


    protected function _construct()
    {
        $this->_init('Hack\AdminMenuManager\Model\Resource\Action');
    }
}