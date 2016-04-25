<?php

namespace Hack\AdminMenuManager\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;


class InstallSchema implements InstallSchemaInterface {
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $installer->run("
        CREATE TABLE `{$installer->getTable('amm_actions')}` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `mapping` INT UNSIGNED NOT NULL , `source` VARCHAR(255) NOT NULL , `target` VARCHAR(255) NOT NULL , `title` VARCHAR(255) NOT NULL , `icon` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
        ");

        $installer->endSetup();
    }
}