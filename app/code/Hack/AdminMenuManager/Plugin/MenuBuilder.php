<?php

namespace Hack\AdminMenuManager\Plugin;

class MenuBuilder {

    public function afterGetResult(\Magento\Backend\Model\Menu\Builder $builder, \Magento\Backend\Model\Menu $menu) {
        $menu->reorder('Magento_Backend::dashboard', 100);

        $menu->move('Magento_Customer::customer_group', 'Magento_Customer::customer', 100);

        return $menu;
    }
}