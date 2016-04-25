<?php

namespace Hack\AdminMenuManager\Model\Resource\Action;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'id';


    protected function _construct()
    {
        $this->_init(
            'Hack\AdminMenuManager\Model\Action',
            'Hack\AdminMenuManager\Model\Resource\Action'
        );

    }

}