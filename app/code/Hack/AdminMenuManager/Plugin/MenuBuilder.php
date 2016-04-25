<?php

namespace Hack\AdminMenuManager\Plugin;

class MenuBuilder {

    const AMM_MENU_ID = 'AMM_CUSTOM_ITEM::custom_';

    protected $_actionModel = null;
    protected $_itemFactory = null;

    public function __construct(\Hack\AdminMenuManager\Model\Action $actionModel, \Magento\Backend\Model\Menu\Item\Factory $itemFactory) {
        $this->_actionModel = $actionModel;
        $this->_itemFactory = $itemFactory;
    }

    public function afterGetResult(\Magento\Backend\Model\Menu\Builder $builder, \Magento\Backend\Model\Menu $menu) {
        foreach ($this->_actionModel->getCollection() as $menuConfig) {
            switch ($menuConfig->getMapping()) {
                case \Hack\AdminMenuManager\Helper\Action::ACTION_CREATE:
                    $menu->add($this->_itemFactory->create(array(
                        'id'       => self::AMM_MENU_ID . $menuConfig->getId(),
                        'title'    => $menuConfig->getTitle(),
                        'module'   => $menu->get($menuConfig->getTarget())->getModule(),
                        'resource' => $menu->get($menuConfig->getTarget())->getResource()
                    )), $menuConfig->getTarget(), 10);
                    break;
                case \Hack\AdminMenuManager\Helper\Action::ACTION_MOVE:
                    if ($menuConfig->getTarget()) {
                        $menu->move($menuConfig->getSource(), $menuConfig->getTarget(), $menuConfig->getSortOrder());
                    }
                    else {
                        $menu->reorder($menuConfig->getSource(), 100);
                    }

                    if ($menuConfig->getTitle()) {
                        $menu->get($menuConfig->getSource())
                            ->setTitle($menuConfig->getTitle());
                    }

                    break;
                case \Hack\AdminMenuManager\Helper\Action::ACTION_RENAME:
                    $menu->get($menuConfig->getSource())
                        ->setTitle($menuConfig->getTitle());
                    break;
                case \Hack\AdminMenuManager\Helper\Action::ACTION_HIDE:
                    $menu->remove($menuConfig->getSource());
                    break;
            }
        }

        // Removing empty menu items without actions (empty parents)
        foreach ($menu as $parent) {
            foreach ($parent->getChildren() as $item) {
                if (!$item->getAction() && !$item->hasChildren()) {
                    $menu->remove($item->getId());
                }
            }
        }

        return $menu;
    }
}