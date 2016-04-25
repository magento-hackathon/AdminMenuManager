<?php

namespace Hack\AdminMenuManager\Plugin;

class MenuBuilder {

    protected $_itemFactory = null;

    public function __construct(\Magento\Backend\Model\Menu\Item\Factory $itemFactory) {
        $this->_itemFactory = $itemFactory;
    }

    public function afterGetResult(\Magento\Backend\Model\Menu\Builder $builder, \Magento\Backend\Model\Menu $menu) {
        $menu->reorder('Magento_Backend::dashboard', 100);

        $menu->add($this->_itemFactory->create(array(
            'id'       => 'Magento_Customer::CustomerBasic',
            'title'    => 'Customer - basic',
            'module'   => 'Magento_Customer',
            'resource' => 'Magento_Customer::customer'
        )), 'Magento_Customer::customer', 10);

        $menu->add($this->_itemFactory->create(array(
            'id'       => 'Magento_Customer::CustomerGroups',
            'title'    => 'Customer - groups',
            'module'   => 'Magento_Customer',
            'resource' => 'Magento_Customer::customer'
        )), 'Magento_Customer::customer', 20);

        $menu->move('Magento_Customer::customer_manage', 'Magento_Customer::CustomerBasic', 10);
        $menu->move('Magento_Customer::customer_online', 'Magento_Customer::CustomerBasic', 20);
        $menu->move('Magento_Customer::customer_group', 'Magento_Customer::CustomerGroups', 10);

        return $menu;
    }
}