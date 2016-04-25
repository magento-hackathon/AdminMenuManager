<?php

namespace Hack\AdminMenuManager\Plugin;

class MenuBuilder {

    public function afterGetResult(\Magento\Backend\Model\Menu\Builder $builder, \Magento\Backend\Model\Menu $menu) {
        $menu->reorder('Magento_Backend::dashboard', 100);

        return $menu;
    }
}