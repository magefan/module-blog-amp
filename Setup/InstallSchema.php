<?php
/**
 * Copyright © Magefan (support@magefan.com). All rights reserved.
 * See LICENSE.txt for license details (http://opensource.org/licenses/osl-3.0.php).
 */
namespace Magefan\BlogCustom\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
/**
 * Blog setup
 */
class InstallSchema implements InstallSchemaInterface
{
        /**
         * {@inheritdoc}
         * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
         */
        public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $table = $setup->getTable('magefan_blog_post');
        $setup->getConnection()->addColumn(
            $setup->getTable($table),
            'event_date_from',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
                'nullable' => true,
                'comment' => 'Event Date From Field',
            ]
        )->addColumn(
            'event_date_to',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
                'nullable' => true,
                'comment' => 'Event Date To Field',
            ]
        );

        $setup->endSetup();
    }
}