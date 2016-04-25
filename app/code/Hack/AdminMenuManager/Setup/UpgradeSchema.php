<?php

namespace Hack\AdminMenuManager\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface {
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $setup->run("ALTER TABLE `{$setup->getTable('amm_actions')}` ADD `sort_order` INT NOT NULL AFTER `icon`, ADD `target_type` INT UNSIGNED NOT NULL AFTER `sort_order`;");
        }

        $setup->endSetup();
    }
}